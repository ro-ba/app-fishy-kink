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
        $userID = $request["userID"];
        $myFollow = (array) $FishyKink["userDB"]->findOne(["userID" =>  session("userID")])["follow"];
        $opponentFollower = (array) $FishyKink["userDB"] -> findOne(["userID" => $userID])["follower"];
        if(in_array($userID,$myFollow)){  //もし、すでにフォローしていればリストから削除する
            // 削除
            $myFollow = array_diff($myFollow, (array) $userID);
            $opponentFollower = array_diff($opponentFollower, (array) session("userID"));
            //indexを詰める
            $myFollow = array_values($myFollow);
            $opponentFollower = array_values($opponentFollower);
            $return = "follow";
        }else{
            $time = date("Y/m/d H:i:s");
            $name = $FishyKink["userDB"] -> findOne(["userID" => session("userID")])["userName"];
            //追加
            array_push($myFollow, $userID);
            array_push($opponentFollower, session("userID"));
            $FishyKink["notifyDB"] -> insertOne([
                "userID" => $FishyKink["userDB"] -> findOne(["userID" => $userID])["userID"],
                "tweetID" => "",
                "text" => $name .= "さんにフォローされました。",
                "time" => $time,
                "readFlag" => False
            ]);
            $return = "unfollow";
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
