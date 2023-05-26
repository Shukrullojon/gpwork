<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class ApiCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->method == "login.login")
        {
            return $next($request);
        }
        else
        {
            $user = User::where('token',$request->bearerToken())->first();
            if(!empty($user)){
                $request->request->set('user',$user);
                return $next($request);
            }else {
                $message = [
                    "jsonrpc" => "2.0",
                    "status" => false,
                    "error" => [
                        "code" => "404",
                        "message" => [
                            'uz' => "User topilmadi",
                            "ru" => "User не найден",
                            "en" => "User not found",
                        ],
                    ],
                    'host' => [
                        'name' => config('app.name'),
                        'time_stamp' => date('Y-m-d H:i:s', time())
                    ]
                ];
                return response()->json($message);
            }
        }
    }
}
