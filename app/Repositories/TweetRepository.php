<?php
namespace App\Repositories;

use App\Tweet;

class TweetRepository
{
    protected $model;

    public function __construct(Tweet $tweet)
    {
        $this->model = $tweet;
    }

    public function getLatestTweets($userId)
    {
        return $this->model->where('user_id', $userId)->orderBy('created_at', 'desc')->get()->toArray();
    }
}