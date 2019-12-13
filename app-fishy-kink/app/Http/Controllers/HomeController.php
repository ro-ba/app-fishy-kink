<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

require "/vagrant/source/func/FKSession.php";
require "/vagrant/source/func/FKMongo.php";
require "/vagrant/source/komaduki/GetTweet.php";


class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(session('userID')){
            $id = session("userID");
            $data = connect_mongo();
            $userData = $data["userDB"]->findOne(["userID" =>  session('userID')]);
            $tweets   = $data["tweetDB"]->find([],['sort' => ['time' => -1]]);
            $userIcon = $data["userDB"] ->findOne(["userID"=>session("userID")])["userImg"];
            $count = $data["notifyDB"] -> count(["userID" => $id , "readFlag" => false]);
            return view("homeTemplate",compact("tweets","userIcon","count"));
        }else{
            return redirect("login");
        };
        if(session('userID')){
            $id = session("userID");
            $data = connect_mongo();
            $userData = $data["userDB"]->findOne(["userID" =>  session('userID')]);
            $tweets   = $data["tweetDB"]->find([],['sort' => ['time' => -1]]);
            $userIcon = $data["userDB"] ->findOne(["userID"=>session("userID")])["userImg"];
            $count = $data["notifyDB"] -> count(["userID" => $id , "readFlag" => false]);
            return view("home",compact("tweets","userIcon","count"));
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
