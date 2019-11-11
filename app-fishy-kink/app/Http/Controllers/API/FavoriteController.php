<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

require "/vagrant/source/func/FKMongo.php";

class FavoriteController extends Controller
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
        $return = "";
        $fablist = (array) $db["tweetDB"]->findOne(["_id" => $tweetID])["fabUser"];
        if (empty($db["tweetDB"]->findOne(["_id" => $tweetID]))){
            $return = "error";
        }else{
            if (in_array($userID, $fablist)) {    //もし、すでにファボしていればリストから削除する
                //削除
                $fablist = array_diff($fablist, (array) $userID);
                //indexを詰める
                $fablist = array_values($fablist);
                $return = "delete";
            } else {
                //追加
                array_push($fablist, $userID);
                $return = "add";
            };
            //更新
            $db["tweetDB"]->updateOne(["_id" => $tweetID], ['$set' => ["fabUser" => $fablist]]);
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
