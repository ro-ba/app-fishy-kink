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
    "notify" => "NotifyController",
    "DM" => "DMController",
    "myPage" => "MyPageController",
    "setting" => "SettingController",
    "FFlist" => "FFlistController"
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




