<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
require "/vagrant/source/pigHuman/myPage.php";

require "/vagrant/source/func/FKMongo.php";

class FollowersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = session("userID");
        $FishyKink = connect_mongo();
        $followerData = dbUser($FishyKink,$id);
        $userId = $request -> input("user");
        $userProfile = $FishyKink["userDB"] -> findOne(["userID" => $userId]);
        

       
        if (is_null($id) or $id == session("userID") ){
            $id = session("userID");
        }
        // return view("profile",compact("userData","tweetData","isShowSettings"));


        if($userProfile!=null){
            if(count($userProfile["follower"])==1){
                $follower = $FishyKink["userDB"] -> findOne(["userID" => $userProfile["follower"][0]]);               
                return view("followers",compact("followerData","userProfile","follower")); 
            }else{
                foreach($userProfile["follower"] as $followerid){
                    $follower = $FishyKink["userDB"] -> findOne(["userID" => $followerid]);
                    $followerPro[] = $follower["profile"];      
                    $followerName[] = $follower["userName"]; 
                    $followerImg[] = $follower["userImg"];  
                }   
                return view("followers",compact("followerData","followerPro","followerName","followerImg","userProfile"));
            }
        }else{
            $userProfile = $FishyKink["userDB"] -> findOne(["userID" => session("userID")]);
            $follower = $FishyKink["userDB"] -> findOne(["userID" => $userProfile["follower"][0]]);
            foreach($userProfile["follower"] as $followerid){
                $followers = $FishyKink["userDB"] -> findOne(["userID" => $followerid]);
                $followerPro[] = $followers["profile"];      
                $followerName[] = $followers["userName"]; 
                $followerImg[] = $followers["userImg"];  
            }   
            return view("followers",compact("followerData","userProfile","follower","followerPro","followerName","followerImg")); 
        }

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
