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
    $data = connectMongo();
    $cursor = $data["userDB"]->findOne(["userName" => "test"]);
    foreach ($cursor as $userData) {
       $result=$userData;
    };

    return $result;
}
function newTalk(){
    $data = connectMongo();
    $cursor = $data["userDB"]->findOne(["userName" => "test"]);

    foreach ($cursor as $userData) {
        $result=$userData;
    };
 
    return $result;
}
?>