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


class AbsGateway
{
    public static function fire($method, $url, $data)
    {
        $url = 'http://192.168.202.250/'.$url;

        $curl = curl_init();

        switch($method){
            case 'GET':
                break;
            case 'POST':
                curl_setopt($curl, CURLOPT_POST, TRUE);
                break;
            case 'DELETE':
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
                break;
            case 'PATCH':
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PATCH');
        }
        if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($curl, CURLOPT_URL, $url);
        //later implement more productive

        $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiZGQxZDQwMjZlZTEzNDlkNTUzOTY1NmJlYTc4YzNjMDUwMmMyMjFiOTlmNGRmMzMwMjgzNDc5NjQyNmNiZmUzODAzM2M2Nzk0ZjkyZmYxNjYiLCJpYXQiOjE2ODQ0MDQyMzcsIm5iZiI6MTY4NDQwNDIzNywiZXhwIjoxNzE2MDI2NjM3LCJzdWIiOiI0MyIsInNjb3BlcyI6W119.LV6xwLezK2LXorR7X0g0CzeS7VIhOYJrJ4MgJmib4ZUALogBQZgrOcnQ4ZsFpXfFUO2uWkSi142XS71y6eqp1lz6ndt3HcYVb123vbOLMnNRrW2dFXa1wX6k6xd3aJLOyWXMUuYvt7nk56u43eW8Fi_dC5-qHSjtUQULM-3whUgL65e3ubnINHIxJs1WKyRuXrW2shcE44pA1XJyc7tMEg1FPHXQFGeTg2HTouV3I17A-QYMUEhoSqsqhzscWc-M7da2n74Ie1LCCfkupSVArwINbcASHN02fxVxjx4WMSNKWSlTztAv7ze32wCGvu5bKfVdGe8-CxyMuV7YcT6wuDbnrVusJGQgyHW4vgqNUVwgtfrxhuRV0AGnZuXonoVumv4CBibL_Ow1ZQncojMpFscr1mPxZ0CclLx3TYDWwNoZHxnPXFmggVzrs38ScJOVMWC86pUNnGafBsLmtBe0Or6p18X3yLoVOqx1uWDPnlNHEE6mi6jKPZqZtlIqFvrK7J0UoaD9dEmpaoVpY82cNVGLwMRTwaDGbVTvn5vKAYzEFpKEevnKh9ajddrLFKjsax7ZSg5htw4kRxl0FcpfUfcm27cOi3BvT3peQ2OOgkEDXBARaF2W6vqYMyf8GEhwxgB1WPKuQSX0oWPCh9qmMj5FDpfGTif-oKz-bggf8aI";
        $header = [
            'token:'.$token,
            'Content-Type:application/json',
            'Accept:application/json',
            'requestId:' . time() . rand(100, 1000)
        ];
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response, true);
    }
}
