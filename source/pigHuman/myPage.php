<?php
session_start();

$data = dbAccess();

// $tweet = $data['tweet'];
// $text = $data['text'];
// $icon = $data['icon'];
// $birthday = $data['birthday'];
// $follow = count($data['follow']);
// $follower = count($data['follower']);

$php_json = json_encode($data);

var_dump($php_json);

function dbAccess(){
    $mongo = new MongoClient();
    $db = $mongo->selectDB("User");
    $collection = new MongoCollection($db,"user");

    // $userName = array('userName' => '$_SESSION[‘username’]');
    $userName = array('userName' => 'test');
    $cursor = $collection->find($userName);
    $data = array();
    foreach ($cursor as $userData) {
       array_push($data,$userData);
    }

    return $data;
}
?>