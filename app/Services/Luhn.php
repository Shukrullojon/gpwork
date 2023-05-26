<?php
/*
 * Unisoft Group Copyright (c)  2021.
 *
 * Created by Fatulloyev Shukrullo
 * Please contact before making any changes
 *
 * Tashkent, Uzbekistan
 */

namespace App\Services;

use App\Models\Card;

class Luhn
{
    public function generate($value): int
    {
        if (!is_numeric($value)) {
            throw new \InvalidArgumentException(__FUNCTION__ . ' can only accept numeric values.');
        }
        // Force the value to be a string so we can work with it like a string.
        $value = (string) $value;
        // Set some initial values up.
        $length = strlen($value);
        $parity = $length % 2;
        $sum = 0;
        for($i = $length - 1; $i >= 0; --$i) {
            // Extract a character from the value.
            $char = $value[$i];
            if ($i % 2 != $parity) {
                $char *= 2;
                if ($char > 9) {
                    $char -= 9;
                }
            }
            // Add the character to the sum of characters.
            $sum += $char;
        }
        // Return the value of the sum multiplied by 9 and then modulus 10.
        return ($sum * 9) % 10;
    }

    /**
     * @param string $prefix - length 8 sample: 86001234
     * @param int $dueDate
     * @return array
     */
    public function run(): array
    {
        $prefix = "860648880";
        $dueDate = 5;
        $generateNum = '';
        for($i=0;$i<7;$i++){
            $time=strtotime(date("Y-m-d H:i:s",(time() + $i))).rand(1,10);
            $generate = $this->generate($time);
            $generateNum .= $generate;
        }
        $card_number = $prefix.$generateNum;
        $card = Card::where('number',$card_number)->first();
        if($card){
            $this->run($prefix,$dueDate);
        }
        $expire = date('my',strtotime("+$dueDate years"));
        return [
            'number'=>$card_number,
            'expire'=>$expire,
        ];
    }
}
