<?php

namespace App\Models;

use App\Observers\CookbookObserver;
use Illuminate\Database\Eloquent\Model;


class Cookbook extends Model
{
    protected $fillable = [
        'name',
        'user_id',
    ];

    public static function boot()
    {
        parent::boot();
        parent::observe(new CookbookObserver());
    }


    public function meal()
    {
        return $this->hasMany('App\Models\Meal');
    }
}
