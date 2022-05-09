<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CookbookSeeder extends Seeder
{
    public function run()
    {
        DB::table('cookbooks')->insert(
            [
                'id' => '1',
                'name' => 'Jamie Oliver Veg',
                'user_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );
        DB::table('cookbooks')->insert(
            [
                'id' => '2',
                'name' => 'Ottolenghi Simple',
                'user_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );
    }
}
