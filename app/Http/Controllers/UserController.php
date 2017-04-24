<?php

namespace App\Http\Controllers;

use App\Events\UserCreated;
use App\Repositories\TweetRepository;
use App\Services\UserService;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function create()
    {
        return view('users.create');
    }

    // public function store(Request $request)
    // {
    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => bcrypt($request->password)
    //     ]);

    //     return redirect()->route('users.create')->with('message', 'User Created!');
    // }

    public function store(Request $request)
    {
        $userFound = User::where('email', $request->email)->count();

        if ($userFound > 0) {
            return redirect()->route('users.create')->with('message', 'Failed! Email already registered');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        event(new UserCreated($user));

        return redirect()->route('users.create')->with('message', 'User Created!');
    }

    public function follow(Request $request)
    {
        $followedUser = User::find($request->followed_user_id);

        Auth::user()->follow($followedUser);
    }

    public function getTweets(Request $request)
    {
        $user = User::find($request->id);
        $tweets = $this->userService->getTweets($user->id);

        return view('users.showTweets', compact('tweets'));
    }
}
