<?php

namespace App\Observers;

use App\Models\MenuItem;
use Illuminate\Support\Facades\Auth;

class MenuItemObserver
{
    public function creating(MenuItem $model)
    {
        $model->user_id = Auth::user()->id;
    }
}
