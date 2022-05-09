<?php

namespace App\Observers;

use App\Models\Image;
use Illuminate\Support\Facades\Auth;

class ImageObserver
{
    public function creating(Image $model)
    {
        $model->user_id = Auth::user()->id;
    }
}
