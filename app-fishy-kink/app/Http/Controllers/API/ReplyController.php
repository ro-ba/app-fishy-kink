<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

require "/vagrant/source/func/FKMongo.php";

class ReplyController extends Controller
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
        $db = connect_mongo();
        // \Log::info($request);
        $userID = session("userID"); 
        $target = $request->input("target1");
        $name = $db["userDB"] -> findOne(["userID" => $userID])["userName"];
        $replyImg = $request["replyImage"];
        $replyImage = [];
        if(isset($replyImg)){            // hasfile : 画像があるかないかを判断
            foreach($replyImg as $image){
                 //拡張子取得
                $ext = explode("/",$image->getMimeType())[1];
               //画像fileを取得してバイナリにエンコード
                $encode_img = base64_encode(file_get_contents($image));
                $replyImage[] = 'data:image/' . $ext . ';base64,' . $encode_img;
            }
        }
        $time = date("Y/m/d H:i:s");
        $db["tweetDB"] -> insertOne([
            "type"          => "reply",
            "text"          => $request->input('replyText'),
            "userID"        => session('userID'),
            "userName"      => $name,   //yamasakiが追加
            "time"          => $time,
            "img"           => $replyImage,
            "retweetUser"   => [],
            "favoUser"      => [],
            "originTweetID" => $target,
            "userImg"       => $db["userDB"] -> findOne(["userID" => session("userID")])["userImg"],
            "showFlg"       => True
        ]); 
<<<<<<< HEAD
<<<<<<< HEAD
        $db["notifyDB"] -> insertOne([
            "userID" => $db["tweetDB"] -> findOne(["_id" => $target])["userID"],
            "tweetID" => $tweetID,
            "text" => $name .= "さんがリプライしました。",
            "time" => $time,
            "readFlag" => False
        ]);
        // return ["message" => ];
        return redirect("home");
=======
        return [];  //何か返さないと怒られる
=======
        return [];   //何か返さないと怒られる
>>>>>>> abc004759e0c27ad12f0e9eab5ed9d47a2d7c1c2
        
>>>>>>> 3c82f15f00ab8ca3e72b61fb78843fb82d502d75
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
