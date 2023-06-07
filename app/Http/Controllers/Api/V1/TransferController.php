<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\Transfer;
use App\Services\TransferService;
use App\Services\WalletService;
use Illuminate\Support\Str;

class TransferController extends Controller
{

    public function create($params)
    {
        $card = Card::where('token', $params['params']['sender'])->first();

        $transfer = Transfer::create([
            'ext_id' => Str::uuid(),
            'sender' => $params['params']['sender'],
            'senderType' => 2,
            'senderAmount' => $card->balance,
            'receiver' => $params['params']['receiver'],
            'amount' => $params['params']['amount'],
            'status' => 0,
        ]);

        $request = TransferService::create([
            'amount' => $transfer->amount,
            'currency' => 643,
            'receiver' => $transfer->receiver,
            'ext_id' => $transfer->ext_id
        ]);

        if (isset($request['status']) and $request['status']) {
            $transfer->update([
                'currency' => $request['result']['currency'],
                'debit_amount' => $request['result']['amount'] * $request['result']['rate'],
                'commission_amount' => ($request['result']['amount'] * $request['result']['rate'] * 0.5)/100,
                'credit_amount' => $request['result']['amount'],
                'document_id' => $request['result']['document_id'],
                'document_ext_id' => $request['result']['document_ext_id'],
                'rate' => $request['result']['rate'],
            ]);
            return $this->success($transfer);
        } else {
            return $request['error'];
        }
    }

    public function confirm($params){
        $transfer = Transfer::where('ext_id',$params['params']['ext_id'])->first();
        if ($transfer->status != 0){
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

        $debit = WalletService::debit([
            'token' => $transfer->sender,
            'amount' => $transfer->debit_amount + $transfer->commission_amount,
        ]);
        if ($debit){
            $request = TransferService::confirm([
                'ext_id' => $transfer->ext_id,
            ]);

            if (isset($request['status']) and $request['status']){
                $transfer->update([
                    'status' => 4,
                ]);
                return $this->success($transfer);
            }else{
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
        }
        else{
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
