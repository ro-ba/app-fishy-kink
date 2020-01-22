<?php

require "/vagrant/source/func/FKMongo.php";

//テストのtweetデータにoriginTweetIDを挿入する
function set_originTweetID ($db){
    $tweets = $db["tweetDB"]->find();

    foreach($tweets as $tweet){
        foreach ($tweet["_id"] as $id){
            if ($id == "5d15ae1c763834624de38f24"){
                $db["tweetDB"] -> updateOne(["_id" => $tweet["_id"]],['$unset'=>[
                    "text"          =>  1,
                    "fabUser"       =>  1,
                    "retweetUser"   =>  1,
                    "img"           =>  1
                ]]);
            }
        }
        if ( $tweet["type"] == "tweet" && $tweet["originTweetID"] == ""){
            $db["tweetDB"] -> updateOne(["_id" => $tweet["_id"]],['$set'=>["originTweetID" => $tweet["_id"]]]);
        }
    }
}

//フィールド名をfabUserからfavoUserに変更
function rename_field($db){
    $db["tweetDB"] -> updateMany([],['$rename' =>["fabUser" => "favoUser"]]);
}
//ツイートデータにuserNameカラムを挿入
function set_userName ($db) {
    $tweets = $db["tweetDB"]->find();
    foreach($tweets as $tweet){
        $user = $db["userDB"] -> findOne(["userID" => $tweet["userID"]]);
        $db["tweetDB"] -> updateOne(["_id" => $tweet["_id"]],['$set'=>["userName" => $user["userName"]]]);
    }
}

function set_showFlg($db){
    $db["tweetDB"]->updateMany([],['$set' => ["showFlg" => True]]);
}
function set_firstLogin($db){
    $db["userDB"]->updateMany([],['$set' => ["firstLogin" => false]]);
}

$db = connect_mongo();
set_originTweetId($db);
rename_field($db);
set_userName($db);
set_showFlg($db);
set_firstLogin($db);

?>
