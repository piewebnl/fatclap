<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MealFilterRequest;
use App\Models\Meal;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

/**
 * Handles meal search filter (form requests)
 */
class MealFilterController extends Controller
{
    private $itemsPerPage;

    public function index(MealFilterRequest $request): JsonResponse
    {
        $this->itemsPerPage = config('fatclap.items_per_page');

        $keyword = $request->input('keyword', '');
        $order = $request->input('order', 'created_at');
        $ascOrDesc = $request->input('asc_or_desc', 'ASC');
        $mealtype = $request->input('mealtype', null);
        $cookbook = $request->input('cookbook', null);
        $isVegetarian = $request->input('is_vegetarian', null);

        $keyword = $request->input('keyword', '');

        $meals = Meal::where('user_id', Auth::id())
            ->searchBykeyword($keyword)
            ->mealtype($mealtype)
            ->cookbook($cookbook)
            ->isVegetarian($isVegetarian)
            ->orderBy($order, $ascOrDesc)
            ->paginate($this->itemsPerPage);


        return response()->json($meals);
    }
}
