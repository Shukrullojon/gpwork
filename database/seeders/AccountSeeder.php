<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Account::create([
            'type' => 2,
            'user_id' => 1,
            'number' => '22640000200001186007',
            'inn' => '203556638',
            'name' => 'ЭД по договору 15/23 от 15.05.2023г (Unired)',
            'filial' => '01186',
            'balance' => 0,
        ]);
    }
}
