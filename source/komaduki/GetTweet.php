<?php
    function getTweet($data){

        $cursor = $data["tweetDB"]->find();
        // 1件ずつ配列に投入
        foreach ($cursor as $doc) {
            if($doc["type"] == "retweet"){
                echo $doc["userID"]."さんがリツイートしました！</br>";
            }
            echo $doc["userID"]."</br>";
            echo $doc["time"]."<br>";
            echo $doc["text"]."<br><br>";

        }
    }
?>
