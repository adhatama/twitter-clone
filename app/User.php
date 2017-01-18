<?php

namespace App;

use App\Tweet;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function tweets()
    {
        return $this->hasMany('App\Tweet');
    }

    public function follows()
    {
        return $this->belongsToMany('App\User', 'user_follows', 'user_id', 'follow_id');
    }

    public function followers()
    {
        return $this->belongsToMany('App\User', 'user_follows', 'follow_id', 'user_id');
    }

    public function createTweet($tweet)
    {
        $newTweet = Tweet::create([
            'tweet' => $tweet,
            'user_id' => $this->id
        ]);

        return $newTweet;
    }

    public function follow($followedUser)
    {
        $this->follows()->attach($followedUser);

        return $this;
    }

    public function getTweets()
    {
        return Tweet::where('user_id', $this->id)->get();
    }

    public function countTweets()
    {
        return Tweet::where('user_id', $this->id)->count();
    }
}
