<?php
    function tweet($data){
        $tweetText =  echo $_POST['tweetText'];     // ツイート内容
        $db["tweet"] -> insertOne([
            "type"          => "tweet",
             "text"          => $_POST['tweetText'],
            "userID"        => "ino"
            "time"          => date("Y/m/d H:i:s"),
            "img"           => "",
            "retweetUser"   => "",
            "fabUser"       => "",
            "originTweetID" => "",
            "parentTweetID" => ""
        ]);
    }
?>   
