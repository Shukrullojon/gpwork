<?php

namespace App\Helpers\Api;

class CollectHelper
{
    public static function method($method){
        $method = explode('.',$method);

        $controller = ucwords($method[0])."Controller";
        return [
            'controller'=> $controller,
            'action' => $method[1],
        ];
    }
}
