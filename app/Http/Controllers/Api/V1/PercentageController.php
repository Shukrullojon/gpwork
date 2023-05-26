<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Percentage;

class PercentageController extends Controller
{
    public function get($params)
    {
        $percentages = Percentage::select(
            'method',
            'percentage',
            'info',
        )->where('user_id',$params['user']['id'])->get();
        return [
            'percentages' => $percentages,
        ];
    }

}
