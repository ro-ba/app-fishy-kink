<?php
//require_once dirname(__FILE__) . '/vendor/autoload.php';

function myPage(){
    require "/vagrant/source/func/FKMongo.php";
    require "/vagrant/source/func/FKSession.php";
    $client = connectMongo();

    function dbUser(){
        $cursor = $client["userDB"]->find(['userName' => session('userID')]);
        foreach ($cursor as $userData) {
           $userData = $userData;
        };
        return $userData;
    }
    function dbTweet(){
        $cursor = $client["tweetDB"]->find(['userName' => session('userID')]);
        foreach ($cursor as $tweetData) {
           $tweetData = $tweetData;
        };
        return $tweetData;
    }

    $userDara = dbUser();
    $tweetData = dbTweet();

    $data_json = json_encode(array_merge(json_decode($userData,true),json_decode($tweetData,true)));
    return $data_json;


}
//}

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