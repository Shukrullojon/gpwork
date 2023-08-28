<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\History;
use App\Services\AbsService;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    public function update($params){
        $account = Account::where('type', 2)->first();
        $service = AbsService::getAccountHistory([
            'account' => $account->number,
            'date' => "20.08.2023",
            'filial' => $account->filial,
        ]);
        if (isset($service['result']['responseBody']['response']) and $service['result']['responseBody']['response']) {
            foreach ($service['result']['responseBody']['response'] as $d){
                History::firstOrCreate(
                    [
                        'numberTrans' => $d['numberTrans']
                    ],
                    [
                        'date' => date('Y-m-d', strtotime($d['date'])),
                        'dtAcc' => $d['dtAcc'],
                        'dtAccName' => $d['dtAccName'],
                        'dtMfo' => $d['dtMfo'],
                        'purpose' => $d['purpose'],
                        'debit' => $d['debit'] * 100,
                        'credit' => $d['credit'] * 100,
                        'numberTrans' => $d['numberTrans'],
                        'type' => $d['type'],
                        'ctAcc' => $d['ctAcc'],
                        'ctAccName' => $d['ctAccName'],
                        'ctMfo' => $d['ctMfo'],
                        'status' => 0,
                    ]);
            }
        }

        $creditAmount = History::select(DB::raw("sum(credit) as credit"))->where('status',0)->where('credit','!=',0)->first();
        if(!empty($creditAmount)){
            $account->update([
                'balance' => $account->balance + $creditAmount->credit
            ]);
            History::where('status',0)->where('credit','!=',0)->update([
                'status' => 1,
            ]);
        }
        return [];
    }
}
