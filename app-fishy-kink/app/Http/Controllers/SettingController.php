<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
require "/vagrant/source/pigHuman/myPage.php";
require "/vagrant/source/pigHuman/myPageSetting.php";
require "/vagrant/source/komaduki/GetTweet.php";
require "/vagrant/source/func/FKSession.php";
require "/vagrant/source/func/FKMongo.php";

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $FishyKink = connect_mongo();
        $userData = dbUser($FishyKink);
        $tweetData = dbTweet($FishyKink);
        return view("setting",compact("userData","tweetData"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = session('userID');
        // myPageSetting($request,$FishyKink);
        $db["userDB"] -> update(array($id),[
            "userName" => $request->input("userName"),
            // "userImg" => 'data:image/' . $ext . ';base64,' . $encode_img,
            "profile" => $request->input("profile")
        ]);
        return view("myPage");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
