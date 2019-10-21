<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// require "/vagrant/source/pigHuman/myPage.php";
require "/vagrant/source/pigHuman/myPageSetting.php";
require "/vagrant/source/komaduki/GetTweet.php";
// require "/vagrant/source/func/FKSession.php";
require "/vagrant/source/func/FKMongo.php";


class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = session('userID');
        $FishyKink = connect_mongo();
        $userData = $FishyKink["userDB"]->findOne(["userID"=>$id]);
        return view("settings",compact("userData"));
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
        $FishyKink = connect_mongo();
        $id = session('userID');

        $name = $request->input("userName");
        $profile = $request->input("profileText");
        if(empty($name)){ //userNameが空だったら
            return "変更できませんでした。";
        }else{ //空じゃなかったら変更
            $FishyKink["userDB"]->updateOne(["userID" => $id], ['$set'=> ["userName" => $name , "profile" => $profile]]);
            return "変更しました。";
        }
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
