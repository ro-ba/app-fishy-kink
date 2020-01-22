<?php
function reco($db){
    $userID = [];
    $user_data = [];
    $user_list = [];
    $data = [];
    $userid = $db ["userDB"] -> distinct("userID");
    $user = $db ["userDB"] -> find();

    for($i = 0; $i < count($userid); $i++){
        $tweet_count = 0;
        $user_list = $userid[$i];
        $tweet_count += $db ["tweetDB"] -> count(["userID" => $user_list]);
        $userID = [$user_list => $tweet_count];
        $user_data = $user_data + $userID;
    }

    arsort($user_data);//降順並べ替え
    $result = array_slice($user_data,0,10);//10人に絞る
    $result = array_keys($result);

    foreach($result as $val){
        array_push($data,["userID" => $val]);
    }
    $reco = $db ["userDB"] -> find(['$or' => $data],["projection" => ["_id" => 0, "password" => 0 , "salt" => 0]]);
    $result = [ "reco" => $reco -> toArray()];

    return $result;
}
