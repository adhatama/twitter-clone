<?php
namespace App\Services;

use App\Mail\UserRegistration;
use App\Tweet;
use App\User;
use Illuminate\Support\Facades\Mail;

class UserService
{
    protected $tweet;

    // for example purpose
    public function __construct(Tweet $tweet)
    {
        $this->tweet = $tweet;
    }

    // for real feature
    public function sendRegistrationEmail(User $user)
    {
        Mail::to($user->email)->send(new UserRegistration($user));
    }

    // for example purpose
    public function createTweet($tweet, $user)
    {
        $newTweet = $this->tweet->create([
            'tweet' => $tweet,
            'user_id' => $user->id
        ]);

        return $newTweet;
    }
}
