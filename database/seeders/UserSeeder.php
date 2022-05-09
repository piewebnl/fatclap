<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Demo',
            'email' => 'info@pieweb.nl',
            'password' => Hash::make('9tjF#ger7De'),
            'email_verified_at' => date("Y-m-d h:i:s"),
            'calories' => 1500,
            'carbs' => 500,
            'fats' => 100,
            'proteins' => 50,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

        ]);
    }
}
