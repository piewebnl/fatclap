<?php

namespace App\Models;

use App\Observers\MealTypeObserver;
use Illuminate\Database\Eloquent\Model;


class Mealtype extends Model
{
    protected $fillable = [
        'name',
        'color',
        'user_id',
    ];

    public static function boot()
    {
        parent::boot();
        parent::observe(new MealTypeObserver());
    }

    public function meal()
    {
        return $this->hasMany('App\Models\Meal');
    }
}
