<?php
//require_once dirname(__FILE__) . '/vendor/autoload.php';

require "/vagrant/source/func/FKMongo.php"; 
require "/vagrant/source/func/FKSession.php";
$FishyKink = connectMongo();

//DM画面：図七

function dMassage($FishyKink){

    function dbAccess($FishyKink){
        $cursor = $FishyKink["DMDB"]->find(['userID' => session('userID')]);
        //$cursor = $FishyKink["DMDB"]->find(['userID' => 'ino']);
        foreach ($cursor as $userData) {
           $data[]=$userData;
        };
        return $data;
    }
    function newTalk($FishyKink){
        $cursor = $FishyKink["userDB"]->find(['userID' => session('userID')]);
        //$cursor = $FishyKink["userDB"]->find(['userID' => 'ino']);
        foreach ($cursor as $userData) {
            $data[]=$userData;
        };
        return $data;
    }
    //if($_SERVER["REQUEST_METHOD"] != "POST"){
    $data = dbAccess($FishyKink);
    if(is_null($data)){
        $newTalkList = newTalk($FishyKink);
        $talk_json = json_encode($newTalkList, JSON_UNESCAPED_UNICODE);
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
        
        $dm_json = json_encode($data, JSON_UNESCAPED_UNICODE);
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
?>