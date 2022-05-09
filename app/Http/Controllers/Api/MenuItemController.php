<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use App\Http\Requests\MenuItemRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuItemController extends Controller
{


    public function show(int $id): JsonResponse
    {
        $menuItem = MenuItem::where('user_id', Auth::id())->findOrFail($id)->toArray();

        return response()->json($menuItem);
    }


    public function store(MenuItemRequest $request): JsonResponse
    {
        $menuItem = MenuItem::create(
            [
                'meal_id' => $request->input('meal_id'),
                'order' => $request->input('order'),
                'date' => $request->input('date'),
            ]
        )->toArray();

        return response()->created('Menu item added', $menuItem);
    }


    public function update(MenuItemRequest $request, int $id): JsonResponse
    {

        // Set the new order of the moved menu item
        MenuItem::find($id)->update(
            [
                'meal_id' => $request->input('meal_id'),
                'order' => $request->input('order'),
                'date' => $request->input('date'),
            ]
        );

        $updatedMenuItem = MenuItem::find($id)->toArray();

        return response()->created('Menu item updated', $updatedMenuItem);
    }


    public function updateAndShiftUp(Request $request, int $id): JsonResponse
    {

        $date = $request->input('date');
        $order = $request->input('order');
        $moveAmount = $request->input('move_amount');

        // Set the new order of the moved menu item
        MenuItem::find($id)->update(['order' => $order]);

        // Update order of all after
        $menuItem = new MenuItem();
        $menuItem->shiftOrdersUp($id, $date, $order, $order + $moveAmount);

        return response()->created('Menu items shifted up');
    }


    public function updateAndShiftDown(Request $request, int $id): JsonResponse
    {

        $date = $request->input('date');
        $order = $request->input('order');
        $moveAmount = $request->input('move_amount');

        // Set the new order of the moved menu item
        MenuItem::find($id)->update(['order' => $order]);

        // Update order of all after
        $menuItem = new MenuItem();
        $menuItem->shiftOrdersDown($id, $date, $order - $moveAmount, $order);

        return response()->created('Menu items shifted down');
    }


    public function destroy(int $id): JsonResponse
    {

        $menuItem = MenuItem::findOrFail($id);
        $date = $menuItem->date;
        $order = $menuItem->order;

        $menuItem->delete();

        // Fix the order of items on same list
        $totalMenuItems = MenuItem::where('user_id', Auth::id())->where('date', $date)->count();

        // Update order of all after
        $menuItem = new MenuItem();
        $menuItem->shiftOrdersDown($id, $date, $order + 1, $totalMenuItems);

        return response()->deleted('Menu item deleted');
    }
}
