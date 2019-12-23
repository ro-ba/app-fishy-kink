<?php
//require_once dirname(__FILE__) . '/vendor/autoload.php';

require "/vagrant/source/func/FKSession.php";

// function myPage($FishyKink){

function dbUser($FishyKink,$id){

    if(empty($id)){
        $id = session('userID');
    };

    $userCursor = $FishyKink["userDB"]->findOne(array('userID' => $id));
    $Data = iterator_to_array($userCursor);
    return $Data;
}

function dbTweet($FishyKink,$id){

    if(empty($id)){
        $id = session('userID');
    };
    $tweetCursor = $FishyKink["tweetDB"]->find(array('userID' => $id));
    return $tweetCursor;
}

?>

