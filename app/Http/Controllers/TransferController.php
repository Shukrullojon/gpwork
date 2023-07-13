<?php

namespace App\Http\Controllers;

use App\Models\Transfer;
use Illuminate\Http\Request;

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
}
