<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TweetController extends Controller
{
    public function create()
    {
        return view('tweet.create');
    }

    public function store(Request $request)
    {
        $countTweets = Auth::user()->countTweets();

        if ($countTweets > 5) {
            return redirect()->route('tweet.create')
                ->with(['status' => 'error', 'message' => 'Error! Tweet cannot be more than 5']);
        }

        Auth::user()->createTweet($request->tweet);

        return redirect()->route('tweet.create')->with(['status' => 'success', 'message' => 'Create tweet success!']);
    }
}
