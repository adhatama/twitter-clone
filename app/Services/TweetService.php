<?php
namespace App\Services;

use App\Mail\UserRegistration;
use App\Repositories\TweetRepository;
use App\Tweet;
use App\User;
use Illuminate\Support\Facades\Mail;

class TweetService
{
    protected $tweetRepository;

    public function __construct(TweetRepository $tweetRepository)
    {
        $this->tweetRepository = $tweetRepository;
    }

    public function getTweets($userId)
    {
        return $this->tweetRepository->getLatestTweets($userId);
    }
}
