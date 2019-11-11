<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
require "/vagrant/source/komaduki/GetTweet.php";
require "/vagrant/source/func/FKSession.php";
require "/vagrant/source/func/FKMongo.php";
class ProfileController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(empty(session("userID"))){
            return redirect("home");
        }
        $FishyKink = connect_mongo();
        $id = $request->input("user");
        $isShowSettings = False;
        if (is_null($id) or $id == session("userID") ){
            $id = session("userID");
            $isShowSettings = True;
        }
        $userData = $FishyKink["userDB"]->findOne(["userID" =>  $id]);
        $tweetData = $FishyKink["tweetDB"]->find(["userID" =>  $id],['sort' => ['time' => -1]]);
        return view("profile",compact("userData","tweetData","isShowSettings"));
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
        //
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
        //
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
