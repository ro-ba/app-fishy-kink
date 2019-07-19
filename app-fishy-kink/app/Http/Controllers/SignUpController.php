<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Rules\UserExists;
use App\Rules\ValidateUserID;
use App\Rules\ValidatePassword;
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
        //validation
        $validator = $request->validate([
            "username" => ["min:1"],
            "userID" => [new UserExists($db), new ValidateUserID(), "required"],
            "password" => ["required", new ValidatePassword(), "between:4,20"],
        ]);
        //saltを生成して、パスワードをハッシュ化
        $salt = generate_salt();
        $password = fk_hash($request->input("password"),$salt);
        //データベースにデータを格納
        $db["userDB"] -> insertOne([
            "userID" => $request->input("userID"),
            "userName" => $request->input("username"),
            "password" => $password,
            "salt"  =>  $salt
        ]);
        //loginに画面遷移した際に必要な情報を渡す
        $message = ["success","ユーザー登録に成功しました。"];
        $oldID = $request->input("userID");
        return view("login",compact("oldID","message"));
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
