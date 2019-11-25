<?php
require "/vagrant/source/func/FKMongo.php";

function test($request){

    $db = connect_mongo();
    $tweetID = new \MongoDB\BSON\ObjectId($request["tweetID"]);
    $tweet = $db["tweetDB"] -> findOne(["_id" => $tweetID]);
    print_r($tweet);
}

test(["tweetID" =>"5d15adfc763834624de38f22"]);
?>
