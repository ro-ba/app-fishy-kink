<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// require "/vagrant/source/pigHuman/myPage.php";
require "/vagrant/source/pigHuman/myPageSetting.php";
require "/vagrant/source/komaduki/GetTweet.php";
// require "/vagrant/source/func/FKSession.php";
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
        $id = session('userID');
        $FishyKink = connect_mongo();
        $userData = $FishyKink["userDB"]->findOne(["userID"=>$id]);
        return view("setting",compact("userData"));
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
        $result = myPageSetting($id, $request,$FishyKink);
        return $result;
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

