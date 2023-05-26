<?php

namespace App\Services;

use App\Gateway\TransferGateway;

class TransferService
{
    public static function login()
    {
        return TransferGateway::fire([
            "jsonrpc" => "2.0",
            "id" => "1",
            "method" => "login",
            "params" => [
                "username" => "GPWORK",
                "password" => "Dd38aQd5z53dDTx"
            ]
        ]);
    }

    public static function create($data)
    {
        return TransferGateway::fire([
            "jsonrpc" => "2.0",
            "id" => "1",
            "method" => "transfer.credit.rf.create",
            "params" => [
                "amount" => $data['amount'],
                "currency" => $data['currency'],
                "receiver" => $data['receiver'],
                "ext_id" => $data['ext_id']
            ]
        ]);
    }

    public static function confirm($data)
    {
        return TransferGateway::fire([
            "jsonrpc" => "2.0",
            "id" => "1",
            "method" => "transfer.credit.confirm",
            "params" => [
                "ext_id" => $data['ext_id']
            ]
        ]);
    }

    public static function state($data)
    {

    }
}
