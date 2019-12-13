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
        $text = $request->input('replyText');
        // return ["message" => $text];
        $target = $request->input("target");
        $tweetImg = [];
        $userID = session("userID");
        $name = $db["userDB"] -> findOne(["userID" => $userID])["userName"];
        if($request->hasfile("ReplyImage")){
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
            "type"          => "reply",
            "text"          => $text,
            "userID"        => session('userID'),
            "userName"      => $name,   //yamasakiが追加
            "time"          => $time,
            "img"           => $tweetImg,
            "retweetUser"   => [],
            "favoUser"       => [],
            "originTweetID" => $target,
            "userImg"      => $db["userDB"] -> findOne(["userID" => session("userID")])["userImg"]
        ]); 
        return redirect("home");
        
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
