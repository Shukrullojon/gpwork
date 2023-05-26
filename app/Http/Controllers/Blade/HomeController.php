<?php

namespace App\Http\Controllers\Blade;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        //$this->middleware(['auth', 'permission:home.show'])->only('show');
    }

    public function index(Request $request)
    {
        return view('pages.home.index', [

        ]);
    }

}
