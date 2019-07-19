<?php
//require_once dirname(__FILE__) . '/vendor/autoload.php';

require "/vagrant/source/func/FKMongo.php";
require "/vagrant/source/func/FKSession.php";
$FishyKink = connectMongo();

function myPage($FishyKink,$flg){

   function dbUser($FishyKink){
        //$FishyKink = connectMongo();
        //$userCursor = $FishyKink["userDB"]->findOne(array('userID' => 'ino'));
        $userCursor = $FishyKink["userDB"]->findOne(array('userID' => session('userID')));
        foreach ($userCursor as $userData) {
            $Data[] = $userData;
        };
        $user_json = json_encode($Data, JSON_UNESCAPED_UNICODE);
        // var_dump($user_json);
        return $user_json;
    }

    function dbTweet($FishyKink){
        //$FishyKink = connectMongo();
        //$tweetCursor = $FishyKink["tweetDB"]->find(array('userID' => 'ino'));
        $tweetCursor = $FishyKink["tweetDB"]->findOne(array('userID' => session('userID')));
        foreach ($tweetCursor as $tweetData) {
            $Data[] = $tweetData;
        };
        $tweet_json = json_encode($Data, JSON_UNESCAPED_UNICODE);
        return $tweet_json;
    }

    // $user_json = dbUser($FishyKink);
    // $tweet_json = dbTweet($FishyKink);

    //$data_json = json_encode(array_merge(json_decode(dbUser($FishyKink),true),json_decode(dbTweet($FishyKink),true)));
    if($flg == "user"){
        $user_json = dbUser($FishyKink);
        return $user_json;
    }
    else{
        $tweet_json = dbTweet($FishyKink);
        return $tweet_json;
    }
    return false;
}

// $flg = "user";

// myPage($FishyKink,$flg);


// $ch = curl_init();
// curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
// curl_setopt($ch, CURLOPT_POSTFIELDS, $user_json);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_URL, 'http://posttestserver.com/post.php');//URLは仮名
// $result=curl_exec($ch);
// echo 'RETURN:'.$result;
// curl_close($ch);


?>