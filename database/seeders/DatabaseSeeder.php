<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(MealtypeSeeder::class);
        $this->call(CookbookSeeder::class);
        $this->call(MealSeeder::class);
        $this->call(MenuItemSeeder::class);
        $this->call(MealImageSeeder::class);
    }
}
