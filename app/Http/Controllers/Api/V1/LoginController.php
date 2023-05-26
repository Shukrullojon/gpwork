<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function login($params){
        try {
            $user = User::where('email', $params['params']['email'])->first();
            if ($user) {
                if (Hash::check($params['params']['password'], $user->password)){
                    $user->token = Str::random(80);
                    $user->save();
                    return [
                        'token' => $user->token
                    ];
                }else{
                    return [
                        'error' => [
                            'code' => 401,
                            'message' => [
                                'uz' => "Parol noto'g'ri. Iltimos, yana bir bor urinib ko'ring",
                                'ru' => "Неверный пароль. Пожалуйста, попробуйте еще раз",
                                'en' => "Password incorrect. please try again"
                            ],
                        ],
                    ];
                }
            }
            return [
                'error' => [
                    'code' => 402,
                    'message' => [
                        'uz' => "Foydalanuvchi topilmadi",
                        'ru' => "Пользователь не найден",
                        'en' => "User not found"
                    ],
                ],
            ];
        }catch (\Exception $exception){
            return $this->errorException($exception);
        }
    }

    public function errorException($exception){
        return [
            'error' => [
                'code' => 500,
                'message' => [
                    'uz' => $exception->getMessage(),
                    'ru' => $exception->getMessage(),
                    'en' => $exception->getMessage(),
                ],
            ],
        ];
    }
}
