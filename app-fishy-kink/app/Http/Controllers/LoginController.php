<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
require "/vagrant/source/sibuya/login.php";
require "/vagrant/source/func/FKMongo.php";

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(session('userID')){
            return redirect("home");
        }else{
            return view("login");
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
        $db = connect_mongo();
        // dd($db["userDB"]->findOne(["userID" =>"takuwa"]));
        if(session('userID')){
            return redirect("home");
        }else{
            $return = login($request, $db);
            if ($return != null){
                $oldID = $return["userID"];
                $message = $return["message"];
                return view("login",compact("oldID","message"));
            }else{
                $db = connect_mongo();
                if ($db["userDB"]->findOne(["userID"=>$request["userID"]])["firstLogin"] == true){
                    return redirect("welcome");
                }else{
                    return view("home");
                }
            }
        }
        // return redirect("home");
        
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
