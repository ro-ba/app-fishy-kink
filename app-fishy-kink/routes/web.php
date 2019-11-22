<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});

Route::resources([
    "/" => "TopController",
    "login" => "LoginController",
    "logout" => "LogoutController",
    "signUp" => "SignUpController",
    "home" => "HomeController",
    "tweet" => "TweetController",
    "doubleCheck" => "DoubleCheckController",
    "notify" => "NotifyController",
    "DM" => "DMController",
    "profile" => "ProfileController",
    "settings" => "SettingsController",
    "FFlist" => "FFlistController",
    "search" => "SearchController",
    "test" => "TestController",
    "followers" => "FollowersController",
    "following" => "FollowingController",
    "/api/reloadTweets" => "API\ReloadTweetsController",
    "/api/reply"=> "API\ReplyController",
    "/api/favorite" => "API\FavoriteController",
    "/api/reTweet"=> "API\ReTweetController",
    "/api/getTweet" =>  "API\GetTweetController",
    "/api/getOriginTweet" =>  "API\GetOriginTweetController",
    "/api/getFollowing" => "API\GetFollowingController",
    "/api/getFollower" => "API\GetFollowerController",
    "/api/notifyCount" => "API\NotifyCountController"
    ]);

// Route::resource("/","TopController");
// Route::resource("login","LoginController");
// Route::resource("signup","SignUpController");
// Route::resource("home","HomeController");
// Route::resource("tweet","TweetController");
// Route::resource("notify","NotifyController");
// Route::resource("DM","DMController");
// Route::resource("mypage","MyPageController");
// Route::resource("setting","SettingController");
// Route::resource("setting","SettingController");
// Route::resource("FFlist","FFlistController");




