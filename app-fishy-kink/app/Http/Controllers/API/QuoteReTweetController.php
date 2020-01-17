<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

require "/vagrant/source/func/FKMongo.php";

class QuoteReTweetController extends Controller
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
        \Log::info($request);
        $db = connect_mongo();
        $userID = session("userID"); 
        
        $name = $db["userDB"] -> findOne(["userID" => $userID])["userName"];
        $target = $request->input("target2");
        $time = date("Y/m/d H:i:s");

        // 画像
        $quoteReTweetImg = $request["quoteReTweetImage"];
        $quoteReTweetImage = [];
        if(isset($quoteReTweetImg)){            // hasfile : 画像があるかないかを判断
            foreach($quoteReTweetImg as $image){
                //拡張子取得
                $ext = explode("/",$image->getMimeType())[1];
                //画像fileを取得してバイナリにエンコード
                $encode_img = base64_encode(file_get_contents($image));
                $quoteReTweetImage[] = 'data:image/' . $ext . ';base64,' . $encode_img;
            }
        }

        $tweetID = new \MongoDB\BSON\ObjectId($request->input("tweetID"));
        $targetUser =  $db["tweetDB"] -> findOne(["_id" => $target])["userID"];

        // return ["message" => $target];

        //リツイート削除時の挙動がおかしい
        // if (empty($originalTweetID)){
        //     $return = "error";
        // }else{
        //     $reTweetlist = (array)$db["tweetDB"] ->findOne(["_id" => $originalTweetID])["retweetUser"];
        //     $return = "";
        //     if (in_array($userID,$reTweetlist)){    //もし、すでにリツイートしていればリストから削除する
        //         //削除
        //         $reTweetlist = array_diff($reTweetlist,(array)$userID);
        //         //indexを詰める
        //         $reTweetlist = array_values($reTweetlist);

        //         $db["tweetDB"] ->deleteOne([
        //             "type"          => "retweet",
        //             "userID"        => session("userID"),
        //             "originTweetID" => $originalTweetID
        //             ]);

        //         $return = "delete";
        //     } else {
        //         // 追加
        //         array_push($reTweetlist,$userID);

                $db["tweetDB"] -> insertOne([
                    "type"          => "quoteReTweet", 
                    "text"          => $request->input('quoteReTweetText'),         
                    "userID"        => session('userID'),       
                    "userName"      => $name,                   
                    "time"          => $time, 
                    "img"           => $quoteReTweetImage,
                    "retweetUser"   => [],
                    "favoUser"      => [],
                    "originTweetID" => "",
                    "parentTweetID" => $target
                    "showFlg"       => True
                    ]); 
                // $db["notifyDB"] -> insertOne([
                //     "userID" => $targetUser,
                //     "tweetID" => $tweetID,
                //     "text" => $name .= "さんがコメント付けてリツイートしました。",
                //     "time" => $time,
                //     "readFlag" => False
                // ]);
                // $return = "add";
            // };
            // 更新
            //$db["tweetDB"]->updateOne(["_id" => $tweetID],['$set'=>["retweetUser" => $reTweetlist]]);
        // }
        return [];  //何か返さないと怒られる
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
