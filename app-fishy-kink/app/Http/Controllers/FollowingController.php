<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
require "/vagrant/source/pigHuman/myPage.php";

require "/vagrant/source/func/FKMongo.php";

class FollowingController extends Controller
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
        $followingData = dbUser($FishyKink,$id);
        $userId = $request -> input("user");
        // dd($userId);
        $userProfile = $FishyKink["userDB"] -> findOne(["userID" => $userId]);

        if(count($userProfile["follow"]) == 1){
            $following = $FishyKink["userDB"] -> findOne(["userID" => $userProfile["follow"][0]]);
            $followingID = $following["userID"];
            $followingPro = $following["profile"];      
            $followingName = $following["userName"]; 
            $followingImg = $following["userImg"];     
            return view("following",compact("followingData","followingPro","followingName","followingImg","followingID","userProfile")); 
       }else{
            foreach($userProfile["follow"] as $followingid){
                $following = $FishyKink["userDB"] -> findOne(["userID" => $followingid]);
                $followingPro[] = $following["profile"];
                $followingName[] = $following["userName"];
                $followingImg[] = $following["userImg"];     
            }
            return view("following",compact("followingData","followingPro","followingName","followingImg","userProfile"));
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
