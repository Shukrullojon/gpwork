<?php

namespace App\Http\Controllers\Blade;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\AccountToCard;
use App\Models\Card;
use App\Models\History;
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
        $credit = History::where('credit','!=',0)->sum('credit');
        $account = Account::where('type',2)->first();
        $cards = Card::where('balance','!=',0)->sum('balance');
        $transferAmount = Transfer::where('status',4)->sum('debit_amount');

        $transferAmountCommsiion = Transfer::where('status',4)->sum('commission_amount');

        return view('pages.home.index', [
            'credit' => $credit,
            'account' => $account,
            'cards' => $cards,
            'transferAmount' => $transferAmount,

            'transferAmountCommsiion' => $transferAmountCommsiion,
        ]);
    }

}
