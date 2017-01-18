<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users/getTweets/{id}', ['uses' => 'UserController@getTweets', 'as' => 'users.getTweets']);
Route::resource('users', 'UserController');
Route::resource('tweet', 'TweetController');

Auth::routes();

Route::get('/home', 'HomeController@index');
