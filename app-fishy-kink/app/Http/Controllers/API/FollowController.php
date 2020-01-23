<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

require "/vagrant/source/func/FKMongo.php";

class FollowController extends Controller
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
        $opponentUserID = $request["userID"];
        $myFollow = (array) $FishyKink["userDB"]->findOne(["userID" =>  session("userID")])["follow"];
        $opponentFollower = (array) $FishyKink["userDB"] -> findOne(["userID" => $opponentUserID])["follower"];
        if(in_array($opponentUserID,$myFollow)){  //もし、すでにフォローしていればリストから削除する
            // 削除
            $myFollow = array_diff($myFollow, (array) $opponentUserID);
            $opponentFollower = array_diff($opponentFollower, (array) session("userID"));
            //indexを詰める
            $myFollow = array_values($myFollow);
            $opponentFollower = array_values($opponentFollower);
            $return = "unfollow";
        }else{
            $time = date("Y/m/d H:i:s");
            $name = $FishyKink["userDB"] -> findOne(["userID" => session("userID")])["userName"];
            //追加
            array_push($myFollow, $opponentUserID);
            array_push($opponentFollower, session("userID"));
            $FishyKink["notifyDB"] -> insertOne([
                "userID" => $FishyKink["userDB"] -> findOne(["userID" => $opponentUserID])["userID"],
                "tweetID" => "",
                "text" => $name .= "さんにフォローされました。",
                "time" => $time,
                "readFlag" => False
            ]);
            $return = "follow";
        }
        $FishyKink["userDB"]->updateOne(["userID" => session("userID")], ['$set' => ["follow" => $myFollow]]);
        $FishyKink["userDB"]->updateOne(["userID" => $opponentUserID], ['$set' => ["follower" => $opponentFollower]]);

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
