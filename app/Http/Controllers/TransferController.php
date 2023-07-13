<?php

namespace App\Http\Controllers;

use App\Exports\TransferExport;
use App\Models\Transfer;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;

class TransferController extends Controller
{
    public function index(Request $request){
        $transfers = new Transfer();
        if (isset($request->status)){
            if($request->status == 4)
                $transfers = $transfers->where('status',4);
            else
                $transfers = $transfers->where('status','!=',4);
        }
        $transfers = $transfers->latest()->paginate(20);
        return view('pages.transfer.index',[
            'transfers' => $transfers,
        ]);
    }

    public function export(Request $request)
    {
        $data = Transfer::select(
            'sender',
            'receiver',
            'amount',
            "credit_amount",
            "debit_amount",
            "commission_amount",
            "rate",
            "status",
            "created_at"
        )->where('status', 4);

        $data = $data->get()->toArray();
        return Excel::download(new TransferExport($data), time() . '.xlsx');
    }
}
