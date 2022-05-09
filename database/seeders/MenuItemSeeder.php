<?php

namespace Database\Seeders;

use App\Providers\ImageStorageServiceProvider;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuItemSeeder extends Seeder
{

    public function run()
    {
        $today = Carbon::now();
        $tomorrow = Carbon::tomorrow();

        DB::table('menu_items')->insert(
            [
                'id' => 1,
                'user_id' => 1,
                'meal_id' => 1,
                'date' => $today->format("y-m-d"),
                'order' => 0,
                'created_at' => $today,
                'updated_at' => $today,
            ]
        );

        DB::table('menu_items')->insert(
            [
                'id' => 2,
                'user_id' => 1,
                'meal_id' => 2,
                'date' => $today->format("y-m-d"),
                'order' => 1,
                'created_at' => $today,
                'updated_at' => $today,
            ]
        );

        DB::table('menu_items')->insert(
            [
                'id' => 3,
                'user_id' => 1,
                'meal_id' => 3,
                'date' => $today->format("y-m-d"),
                'order' => 2,
                'created_at' => $today,
                'updated_at' => $today,
            ]
        );
        DB::table('menu_items')->insert(
            [
                'id' => 4,
                'user_id' => 1,
                'meal_id' => 4,
                'date' => $today->format("y-m-d"),
                'order' => 3,
                'created_at' => $today,
                'updated_at' => $today,
            ]
        );
        DB::table('menu_items')->insert(
            [
                'id' => 5,
                'user_id' => 1,
                'meal_id' => 2,
                'date' => $tomorrow->format("y-m-d"),
                'order' => 0,
                'created_at' => $today,
                'updated_at' => $today,
            ]
        );
    }
}
