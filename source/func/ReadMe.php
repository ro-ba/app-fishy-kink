<?php
//Usage: FKMongo.connectMongo()
require "FKMongo.php";

$data = connectMongo();
// key = userDB, tweetDB, DMDB, NotifyDB
$data["userDB"]->insertOne(["name" => "たまの","tweetID" => "tamano"]);

$a = $data["userDB"]->findOne(["name" => "たまの"]);
print_r($a);


//Usage:FKHash.fkHash()
require "FKHash.php";

$password = "P@ssword";
$salt = "Atsushi Tamano";
$data = fkHash($password,$salt);
print_r($data);

//Usage:FKSession.session_exists()
require "FKSession.php";

if (session_exists()){
    //
}else{
    //
}

//Usage: session !Laravel enviroment only!

    //find session
        $username = session("username");
    //entry session
        session(["username" => "tamano"]);

    // Detail is example1.php

//Usage: POST Parameter !Laravel enviroment only!

    // 名前の取得
    $request->input('name');
    // リクエストにnameが存在していない場合に、デフォルト値で指定したsumoを返す
    $request->input('name', 'sumo');
    // リクエストの全入力データを配列で取得
    $request->all();
    // リクエストからmailの入力データだけ取得
    $request->only('mail');
    // リクエストからpassword以外の入力データを取得
    $request->except('password');
    // リクエストにnameが存在するか判定
    $request->has('name');
    // リクエストにnameが存在しており、かつ空でない事を判定
    $request->filled('name');

    // Detail is example1.php

?>



