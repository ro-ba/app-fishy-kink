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
            $data = connect_mongo();
            $tweetID = new \MongoDB\BSON\ObjectId($request->input("tweetId"));

            $Tweets = $data["tweetDB"] -> findOne(["_id" => $tweetID]);

            if( isset($Tweets["originTweetID"]) ){
                $originTweets = $data["tweetDB"] -> findOne(["_id" => $Tweets["originTweetID"]]);
            }else{
                $originTweets = $Tweets;
            }

            $replys = $data["tweetDB"]->find(["type"=>"reply"] , ["originTweetID" => $originTweets["_id"]]);

            $originTweets = iterator_to_array($originTweets);
            $replys = iterator_to_array($replys);

            // foreach($replys as $repCheck){
            //     if(isset($repCheck["_id"])){
            //         //入れ子じゃない
            //         $replys = array($replys);
            //         break;
            //     }else{
            //         //入れ子構造
            //         break;
            //     }
            // }

            print_r($replys);


            // return view("replyTree",compact("originTweets","replys"));
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
