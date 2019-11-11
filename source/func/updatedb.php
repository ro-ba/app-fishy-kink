<?php

require "/vagrant/source/func/FKMongo.php";

function main (){
    $db = connect_mongo();
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
        $db["tweetDB"] -> updateMany([],['$rename' =>["fabUser"] => ["favoUser"]]);
    }
}

main()

?>