<?php

use App\Events\UserCreated;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_create_user()
    {
        // setup
        $this->expectsEvents(UserCreated::class);

        // exercise
        $response = $this->call('POST', route('users.store'), [
            'name' => 'tama',
            'email' => 'akbar@javan.co.id',
            'password' => 'asd',
            'confirmPassword' => 'asd'
        ]);

        // verify
        $this->assertRedirectedTo(route('users.create'));

        $this->seeInDatabase('users', [
            'name' => 'tama',
            'email' => 'akbar@javan.co.id'
        ]);
    }

    public function test_show_users_tweets()
    {
        // setup
        $userA = factory(App\User::class)->create();
        $tweetA = $userA->createTweet('My First Tweet');
        $tweetB = $userA->createTweet('My Second Tweet');

        // exercise
        $tweets = $userA->getTweets();

        // verify
        $this->assertEquals(2, $tweets->count());
        $this->seeInDatabase('tweets', ['tweet' => $tweetA->tweet]);
        $this->seeInDatabase('tweets', ['tweet' => $tweetB->tweet]);

    }
}
