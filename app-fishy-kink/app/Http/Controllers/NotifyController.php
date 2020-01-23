<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

require "/vagrant/source/func/FKSession.php";
require "/vagrant/source/func/FKMongo.php";

class NotifyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = session("userID");
        $FishyKink = connect_mongo();

        $notifyList = $FishyKink["notifyDB"] -> find(["userID" => $id]);
        $count = $FishyKink["notifyDB"] -> count(["userID" => $id , "readFlag" => false]);
        $FishyKink["notifyDB"] -> updateMany(["userID" => $id],['$set' => ["readFlag" => true]]);

        $userData = $FishyKink["userDB"] -> findOne(["userID" => $id]);
        
        return view("notify",compact("userData","notifyList","count"));
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
