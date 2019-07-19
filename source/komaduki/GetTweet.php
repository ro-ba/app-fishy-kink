<?php
    function getTweet($data){
        
        $type   = array();
        $text   = array();
        $userId = array();      // userIDを保持する配列の作成
        $time   = array();      // 時間を保持する配列の作成
        $favUser = array();
        $reTweetUser = array();

        $cursor = $data["tweetDB"]->find();
        // 1件ずつ配列に投入
        foreach ($cursor as $doc) {
            $type[] = $doc["type"];
            $text[] = $doc["text"];
            $userId[] = $doc["userID"];
            $time[]   = $doc["time"];
        }

        // 表示
        for($i = count($userId);$i >= 0;$i--){
            if($type[$i] == "retweet"){
                echo $userId[$i]."さんがリツイートしました！</br>";
            }
            echo $userId[$i]."</br>";
            echo $time[$i]."<br>";
            echo $text[$i]."<br><br>";
        }
    }
?>
