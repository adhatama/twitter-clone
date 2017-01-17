<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function follow(Request $request)
    {
        $followedUser = User::find($request->followed_user_id);

        Auth::user()->follow($followedUser);
    }
}
