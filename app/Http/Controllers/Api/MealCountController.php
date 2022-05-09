<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Meal;
use App\Models\MenuItem;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\MealCountRequest;

/**
 * Handles how many times and latest date a meal was on the menu
 */
class MealCountController extends Controller
{
    public function update(MealCountRequest $request): JsonResponse
    {

        $id = $request['id'];
        $addOrDelete = $request['add_or_delete'];

        // Increment count ++
        if ($addOrDelete === 'add') {
            Meal::where('id', $id)->increment('count', 1, ['last_time_on_menu' => Carbon::now()->toDateTimeString()]);
        }

        // Decrease count --
        if ($addOrDelete === 'delete') {

            // Retrieve last time on menu first
            $latest = MenuItem::where('meal_id', $id)->latest("updated_at")->value('updated_at');

            Meal::where('id', $id)->where("count", '>', 0)->decrement('count', 1, ['last_time_on_menu' => $latest]);
        }

        $meal = Meal::findOrFail($id)->toArray();

        return response()->created('Meal count updated', $meal);
    }
}
