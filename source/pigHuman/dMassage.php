<?php
require "/vagrant/source/func/FKMongo.php"; 
session_start();
$data = dbAccess();
if(is_null($data)){
    $newTalkList = newTalk();
    $talk_json = json_encode($newTalkList);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $talk_json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, 'http://posttestserver.com/post.php');//URLは仮名
    $result=curl_exec($ch);
    echo 'RETURN:'.$result;
    curl_close($ch);
    
}else{
    
    $dm_json = json_encode($data);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $dm_json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, 'http://posttestserver.com/post.php');//URLは仮名
    $result=curl_exec($ch);
    echo 'RETURN:'.$result;
    curl_close($ch);
}
function dbAccess(){
    $client = new MongoDB\Client("mongodb://localhost:27017");
    $db = $client->selectDatabase('FishyKink');
    $collection = $db->selectCollection('DMDB');
    // $userName = array('userName' => '$_SESSION[‘username’]');
    $cursor = $collection->find(['userName' => 'test']);
    foreach ($cursor as $userData) {
       $data=$userData;
    };
    return $data;
}
function newTalk(){
    $client = new MongoDB\Client("mongodb://localhost:27017");
    $db = $client->selectDatabase('FishyKink');
    $collection = $db->selectCollection('userDB');
    $cursor = $collection->find(['userName' => 'test']);
    foreach ($cursor as $userData) {
        $data=$userData;
    };
    var_dump($data);
    return $data;
}
?>