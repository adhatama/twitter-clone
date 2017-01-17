<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TweetController extends Controller
{
    public function create()
    {
        return view('tweet.create');
    }

    public function store(Request $request)
    {
        Auth::user()->createTweet($request->tweet);
    }
}
