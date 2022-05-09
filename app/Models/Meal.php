<?php

namespace App\Models;

use App\Observers\MealObserver;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use \App\Scopes\MealScopesTrait;

    protected $fillable = [
        'name',
        'mealtype_id',
        'cookbook_id',
        'ingredients',
        'preperation',
        'description',
        'url',
        'is_vegetarian',
        'is_low_carb',
        'calories',
        'carbs',
        'fats',
        'proteins',
        'count',
        'last_time_on_menu',
        'user_id',
    ];

    // Always return with mealtype
    public $with = ['mealtype', 'cookbook', 'images'];

    protected $casts = [
        'is_vegetarian' => 'boolean',
        'is_low_carb' => 'boolean'
    ];


    public static function boot()
    {
        parent::boot();
        parent::observe(new MealObserver());
    }

    public function mealtype()
    {
        return $this->belongsTo('App\Models\Mealtype');
    }

    public function cookbook()
    {
        return $this->belongsTo('App\Models\Cookbook');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    // Update count of the meal and set date "last time on the menu"
    public function updateCountAndLastDate(int $id, string $addedOrDeleted)
    {
        $meal = Meal::find($id);

        $menuItem = new MenuItem();
        $meal->last_time_on_menu = $menuItem->getLastTimeOnMenu($id);

        // Add or substract?
        if ($meal->count === null or $meal->count > 0) {
            if ($addedOrDeleted === 'deleted') {
                $meal->count--;
            } else {
                $meal->count++;
            }
        }
        $meal->save();
    }
}
