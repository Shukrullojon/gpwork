<?php

namespace App\Http\Controllers;

use App\Models\Transfer;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    public function index(Request $request){
        $transfers = Transfer::latest()->paginate(20);
        return view('pages.transfer.index',[
            'transfers' => $transfers,
        ]);
    }
}
