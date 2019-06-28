<?php
require "/vagrant/source/func/FKMongo.php"; 
require "FKSession.php"

function dMassage(){
    //if($_SERVER["REQUEST_METHOD"] != "POST"){
        $client = connectMongo();
        $data = dbAccess();
        if(is_null($data)){
            $newTalkList = newTalk();
            $talk_json = json_encode($newTalkList);
            return $talk_json;
            // $ch = curl_init();
            // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            // curl_setopt($ch, CURLOPT_POSTFIELDS, $talk_json);
            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // curl_setopt($ch, CURLOPT_URL, 'http://posttestserver.com/post.php');//URLは仮名
            // $result=curl_exec($ch);
            // echo 'RETURN:'.$result;
            // curl_close($ch);
            
        }else{
            
            $dm_json = json_encode($data);
            return $dm_json;
            // $ch = curl_init();
            // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            // curl_setopt($ch, CURLOPT_POSTFIELDS, $dm_json);
            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // curl_setopt($ch, CURLOPT_URL, 'http://posttestserver.com/post.php');//URLは仮名
            // $result=curl_exec($ch);
            // echo 'RETURN:'.$result;
            // curl_close($ch);
        }
    //}

}
function dbAccess(){
    $cursor = $client["DMDB"]->find(['userName' => session('userID')]);
    foreach ($cursor as $userData) {
       $data=$userData;
    };
    return $data;
}
function newTalk(){
    $cursor = $client["userDB"]->find(['userName' => session('userID')]);
    foreach ($cursor as $userData) {
        $data=$userData;
    };
    return $data;
}
?>