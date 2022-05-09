<?php

namespace App\Observers;

use App\Models\Cookbook;
use Illuminate\Support\Facades\Auth;

class CookbookObserver
{
    public function creating(Cookbook $model)
    {
        $model->user_id = Auth::user()->id;
    }
}
