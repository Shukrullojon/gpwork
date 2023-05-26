<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Api\V1\ValidationHelper;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Api\CollectHelper;

class MainController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), ValidationHelper::check($request->all()));
        if($validator->fails()){
            return response()->json([
                "jsonrpc" => "2.0",
                "status" => false,
                "origin" => $request->get('method'),
                "result" => null,
                "error" => $validator->errors(),
                "host" => [
                    'name' => config('app.name'),
                    'time_stamp' => date('Y-m-d H:i:s')
                ],
            ]);
        }
        $request_method = $request->get('method');
        $params = $request;
        $ch = CollectHelper::method($request_method);
        $service =  app()->make("\App\Http\Controllers\Api\V1\\".$ch['controller']);
        $service = new $service();
        $method = $ch['action'];
        $data = $service->$method($params);

        if(!array_key_exists("error",$data)){
            $message = [
                "jsonrpc" => "2.0",
                "status" => true,
                "origin" => $request_method,
                "result" =>$data,
                "error" => null,
                "host" => [
                    'name' => config('app.name'),
                    'time_stamp' => date('Y-m-d H:i:s')
                ],
            ];
        }else{
            $message = [
                "jsonrpc" => "2.0",
                "status" => false,
                "origin" => $request_method,
                "result" => null,
                'error' => $data['error'],
                "host" => [
                    'name' => config('app.name'),
                    'time_stamp' => date('Y-m-d H:i:s')
                ],
            ];
        }
        return response()->json($message);
    }
}
