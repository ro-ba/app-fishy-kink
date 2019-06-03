<?php
session_start();
$data = dbAccess();

// $tweet = $data['tweet'];
// $text = $data['text'];
// $icon = $data['icon'];
// $birthday = $data['birthday'];
// $follow = count($data['follow']);
// $follower = count($data['follower']);

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