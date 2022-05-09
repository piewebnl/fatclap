<?php

namespace App\Scopes;


trait MealScopesTrait
{
    public function scopeSearchByKeyword(object $query, ?string $keyword)
    {
        if (isset($keyword) and $keyword !== '') {
            return $query->where('name', 'like', '%' . $keyword . '%')
                ->orWhere('ingredients', 'like', '%' . $keyword . '%');
        }
    }

    public function scopeMealtype(object $query, ?string $mealtype)
    {
        if (isset($mealtype) and $mealtype !== '') {
            return $query->where('mealtype_id', $mealtype);
        }
    }

    public function scopeCookbook(object $query, ?string $cookbook)
    {
        if (isset($cookbook) and $cookbook !== '') {
            return $query->where('cookbook_id', $cookbook);
        }
    }


    public function scopeIsVegetarian(object $query, ?string $isVegetarian)
    {
        if (isset($isVegetarian)) {
            $trueOrFalse = filter_var($isVegetarian, FILTER_VALIDATE_BOOLEAN);
            return $query->where('is_vegetarian', $trueOrFalse);
        }
    }

    public function scopeLowCarbsFilter(object $query, ?string $lowCarbsFilter)
    {
        if (isset($lowCarbsFilter)) {
            $trueOrFalse = filter_var($lowCarbsFilter, FILTER_VALIDATE_BOOLEAN);
            return $query->where('is_low_carb', $trueOrFalse);
        }
    }
}
