<?php

namespace App\Models;

use App\Observers\MenuItemObserver;
use App\Http\Requests\MenuItemRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class MenuItem extends Model
{

    protected $fillable = [
        'date',
        'order',
        'meal_id',
        'user_id',
    ];

    protected $appends = ['move_amount']; // attribute for swapping order

    public static function boot()
    {
        parent::boot();
        parent::observe(new MenuItemObserver());
    }


    public function meal()
    {
        // meal_id relation to meals
        return $this->belongsTo('App\Models\Meal');
    }


    public function shiftOrdersUp(int $id, string $date, int $start, int $end)
    {
        // Find which items to re-order
        $menuItems = MenuItem::where('menu_items.user_id', Auth::id())
            ->where('id', '!=', $id)
            ->where('date', '=', $date)
            ->whereBetween('order', [$start, $end])
            ->get();

        foreach ($menuItems as $menuItem) {
            MenuItem::find($menuItem->id)->increment('order');
        }
    }

    public function shiftOrdersDown(int $id, string $date, int $start, int $end)
    {

        // Find which items to re-order
        $menuItems = MenuItem::where('menu_items.user_id', Auth::id())
            ->where('id', '!=', $id)
            ->where('date', '=', $date)
            ->whereBetween('order', [$start, $end])
            ->get();

        foreach ($menuItems as $menuItem) {
            MenuItem::find($menuItem->id)->decrement('order');
        }
    }


    public function getMenuItemsBetweenDates(string $dateStart, string $dateEnd)
    {
        return MenuItem::with('meal.mealtype')
            ->whereBetween('menu_items.date', [$dateStart, $dateEnd])
            ->where('menu_items.user_id', Auth::id())
            ->orderBy('menu_items.date')
            ->orderBy('order')
            ->get();
    }

    public function getMenuItemsByDate(string $date)
    {
        return MenuItem::with('meal.mealtype')
            ->where('menu_items.user_id', Auth::id())
            ->where('menu_items.date', $date)
            ->orderBy('order')
            ->get();
    }

    public function getLastTimeOnMenu(int $mealId)
    {
        $menuItems = MenuItem::where('meal_id', $mealId)
            ->where('menu_items.user_id', Auth::id())
            ->orderBy('date', 'DESC')
            ->first();

        if (isset($menuItems->date)) {
            return $menuItems->date;
        }
    }

    public function getMoveAmountAttribute()
    {
        return null;
    }
}
