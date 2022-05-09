<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use Illuminate\Http\JsonResponse;

class MenuItemDayController extends Controller
{

    public function show(string $date): JsonResponse
    {

        $menuItem = new MenuItem();
        $menuItems = $menuItem->getMenuItemsByDate($date);

        return response()->json($menuItems);
    }

}
