<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransferExport implements FromCollection, WithHeadings
{

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function headings():array{
        return [
            'sender',
            'receiver',
            'amount',
            "credit_amount",
            "debit_amount",
            "commission_amount",
            "rate",
            "status",
            "created_at"
        ];
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return collect($this->data);
    }
}
