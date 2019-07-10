<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
require "/vagrant/source/kouki/signup.php";
require "/vagrant/source/func/FKMongo.php";
require "/vagrant/source/func/FKHash.php";

class SignUpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        return view("signUp");
        //
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
        $message = [];
        $userID = $request -> input("userID");
        $password = $request -> input("password");
        $userName = $request -> input("username");
        if (check_ID($db, $userID, $message)) {
            if(check_password_rules($password, $message)){
                $salt = generate_salt();
                $newPass = fk_hash($password.$salt);
                add_user($db, $userID, $newPass, $userName, $salt);
                $message = ["success", "登録に成功しました。"];
                return view("login",compact("message"));
            }
        }
        return view("signUp",compact("message"));
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
