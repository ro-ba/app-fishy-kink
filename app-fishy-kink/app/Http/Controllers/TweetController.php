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
        if(session('userID')){ 
            $db = connect_mongo();
            $tweetImg = [];
            if($request->hasfile("tweetImage")){
                foreach($request->tweetImage as $image){
                    //拡張子取得
                    $ext = explode("/",$image->getMimeType())[1];
                    //画像fileを取得してバイナリにエンコード
                    $encode_img = base64_encode(file_get_contents($image));
                    
                    $tweetImg[] = 'data:image/' . $ext . ';base64,' . $encode_img;
                }
            }
            $time = date("Y/m/d H:i:s");
            $db["tweetDB"] -> insertOne([
            "type"          => "tweet",
            "text"          => $request->input("tweetText"),
            "userID"        => session('userID'),
            "time"          => $time,
            "img"           => $tweetImg,
            "retweetUser"   => [],
            "fabUser"       => [],
            "originTweetID" => "",
            "parentTweetID" => "",
            "userImg"      => $db["userDB"] -> findOne(["userID" => session("userID")])["userImg"]
            ]); 
            $tweetID = $db["tweetDB"]->findOne(["type" => "tweet","time" =>$time])["_id"];
            $db["tweetDB"] -> updateOne(["_id" => $tweetID],['$set'=>["originTweetID" => $tweetID]]);
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
