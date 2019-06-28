<?php
//require_once dirname(__FILE__) . '/vendor/autoload.php';

function myPage(){
    require "/vagrant/source/func/FKMongo.php";
    require "FKSession.php"
    $client = connectMongo();
    //if($_SERVER["REQUEST_METHOD"] != "POST"){
    $userData = dbUser();
    $tweetData = dbTweet();

    $data_json = json_encode(array_merge(json_decode($userData,true),json_decode($tweetData,true)))
    return $data_json;

    function dbUser(){
        $cursor = $client["userDB"]->find(['userName' => session('userID')]);
        foreach ($cursor as $userData) {
           $data = $userData;
        };
        return $data;
    }
    function dbTweet(){
        $cursor = $client["tweetDB"]->find(['userName' => session('userID')]);
        foreach ($cursor as $tweetData) {
           $data = $tweetData;
        };
        return $data;
    }
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