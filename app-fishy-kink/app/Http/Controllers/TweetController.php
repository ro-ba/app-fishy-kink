<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
require "/vagrant/source/func/FKSession.php";
require "/vagrant/source/func/FKMongo.php";

class TweetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("tweet");
        //
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
        if(session('userID')){ 
            $db = connect_mongo();


            foreach($request->input("tweetImage") as $image){
                print_r($image);
            }

            // $db["tweetDB"] -> insertOne([
            // "type"          => "tweet",
            // "text"          => $request->input("tweetText"),
            // "userID"        => session('userID'),
            // "time"          => date("Y/m/d H:i:s"),
            // "img"           => "",
            // "retweetUser"   => "",
            // "fabUser"       => "",
            // "originTweetID" => "",
            // "parentTweetID" => ""
            // ]); 
            
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
