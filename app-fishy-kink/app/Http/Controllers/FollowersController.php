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
        $db = connect_mongo();
        $id = $request->input("user");
        $user = $db["userDB"] -> findOne(["userID" => $id]);
        if (is_null($id) or $id == session("userID") or is_null($user)){
            $id =  session("userID");
        }
        $userProfile = $db["userDB"] -> findOne(["userID" => $id]);
        foreach($userProfile["follower"] as $followerid){
            //すべてのフォロワーを配列usersに挿入
            $users[] = iterator_to_array($db["userDB"] -> findOne(["userID" => $followerid]));  
        }
        return view("followers",compact("users"));

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
