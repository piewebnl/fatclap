<?php

namespace App\Observers;

use App\Models\Meal;
use Illuminate\Support\Facades\Auth;

class MealObserver
{
    public function creating(Meal $model)
    {
        $model->user_id = Auth::user()->id;
    }
}
