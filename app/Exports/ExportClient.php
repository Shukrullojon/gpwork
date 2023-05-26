<?php

namespace App\Exports;

use App\Models\Pages\Client;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class ExportClient implements FromView
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
        $clients = Client::all();
        return view('pages.report.exports.export-client', [
            'clients' => $clients,
        ]);
    }
}
