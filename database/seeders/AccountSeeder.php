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

        Account::create([
            'type' => 3,
            'user_id' => 1,
            'number' => '29896000800001186041',
            'inn' => '203556638',
            'name' => 'Комиссия по договору  № 15/23 от 15.05.2023г по проекту GIGPLATFORMWORK',
            'filial' => '01186',
            'balance' => 0,
        ]);
    }
}
