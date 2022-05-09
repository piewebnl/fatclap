<?php

namespace App\Http\Controllers\Api;

use App\Helpers\DateHelper;
use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use App\Http\Requests\MenuItemWeekRequest;
use Illuminate\Http\JsonResponse;

class MenuItemWeekController extends Controller
{

    public function show(string $date): JsonResponse
    {

        $endDate = DateHelper::getDateByXNumberOfDays($date, 6);

        $menuItem = new MenuItem();
        $menuItems = $menuItem->getMenuItemsBetweenDates($date, $endDate);

        return response()->json($menuItems);
    }
}
