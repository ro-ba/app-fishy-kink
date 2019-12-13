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
        $sessionUser = session("userID");
        $isShowSettings = False;
        if (is_null($id) or $id == $sessionUser ){
            $id =  $sessionUser;
            $isShowSettings = True;
        }
        $userData = $FishyKink["userDB"]->findOne(["userID" =>  $id]);
        $nowFollow = $FishyKink["userDB"]->findOne(["userID" =>  $sessionUser , "follow" => $id ]);
        if(!isset($nowFollow)){
            $nowFollow = False;
        }
        if(session('userID')){
            $id = session("userID");
            $data = connect_mongo();
            $userIcon = $data["userDB"] ->findOne(["userID"=>session("userID")])["userImg"];
            $count = $data["notifyDB"] -> count(["userID" => $id , "readFlag" => false]);
        };
        //     return view("homeTemplate",compact("userIcon","count"));
        // }else{
        //     return redirect("login");
        // };
        $tweetData = $FishyKink["tweetDB"]->find(["userID" =>  $id],['sort' => ['time' => -1]]);
        return view("profile",compact("userData","tweetData","isShowSettings","nowFollow".'$count','$userIcon'));

       
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
        $id = $request->input("user");
        $sessionUser = session("userID");
        $time = date("Y/m/d H:i:s");
        $name = $FishyKink["userDB"] -> findOne(["userID" => $sessionUser])["userName"];
        $nowFollow = (array) $FishyKink["userDB"]->findOne(["userID" =>  $sessionUser])["follow"];
        $nowFollower = (array) $FishyKink["userDB"]->findOne(["userID" =>  $id])["follower"];
        // if(!isset($nowFollow)){
        //    $FishyKink["userDB"]->updateOne(["userID"=>$sessionUser, ['$set' => ["follow" => $id]]);
        //    $FishyKink["userDB"]->updateOne(["userID"=>$id],['$set' => ["follower" => $sessionUser]]);
        if(in_array($id, $nowFollow)){    //もし、すでにフォローしていればリストから削除する
            // 削除
            $nowFollow = array_diff($nowFollow, (array) $id);
            $nowFollower = array_diff($nowFollower, (array) $sessionUser);
            //indexを詰める
            $nowFollow = array_values($nowFollow);
            $nowFollower = array_values($nowFollower);
        }else{
            //追加
            array_push($nowFollow, $id);
            array_push($nowFollower, $sessionUser);
            $FishyKink["notifyDB"] -> insertOne([
                "userID" => $FishyKink["userDB"] -> findOne(["userID" => $id])["userID"],
                "tweetID" => "",
                "text" => $name .= "さんにフォローされました。",
                "time" => $time,
                "readFlag" => False
            ]);
        }

        $FishyKink["userDB"]->updateOne(["userID" => $sessionUser], ['$set' => ["follow" => $nowFollow]]);
        $FishyKink["userDB"]->updateOne(["userID" => $id], ['$set' => ["follower" => $nowFollower]]);

        $url = "profile?user=${id}";
        return redirect($url);      
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
