<?php

use App\Services\UserService;
use App\Tweet;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ExampleTest extends TestCase
{
    public function test_create_tweet_with_mock()
    {
        // setup
        $tweetText = 'My Tweet';

        $tweetMock = Mockery::mock(App\Tweet::class);
        $tweetMock->shouldReceive('create')->once()->andReturnUsing(function () use ($tweetText) {
            $tweetObj = new Tweet();
            $tweetObj->tweet = $tweetText;
            $tweetObj->user_id = 1;

            return $tweetObj;
        });

        $user = new User();
        $user->id = 1;

        // exercise
        $userService = new UserService($tweetMock);
        $newTweet = $userService->createTweet($tweetText, $user);

        // validate
        $this->assertEquals($newTweet->tweet, $tweetText);
    }
}
