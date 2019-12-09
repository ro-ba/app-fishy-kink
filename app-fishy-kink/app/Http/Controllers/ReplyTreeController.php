<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

require "/vagrant/source/func/FKSession.php";
require "/vagrant/source/func/FKMongo.php";
require "/vagrant/source/komaduki/GetTweet.php";


class ReplyTreeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(session('userID')){
            $id = session("userID");
            $tweetId = $request->input("tweetId");
            $data = connect_mongo();
            $userData = $data["userDB"]->findOne(["userID" =>  session('userID')]);

            $tweets   = $data["tweetDB"]->findOne(["_id" => $tweetId]);
            $replys = $data["tweetDB"]->find(["originTweetID" => $tweetId]);
            $userIcon = $data["userDB"] ->findOne(["userID"=>session("userID")])["userImg"];
            return view("replyTree",compact("tweets","replys","userIcon"));
        }else{
            return redirect("login");
        };
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
