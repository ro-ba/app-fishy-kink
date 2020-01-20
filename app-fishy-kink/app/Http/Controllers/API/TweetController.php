<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
            $userID = session("userID");
            $name = $db["userDB"] -> findOne(["userID" => $userID])["userName"];
            // return(["message" => $request->input("tweetImage")]);
            // return(["message" => json_encode($request)]);
            // $tweetImg = $request->input("tweetImage");

            $tweetImg = $request["tweetImage"]; //inputだとなぜか取れない
            $tweetImage = [];
            if(isset($tweetImg)){
                foreach($tweetImg as $image){
                    //拡張子取得
                    $ext = explode("/",$image->getMimeType())[1];
                    //画像fileを取得してバイナリにエンコード
                    $encode_img = base64_encode(file_get_contents($image));
                    $tweetImage[] = 'data:image/' . $ext . ';base64,' . $encode_img;   
                }
            }
            $time = date("Y/m/d H:i:s");
            $db["tweetDB"] -> insertOne([
            "type"          => "tweet",
            "text"          => $request->input("tweetText"),
            "userID"        => session('userID'),
            "userName"      => $name,   //yamasakiが追加
            "time"          => $time,
            "img"           => $tweetImage,
            "retweetUser"   => [],
            "favoUser"       => [],
            "originTweetID" => "",
            "parentTweetID" => "",
            "userImg"       => $db["userDB"] -> findOne(["userID" => session("userID")])["userImg"],
            "showFlg"       => True
            ]); 
            $tweetID = $db["tweetDB"]->findOne(["type" => "tweet","time" =>$time])["_id"];
            $db["tweetDB"] -> updateOne(["_id" => $tweetID],['$set'=>["originTweetID" => $tweetID]]);

            return [];  //何か返さないと怒られる
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
