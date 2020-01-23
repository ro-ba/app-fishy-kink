<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

require "/vagrant/source/func/FKMongo.php";
require "/vagrant/source/func/insertOriginTweet.php";

class ReloadTweetsController extends Controller
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
        $userID = $request->input("userID");
        if ($userID){
            $data = $db["tweetDB"]->find(["userID"=> $userID],['sort' => ['time' => -1]]);
        }else{
            $data = $db["tweetDB"]->find([],['sort' => ['time' => -1]]);
        };
        $tweets = iterator_to_array($data);
        //origintweetのデータを挿入
        insert_origin_tweet($db,$tweets);
        return json_encode($tweets);
        // return ($tweets);
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
