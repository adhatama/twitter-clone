<?php

use App\Tweet;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class TweetTest extends TestCase
{
    use DatabaseTransactions;

    public function test_show_create_tweet_page()
    {
        // exercise
        $response = $this->call('GET', route('tweet.create'));

        // verify
        $this->assertEquals(200, $response->status());
    }

    // masih kurang test controllernya karena untuk tau user sudah login belum nya belum tau.
    public function test_user_create_a_tweet()
    {
        // setup
        $user = factory(App\User::class)->create();

        // exercise
        $user->createTweet('My tweet!');

        // verify
        $this->seeInDatabase('tweets', ['tweet' => 'My tweet!']);
    }

    public function test_user_create_a_tweet_with_login()
    {
        // setup
        $user = factory(App\User::class)->create();

        // exercise
        $response = $this->actingAs($user)->call('POST', route('tweet.store'), ['tweet' => 'My Lovely Tweet!']);

        // verify
        $this->assertEquals(302, $response->status());
        $this->assertRedirectedTo(route('tweet.create'));
        $this->seeInDatabase('tweets', ['tweet' => 'My Lovely Tweet!']);
    }

    public function test_max_tweet_created_per_user()
    {
        // setup
        $user = factory(App\User::class)->create();

        foreach (range(1, 5) as $i) {
            $user->createTweet('My tweet ' . $i);
        }

        // exercise
        $response = $this->actingAs($user)->call('POST', route('tweet.store'), ['tweet' => 'My failed tweet']);

        // verify
        $this->assertEquals(302, $response->status());
        $this->assertEquals('error', session('status'));
        $this->notSeeInDatabase('tweets', ['tweet' => 'My failed tweet']);
    }

    public function test_user_follow_someone()
    {
        // setup
        $userOne = factory(App\User::class)->create();
        $userTwo = factory(App\User::class)->create();

        // exercise
        $userOne->follow($userTwo);

        // verify
        $this->seeInDatabase('user_follows', [
            'user_id' => $userOne->id,
            'follow_id' => $userTwo->id
        ]);

        $this->assertGreaterThan(0, $userOne->follows()->count());

        $this->assertGreaterThan(0, $userTwo->followers()->count());
    }
}
