<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MealtypeSeeder extends Seeder
{
    public function run()
    {
        DB::table('mealtypes')->insert(
            [
                'id' => '1',
                'name' => 'Breakfast',
                'user_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );
        DB::table('mealtypes')->insert(
            [
                'id' => '2',
                'name' => 'Lunch',
                'user_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );
        DB::table('mealtypes')->insert(
            [
                'id' => '3',
                'name' => 'Diner',
                'user_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );
        DB::table('mealtypes')->insert(
            [
                'id' => '4',
                'name' => 'Snack',
                'user_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );
        DB::table('mealtypes')->insert(
            [
                'id' => '5',
                'name' => 'Ingredient',
                'user_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );
    }
}
