<?php

namespace App\Services;

use App\Gateway\AbsGateway;
use App\Models\Pages\Account;
use App\Models\Pages\Card;
use App\Models\Pages\History;
use Illuminate\Support\Facades\DB;

class AbsService
{
    public static function transaction($data)
    {
        return AbsGateway::fire('POST', 'api/v1/bank', [
            "jsonrpc" => "2.0",
            "id" => rand(10000, 99999),
            "method" => "iabs.transactions.create.transactions",
            "params" => [
                "type" => $data['type'],
                "sender" => [
                    "account" => $data['sender_account'],
                    "codeFilial" => $data['sender_code_filial'],
                    "tax" => $data['sender_tax'],
                    "name" => $data['sender_name'],
                ],
                "recipient" => [
                    "account" => $data['recipient_account'],
                    "codeFilial" => $data['recipient_code_filial'],
                    "tax" => $data['recipient_tax'],
                    "name" => $data['recipient_name'],
                ],
                "purpose" => $data['purpose'],
                "amount" => (float)$data['amount']
            ]
        ]);
    }

    public static function getAccountDetails($data)
    {
        return AbsGateway::fire('POST', 'api/v1/bank', [
            "jsonrpc" => "2.0",
            "id" => rand(10000, 99999) . time(),
            "method" => "iabs.account.get.account.details",
            "params" => [
                "account" => $data['account'],
                "code_filial" => "00996",
                "id" => rand(10000, 99999),
            ]
        ]);
    }

    public static function getAccountHistory($data)
    {
        return AbsGateway::fire('POST', 'api/v1/bank', [
            "jsonrpc" => "2.0",
            "id" => rand(10000, 99999) . time(),
            "method" => "iabs.account.get.account.history",
            "params" => [
                "account" => $data['account'],
                "code_filial" => $data['filial'],
                "dateBegin" => $data['date'],
                "dateClose" => date('d.m.Y'),
            ]
        ]);
    }

    public static function operDay()
    {
        return AbsGateway::fire('POST', 'api/v1/bank', [
            "jsonrpc" => "2.0",
            "id" => rand(10000, 99999),
            "method" => "iabs.reference.get.oper.day",
            "params" => []
        ]);
    }

    public static function rate($data)
    {
        return AbsGateway::fire('POST', 'api/v1/bank', [
            "jsonrpc" => "2.0",
            "id" => rand(10000, 99999),
            "method" => "iabs.currency.get.cross.rate",
            "params" => [
                "destination" => $data['destination'],
                "date" => $data['date']
            ]
        ]);
    }
}
