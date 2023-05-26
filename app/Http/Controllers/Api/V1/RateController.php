<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\AbsService;

class RateController extends Controller
{
    public function get($params){

        $rate = AbsService::rate([
            'destination' => "4",
            'date' => date('d.m.Y')
        ]);

        $r = [];
        foreach ($rate['data']['responseBody']['response'] as $response){
            if($response['currencyCode'] == 643){
                $r = $response;
            }
        }
        return (!empty($r)) ? [
            'id' => $r['id'],
            'currencyCode' => $r['currencyCode'],
            'currencyChar' => $r['currencyChar'],
            'sellingRate' => $r['sellingRate'],
        ] : [];
    }

}
