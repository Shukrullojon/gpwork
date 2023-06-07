<?php

namespace App\Helpers\Api\V1;

class ValidationHelper
{
    public static function check($params){
        if($params['method'] == "login.login"){
            return [
                "params.email" => "required",
                "params.password" => "required",
            ];
        }else if($params['method'] == "wallet.create"){
            return [
                "params.owner" => "required|min:5|max:40",
                "params.phone" => "required|max:16",
                "params.pnfl" => "required|min:14|max:14",
                "params.pasport_series" => "required|min:2|max:2",
                "params.pasport_number" => "required|min:5|max:7",
            ];
        }else if($params['method'] == "wallet.info"){
            return [
                "params.token" => "required|exists:cards,token"
            ];
        }else if($params['method'] == "wallet.payment"){
            return [
                "params.token" => "required|exists:cards,token",
                "params.amount" => "required|integer|min:100|max:1000000000",
            ];
        }else if($params['method'] == "transfer.create"){
            return [
                "params.sender" => "required|exists:cards,token",
                "params.receiver" => "required|numeric",
                "params.amount" => "required|integer|min:100",
            ];
        }else if($params['method'] == "transfer.confirm"){
            return [
                "params.ext_id" => "required|exists:transfers,ext_id",
            ];
        }else if($params['method'] == "rate.get"){
            return [];
        }else if($params['method'] == "percentage.get"){
            return [];
        }else{
            return [
                "method" => [
                    "required",
                    "in:login.login,
                    wallet.create,
                    wallet.info,
                    transfer.create,
                    transfer.confirm,
                    rate.get,
                    ",
                ],
            ];
        }

    }
}
