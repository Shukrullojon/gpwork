<?php

namespace App\Helpers\Api\V1;

class ErrorHelper
{

    /**
     */
    public static function error300():array{
        return [
            'error' => [
                'code' => 300,
                "message" => [
                    "uz" => "To'lovda xatolik",
                    "ru" => "To'lovda xatolik",
                    "en" => "To'lovda xatolik",
                ],
            ],
        ];
    }

    public static function error301():array{
        return [
            'error' => [
                'code' => 301,
                "message" => [
                    "uz" => "Pul yetarli emas",
                    "ru" => "Не хватает денег",
                    "en" => "Do not have enough money",
                ],
            ],
        ];
    }

    public static function error302():array{
        return [
            'error' => [
                'code' => 301,
                "message" => [
                    "uz" => "500 ming dan kam to'lov qilib bo'lmaydi.",
                    "ru" => "Меньше 500 тысяч заплатить невозможно.",
                    "en" => "It is not possible to pay less than 500 thousand.",
                ],
            ],
        ];
    }
}
