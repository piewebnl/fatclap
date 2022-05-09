<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MealRequest;
use App\Models\Meal;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class MealController extends Controller
{

    private $itemsPerPage;

    public function index(): JsonResponse
    {

        $this->itemsPerPage = config('fatclap.items_per_page');

        $meals = Meal::where('user_id', Auth::id())
            ->orderBy('created_at', 'DESC')
            ->paginate($this->itemsPerPage);

        return response()->json($meals);
    }


    public function show(int $id): JsonResponse
    {
        $meal = Meal::where('user_id', Auth::id())->findOrFail($id)->toArray();

        return response()->json($meal);
    }


    public function store(MealRequest $request): JsonResponse
    {
        return $this->storeOrUpdate($request, null);
    }


    public function update(MealRequest $request, int $id): JsonResponse
    {
        return $this->storeOrUpdate($request, $id);
    }


    private function storeOrUpdate($request, ?int $id  = null): JsonResponse
    {

        // user_id via MealObserver
        $meal = Meal::UpdateOrCreate(
            ['id' => $id],
            [
                'name' => $request->input('name'),
                'mealtype_id' => $request->input('mealtype_id'),
                'cookbook_id' => $request->input('cookbook_id'),
                'ingredients' => $request->input('ingredients'),
                'preperation' => $request->input('preperation'),
                'description' => $request->input('description'),
                'is_vegetarian' => (bool) $request->input('is_vegetarian'),
                'is_low_carb' => (bool) $request->input('is_low_carb'),
                'url' => $request->input('url'),
                'calories' => $request->input('calories'),
                'carbs' => $request->input('carbs'),
                'fats' => $request->input('fats'),
                'proteins' => $request->input('proteins'),
            ]
        );

        // Load the meal again (with relations)
        $foundMeal = Meal::findOrFail($meal->id)->toArray();

        return response()->created('Meal stored', $foundMeal);
    }


    public function destroy(int $id): JsonResponse
    {
        $meal = Meal::findOrFail($id);
        $meal->delete();

        return response()->deleted('Meal deleted');
    }
}
