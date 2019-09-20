<?php
function search($search){
    $db = connect_mongo();
    $search = mb_convert_kana($search, 's');//全角スペースを半角にする
    $search = explode(" ", $search);
    $count = count($search);
    $find_tweet = [];
    $find_name = [];
    $find_id = [];
    $img = [];
    for($i = 0; $i < $count; $i++){
        $search_word = $search[$i];
        //検索する文字列の数に応じて下の配列を増やす
        $tweet = array("text" => new \MongoDB\BSON\Regex("$search_word"));
        $name = array("userName" => new \MongoDB\BSON\Regex("$search_word"));
        $id = array("userID" => new \MongoDB\BSON\Regex("$search_word"));
        array_push($find_tweet,$tweet);
        array_push($find_name,$name);
        array_push($find_id,$id);
    }
    $tweet_result = $db ["tweetDB"] -> find(array('$and' => $find_tweet));//ツイート検索
    $name_result = $db ["userDB"] -> find(array('$and' => $find_name));//名前検索
    $id_result = $db ["userDB"] -> find(array('$and' => $find_id));//id検索
    //$img_result = $db ["tweetDB"] -> find(array('$and' => $find_tweet));
    
    foreach($tweet_result as $obj){
        print_r($obj);
    }
    foreach($name_result as $obj){
        print_r($obj);
    }
    foreach($id_result as $obj){
        print_r($obj);
    }

    return true;
}
?>
