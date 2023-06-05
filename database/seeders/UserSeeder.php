<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name" => "Shukrullo",
            "email" => "shukrullobk@gmail.com",
            "token" => Str::random(80),
            "password" => Hash::make('1272256a'),
            "theme" => "default",
            "created_at" => date("Y-m-d H:i:s"),
            "updated_at" => date("Y-m-d H:i:s"),
        ]);

        User::create([
            "name" => "GPWORK",
            "email" => "gpworkucoin@gmail.com",
            "token" => Str::random(80),
            "password" => Hash::make('GPWORK_Whf9r'),
            "theme" => "default",
            "created_at" => date("Y-m-d H:i:s"),
            "updated_at" => date("Y-m-d H:i:s"),
        ]);
    }
}
