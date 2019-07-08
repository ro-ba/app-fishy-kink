<?php
//require_once dirname(__FILE__) . '/vendor/autoload.php';
require 'vendor/autoload.php'; 

$data = dbAccess();
$user_json = json_encode($data);

$ch = curl_init();
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS, $user_json);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, 'http://posttestserver.com/post.php');//URLは仮名
$result=curl_exec($ch);
echo 'RETURN:'.$result;
curl_close($ch);

function dbAccess(){
    $client = new MongoDB\Client("mongodb://localhost:27017");
    $db = $client->selectDatabase('User');
    $collection = $db->selectCollection('user');

    // $userName = array('userName' => '$_SESSION[‘username’]');

    $cursor = $collection->find(['userName' => 'test']);
    foreach ($cursor as $userData) {
       $data = $userData;
    };
    var_dump($data);
    return $data;
};
?>