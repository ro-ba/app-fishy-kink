<?php
session_start();
$data = dbAccess();

if(is_null($data)){
    //return /html/newTalkList.html; 図７に遷移させる
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
    $mongo = new MongoClient();
    $db = $mongo->selectDB("dMassage");//DB名は仮
    $collection = new MongoCollection($db,"dm");

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