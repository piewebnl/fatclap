<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Observers\ImageObserver;

class Image extends Model
{
    protected $fillable = [
        'imageable_id',
        'imageable_type',
        'name',
        'user_id'
    ];


    public static function boot()
    {
        parent::boot();
        parent::observe(new ImageObserver());
    }

    public function imageable()
    {
        return $this->morphTo();
    }
}
