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
            'Authorization:Bearer c9d29766-aaae-4591-893d-c73976384500',
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
