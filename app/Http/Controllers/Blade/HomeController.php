<?php

namespace App\Http\Controllers\Blade;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\AccountToCard;
use App\Models\Transfer;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        //$this->middleware(['auth', 'permission:home.show'])->only('show');
    }

    public function index(Request $request)
    {
        $account = Account::where('type',2)->first();
        $toCardAmount = AccountToCard::where('status',4)->sum('amount');
        $transferAmount = Transfer::where('status',4)->sum('debit_amount');
        return view('pages.home.index', [
            'account' => $account,
            'toCardAmount' => $toCardAmount,
            'transferAmount' => $transferAmount,
        ]);
    }

}
