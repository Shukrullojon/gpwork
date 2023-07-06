<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Card;
use App\Models\Hold;
use App\Models\Transfer;
use App\Services\AbsService;
use App\Services\TransferService;
use App\Services\WalletService;
use Illuminate\Support\Str;

class TransferController extends Controller
{
    public function create($params)
    {
        $card = Card::where('token', $params['params']['sender'])->first();
        // !!! so'mga o'tqazib check qilish kerak
        $count = Transfer::where('created_at', 'LIKE', '%' . date("Y-m-d" . '%'))->count('id');
        if ($count > 100) {
            return [
                'error' => [
                    'code' => 351,
                    'message' => [
                        'uz' => "",
                        'ru' => "",
                        'en' => "",
                    ],
                ],
            ];
        }
        $transfer = Transfer::create([
            'user_id' => $params['user']['id'],
            'ext_id' => Str::uuid(),
            'sender' => $params['params']['sender'],
            'senderType' => 2,
            'senderAmount' => $card->balance,
            'receiver' => $params['params']['receiver'],
            'amount' => $params['params']['amount'],
            'currency' => $params['params']['currency'],
            'status' => 0,
        ]);

        $request = TransferService::create([
            'amount' => $transfer->amount,
            'currency' => $transfer->currency,
            'receiver' => $transfer->receiver,
            'ext_id' => $transfer->ext_id
        ]);

        if (isset($request['status']) and $request['status']) {
            $transfer->update([
                'currency' => $request['result']['currency'],
                'debit_amount' => $request['result']['amount'] * $request['result']['rate'],
                'commission_amount' => ($request['result']['amount'] * $request['result']['rate'] * 0.5) / 100,
                'credit_amount' => $request['result']['amount'],
                'document_id' => $request['result']['document_id'],
                'document_ext_id' => $request['result']['document_ext_id'],
                'rate' => $request['result']['rate'],
            ]);
            if ($card->balance < $transfer->debit_amount) {
                return [
                    'error' => [
                        'code' => 350,
                        'message' => [
                            'uz' => "Balansda yetarli mablang mavjud emas!!!",
                            'ru' => "На балансе недостаточно денег!!!",
                            'en' => "There is not enough money in the balance!!!",
                        ],
                    ],
                ];
            }
            return $this->success($transfer);
        } else {
            return $request['error'];
        }
    }

    public function confirm($params)
    {
        // 1 minut ichida confirm qilishini check qilish.
        $transfer = Transfer::where('ext_id', $params['params']['ext_id'])->first();
        if ($transfer->status != 0) {
            return [
                'error' => [
                    'code' => 300,
                    'message' => [
                        'uz' => "Tranzaksiya oldin tasdiqlangan!!!",
                        'ru' => "Сделка предварительно одобрена!!!",
                        'en' => "The transaction is pre-approved!!!",
                    ],
                ],
            ];
        }

        if (strtotime($transfer->created_at) < strtotime(date("Y-m-d H:i:s", strtotime("-1 minutes")))) {
            $transfer->update([
                'status' => -5
            ]);
            return [
                'error' => [
                    'code' => 300,
                    'message' => [
                        'uz' => "Tranzaksiya 1 minut ichida tasdiqlanishi kerak!!!",
                        'ru' => "Транзакция должна быть подтверждена в течение 1 минуты!!!",
                        'en' => "The transaction must be confirmed within 1 minute!!!",
                    ],
                ],
            ];
        }

        $accountDb = Account::where('type', 2)->where('user_id', $transfer->user_id)->first();
        $accountDb3 = Account::where('type', 3)->where('user_id', $transfer->user_id)->first();
        if (empty($accountDb) or empty($accountDb3)) {
            return [
                'error' => [
                    'code' => 303,
                    'message' => [
                        'uz' => "Hisob raqam topilmadi!!!",
                        'ru' => "Номер счета не найден!!!",
                        'en' => "Account number not found!!!",
                    ],
                ],
            ];
        }
        $account = AbsService::getAccountDetails([
            'account' => $accountDb->number,
        ]);
        $hold = Hold::where('state', 0)->sum('amount');
        // check enough money to account
        if (
            isset($account['status']) and
            $account['status'] and
            isset($account['result']['responseBody']['saldo']) and
            ($account['result']['responseBody']['saldo'] - $hold) > ($transfer->debit_amount + $transfer->commission_amount)
        ) {
            $debit = WalletService::debit([
                'token' => $transfer->sender,
                'amount' => $transfer->debit_amount, //+ $transfer->commission_amount,
            ]);
            if ($debit) {
                $transfer->update([
                    'status' => 3,
                ]);
                // money to hold
                $data = [
                    "type" => "101",
                    "sender_account" => $accountDb->account,
                    "sender_code_filial" => $accountDb->filial,
                    "sender_tax" => $accountDb->inn,
                    "sender_name" => $accountDb->name,
                    "recipient_account" => $accountDb3->account,
                    "recipient_code_filial" => $accountDb3->filial,
                    "recipient_tax" => $accountDb3->inn,
                    "recipient_name" => $accountDb3->name,
                    "purpose" => [
                        "code" => "00668",
                        "name" => "перевод (дата: " . date("Y-m-d H:i:s") . ") sender:" . $transfer->sender . " receiver:" . $transfer->receiver . " transfer_id: " . $transfer->id
                    ],
                    "amount" => $transfer->debit_amount + $transfer->commission_amount,
                ];
                Hold::create([
                    'model' => Transfer::class,
                    'model_id' => $transfer->id,
                    'data' => json_encode($data, JSON_UNESCAPED_UNICODE),
                    'amount' => $transfer->debit_amount + $transfer->commission_amount,
                    'state' => 0,
                ]);
                $request = TransferService::confirm([
                    'ext_id' => $transfer->ext_id,
                ]);
                if (isset($request['status']) and $request['status']) {
                    $transfer->update([
                        'status' => 4,
                    ]);
                    return $this->success($transfer);
                } else {
                    $transfer->update([
                        'status' => 20,
                    ]);
                    return [
                        'error' => [
                            'code' => 302,
                            'message' => [
                                'uz' => "Tranzaksiyani amalga oshirib bo'lmadi!!!",
                                'ru' => "Транзакция не может быть завершена!!!",
                                'en' => "The transaction could not be completed!!!",
                            ],
                        ],
                    ];
                }
            } else {
                return [
                    'error' => [
                        'code' => 301,
                        'message' => [
                            'uz' => "Balansda yetarli mablag' mavjud emas!!!",
                            'ru' => "На балансе недостаточно средств!!!",
                            'en' => "There are not enough funds in the balance!!!",
                        ],
                    ],
                ];
            }
        } else {
            return [
                'error' => [
                    'code' => 304,
                    'message' => [
                        'uz' => "Balansda yetarli mablag' mavjud emas (22640...)!!!",
                        'ru' => "На балансе недостаточно средств(22640...)!!!",
                        'en' => "There are not enough funds in the balance(22640...)!!!",
                    ],
                ],
            ];
        }
    }

    public function success($transfer)
    {
        return [
            'ext_id' => $transfer->ext_id,
            'sender' => $transfer->sender,
            'receiver' => $transfer->receiver,
            'amount' => $transfer->amount,
            'credit_amount' => $transfer->credit_amount,
            'debit_amount' => $transfer->debit_amount,
            'commission_amount' => $transfer->commission_amount,
            'currency' => $transfer->currency,
            'rate' => $transfer->rate,
            'status' => $transfer->status,
        ];
    }
}
