<?php

namespace App\Observers;

use App\Models\Mealtype;
use Illuminate\Support\Facades\Auth;

class MealTypeObserver
{
    public function creating(Mealtype $model)
    {
        $model->user_id = Auth::user()->id;
    }
}
