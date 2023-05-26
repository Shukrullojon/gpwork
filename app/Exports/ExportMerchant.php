<?php

namespace App\Exports;

use App\Models\Pages\Merchant;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class ExportMerchant implements FromView
{

//    public function collection()
//    {
//        return  Payment::all();
//    }
    /**
    * @return \Illuminate\Support\Facades\View
    */

    public function view(): View
    {
        $merchants = Merchant::all();
        return view('pages.report.exports.export-merchant', [
            'merchants' => $merchants,
        ]);
    }
}
