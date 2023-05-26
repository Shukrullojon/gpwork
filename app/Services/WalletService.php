<?php

namespace App\Services;

use App\Models\Account;
use App\Models\Card;
use App\Models\History;

class WalletService
{
    public static function debit($data)
    {
        $card = Card::where('token', $data['token'])->first();
        if ($card->balance > $data['amount']) {
            $card->update([
                'balance' => $card->balance - $data['amount'],
            ]);
            return true;
        }
        return false;
    }

    public static function credit($data)
    {
        $card = Card::where('token', $data['token'])->first();
        $card->update([
            'balance' => $card->balance + $data['amount'],
        ]);
        return true;
    }

}
