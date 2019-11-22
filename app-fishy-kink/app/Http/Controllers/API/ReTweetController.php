<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

require "/vagrant/source/func/FKMongo.php";


class ReTweetController extends Controller
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
        $tweetID = new \MongoDB\BSON\ObjectId($request->input("tweetID"));
        $userID = session('userID');
        $originalTweetID = $db["tweetDB"] -> findOne(["_id" => $tweetID])["originTweetID"];
        $targetUser =  $db["tweetDB"] -> findOne(["_id" => $originalTweetID])["userID"];
        $name = $db["userDB"] -> findOne(["userID" => $userID])["userName"];
        $time = date("Y/m/d H:i:s");
        //リツイート削除時の挙動がおかしい
        if (empty($originalTweetID)){
            $return = "error";
        }else{
            $reTweetlist = (array)$db["tweetDB"] ->findOne(["_id" => $originalTweetID])["retweetUser"];
            $return = "";
            if (in_array($userID,$reTweetlist)){    //もし、すでにリツイートしていればリストから削除する
                //削除
                $reTweetlist = array_diff($reTweetlist,(array)$userID);
                //indexを詰める
                $reTweetlist = array_values($reTweetlist);

                $db["tweetDB"] ->deleteOne([
                    "type"          => "retweet",
                    "userID"        => session("userID"),
                    "originTweetID" => $originalTweetID
                    ]);

                $return = "delete";
            } else {
                //追加
                array_push($reTweetlist,$userID);

                $db["tweetDB"] -> insertOne([
                    "type"          => "retweet",
                    "userID"        => session('userID'),
                    "time"          => date("Y/m/d H:i:s"),
                    "originTweetID" => $originalTweetID,
                    "parentTweetID" => ""
                    ]); 
                $db["notifyDB"] -> insertOne([
                    "userID" => $targetUser,
                    "tweetID" => $tweetID,
                    "text" => $name .= "さんがリツイートしました。",
                    "time" => $time,
                    "readFlag" => False
                ]);
                $return = "add";
            };
            //更新
            $db["tweetDB"]->updateOne(["_id" => $tweetID],['$set'=>["retweetUser" => $reTweetlist]]);
        }
        return ["message" => $return];
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
