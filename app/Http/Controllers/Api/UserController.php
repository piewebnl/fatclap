<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function show(): Object
    {
        $user = User::select(['name', 'calories', 'carbs', 'fats', 'proteins'])->where('id', Auth::id())->first();
        return response()->json($user);
    }
}
