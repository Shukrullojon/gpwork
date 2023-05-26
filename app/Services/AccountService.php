<?php

namespace App\Services;

use App\Models\Account;
use App\Models\Card;
use App\Models\History;

class AccountService
{
    public static function debit($data)
    {
        $account = Account::where('id', $data['id'])->first();
        if ($account->balance > $data['amount']) {
            $account->update([
                'balance' => $account->balance - $data['amount'],
            ]);
            return true;
        }
        return false;
    }

    public static function credit($data)
    {

    }

}
