<?php

namespace Database\Seeders;

use App\Providers\ImageStorageServiceProvider;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MealImageSeeder extends Seeder
{
    public function run()
    {

        $imageServiceProvider = new ImageStorageServiceProvider('public', 'meals');

        // Loop through mealIds
        for ($i = 1; $i < 5; $i++) {

            $name = $i . '-' . date("Ymdhis");
            $testImage = Storage::disk('test')->get($i . '.jpg');
            $imageServiceProvider->uploadAndCreate($testImage, $name);

            DB::table('images')->insert(
                [
                    'id' => $i,
                    'user_id' => 1,
                    'name' => $name,
                    'imageable_id' => $i,
                    'imageable_type' => 'App\Models\Meal',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]
            );
        }
    }
}
