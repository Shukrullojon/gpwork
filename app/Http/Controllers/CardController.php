<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function index(Request $request){
        $cards = Card::latest()->paginate(20);
        return view('pages.card.index',[
            'cards' => $cards,
        ]);
    }

    public function show($id){
        $card = Card::find($id);
        return view('pages.card.show',[
            'card' => $card,
        ]);
    }
}
