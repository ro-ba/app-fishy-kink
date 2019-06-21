<?php
//require_once dirname(__FILE__) . '/vendor/autoload.php';
require "/vagrant/source/func/FKMongo.php";
$client = connectMongo();

//if($_SERVER["REQUEST_METHOD"] != "POST"){
    function myPage(){
    $data = dbAccess();

    $user_json = json_encode($data);
    return $user_json;
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
}

function dbAccess(){
    $cursor = $client["userDB"]->find(['userName' => session('userID')]);
    foreach ($cursor as $userData) {
       $data = $userData;
    };
    return $data;
};
?>