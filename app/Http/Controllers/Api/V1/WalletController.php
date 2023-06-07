<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Card;
use App\Models\AccountToCard;
use App\Services\AccountService;
use App\Services\Luhn;
use App\Services\WalletService;
use Illuminate\Support\Str;

class WalletController extends Controller
{

    public function create($params)
    {
        $card = Card::where('user_id', $params['user']['id'])
            ->where('phone', $params['params']['phone'])
            ->first();

        if (empty($card)) {
            $luhn = new Luhn();
            $luhn = $luhn->run($params['user']['pan'], $params['user']['expire']);
            $this->number = $luhn['number'];
            $this->expire = $luhn['expire'];
            $card = Card::create([
                'user_id' => $params['user']['id'],
                'number' => $luhn['number'],
                'expire' => $luhn['expire'],
                'type' => 0,
                'owner' => $params['params']['owner'],
                'balance' => 0,
                'phone' => $params['params']['phone'],
                'pnfl' => $params['params']['pnfl'],
                'pasport_series' => $params['params']['pasport_series'],
                'pasport_number' => $params['params']['pasport_number'],
                'token' => Str::uuid(),
                'status' => 1,
            ]);
        }
        return $this->success($card);
    }

    public function info($params)
    {
        return $this->success(Card::where('token', $params['params']['token'])->first());
    }

    public function payment($params)
    {
        $card = Card::where('token', $params['params']['token'])->first();
        $account = Account::where('type', 2)->first();
        $accountToCard = AccountToCard::create([
            'account_balance' => $account->balance,
            'account_id' => $account->id,
            'card_balance' => $card->balance,
            'card_id' => $card->id,
            'card_token' => $card->token,
            'amount' => $params['params']['amount'],
            'is_transaction' => 0,
            'status' => 0,
            'uuid' => Str::uuid(),
        ]);

        $debit = AccountService::debit([
            'id' => $accountToCard->account_id,
            'amount' => $accountToCard->amount
        ]);
        if ($debit) {
            $accountToCard->update([
                'status' => 1,
            ]);
            $credit = WalletService::credit([
                'token' => $accountToCard->card_token,
                'amount' => $accountToCard->amount,
            ]);
            if ($credit) {
                $accountToCard->update([
                    'status' => 4
                ]);
                return [
                    'status' => $accountToCard->status,
                    'tr_id' => $accountToCard->uuid,
                    'amount' => $accountToCard->amount,
                ];
            }else{
                $accountToCard->update([
                    'status' => 11
                ]);
                return [
                    'error' => [
                        'code' => 303,
                        'message' => [
                            'uz' => "Wallet to'ldirishda xatolik!!!",
                        ],
                    ],
                ];
            }
        }else{
            return [
                'error' => [
                    'code' => 301,
                    'message' => [
                        'uz' => "Balanceda yetarli mablag' mavjud emas!!!",
                        'ru' => "На балансе недостаточно средств!!!",
                        'en' => "There are not enough funds in the balance!!!",
                    ],
                ],
            ];
        }
    }

    public function success($card)
    {
        return [
            'number' => $card->number,
            'expire' => $card->expire,
            'owner' => $card->owner,
            'balance' => $card->balance,
            'phone' => $card->phone,
            'token' => $card->token,
            'status' => $card->status,
            'pnfl' => $card->pnfl,
            'pasport_series' => $card->pasport_series,
            'pasport_number' => $card->pasport_number,
        ];
    }

}
