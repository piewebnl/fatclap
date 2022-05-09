<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MealSeeder extends Seeder
{
    public function run()
    {
        DB::table('meals')->insert(
            [
                'id' => '1',
                'user_id' => 1,
                'name' => 'Greens mac \'n\' cheese',
                'ingredients' => '1 large leek
3 cloves of garlic
400 g purple sprouting or tenderstem broccoli
40 g unsalted butter
½ a bunch of fresh thyme , (15g)
2 tablespoons plain flour
1 litre semi-skimmed milk
450 g dried macaroni
30 g Parmesan cheese
150 g mature Cheddar cheese
100 g baby spinach
50 g flaked almonds',
                'url' => 'https://www.jamieoliver.com/recipes/pasta-recipes/greens-mac-n-cheese/',
                'is_vegetarian' => true,
                'is_low_carb' => false,
                'calories' => 619,
                'carbs' => 75,
                'fats' => 25,
                'proteins' => 29,
                'mealtype_id' => 3,
                'cookbook_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );

        DB::table('meals')->insert(
            [
                'id' => '2',
                'user_id' => 1,
                'name' => 'French fries',
                'ingredients' => 'Potatoes',
                'preperation' => '',
                'url' => '',
                'is_vegetarian' => 1,
                'is_low_carb' => 0,
                'calories' => 215,
                'carbs' => 25.1,
                'fats' => 11.5,
                'proteins' => 2.5,
                'mealtype_id' => 4,
                'cookbook_id' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );

        DB::table('meals')->insert(
            [
                'id' => '3',
                'user_id' => 1,
                'name' => 'Melanzane parmigiana',
                'ingredients' => '',
                'preperation' => '',
                'url' => '',
                'is_vegetarian' => true,
                'is_low_carb' => false,
                'calories' => 500,
                'carbs' => 50,
                'fats' => 200,
                'proteins' => 40,
                'mealtype_id' => 3,
                'cookbook_id' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );

        DB::table('meals')->insert(
            [
                'id' => '4',
                'user_id' => 1,
                'name' => 'Chocolate Sprinkled Sandwich',
                'ingredients' => '',
                'preperation' => '',
                'url' => '',
                'is_vegetarian' => true,
                'is_low_carb' => false,
                'calories' => 200,
                'carbs' => 75,
                'fats' => 20,
                'proteins' => 10,
                'mealtype_id' => 5,
                'cookbook_id' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );
    }
}
