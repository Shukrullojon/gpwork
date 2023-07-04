<?php
/*
 * Unisoft Group Copyright (c)  2021.
 *
 * Created by Fatulloyev Shukrullo
 * Please contact before making any changes
 *
 * Tashkent, Uzbekistan
 */

namespace App\Gateway;


class TransferGateway
{
    public static function fire($data)
    {
        $url = '192.168.202.41:7002/api/v1/main/';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Authorization:Bearer 8c68331496514b6e8c7e01805941ec61c7a2af9aca71410dbddb486fd5cab639e503391352f544278f2c59b7d27604d3',
            'Content-Type:application/json',
            'Accept:application/json',
            'requestId:' . time() . rand(100, 1000)
        ]);
        curl_setopt($curl, CURLOPT_POST, TRUE);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response, true);
    }
}
