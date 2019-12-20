<?php

function insert_origin_tweet($db,$tweets){
    foreach ($tweets as $i => $tweet){
        if ($tweet["type"] == "retweet"){
            $tweetID = new \MongoDB\BSON\ObjectId($tweet["originTweetID"]);
            $tweet["originTweet"] = $db["tweetDB"] -> findOne(["_id" => $tweetID]);
        };
    };
}
?>