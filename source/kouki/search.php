<?php
function search($search){
    $find_tweet = [];
    $find_user = [];
    $db = connect_mongo();
    $search = mb_convert_kana($search, 's');//全角スペースを半角にする
    $search = explode(" ", $search);
    $search1 = [];
    $count = count($search);
    $count1 = 0;
    for($i = 0; $i < $count; $i++){
        $search_word = $search[$i];
        if(preg_match('/^[a-zA-Z0-9]+$/', $search_word)){
            $word = mb_convert_kana($search_word, 'NR');
            array_push($search1,$word);
            $count1 += 1;
        }elseif(preg_match('/^[ａ-ｚＡ-Ｚ０－９]+$/', $search_word)){ 
            $word = mb_convert_kana($search_word, 'nr');
            array_push($search1,$word);
            $count1 += 1;
        }
    }
    for($i = 0; $i < $count; $i++){
        $search_word = $search[$i];
        //検索する文字列の数に応じて下の配列を増やす
        $tweet = array("text" => new \MongoDB\BSON\Regex("$search_word"));
        $user = array('$or' => array(array("userName" => new \MongoDB\BSON\Regex("$search_word")),
            array("userID" => new \MongoDB\BSON\Regex("$search_word")),
            array("profile" => new \MongoDB\BSON\Regex("$search_word"))));
        array_push($find_tweet,$tweet);
        array_push($find_user,$user);
    }
    $tweet_result = $db ["tweetDB"] -> find(['$and' => $find_tweet]);//ツイート検索
    $user_result = $db ["userDB"] -> find(['$and' => $find_user]);

    for($i = 0; $i < $count1; $i++){
        $search_word = $search1[$i];
        //検索する文字列の数に応じて下の配列を増やす
        $tweet = array("text" => new \MongoDB\BSON\Regex("$search_word"));
        $user = array('$or' => array(array("userName" => new \MongoDB\BSON\Regex("$search_word")),
            array("userID" => new \MongoDB\BSON\Regex("$search_word")),
            array("profile" => new \MongoDB\BSON\Regex("$search_word"))));
        array_push($find_tweet,$tweet);
        array_push($find_user,$user);
    }
    $tweet_result1 = $db ["tweetDB"] -> find(['$and' => $find_tweet]);//ツイート検索
    $user_result1 = $db ["userDB"] -> find(['$and' => $find_user]);
    $tweet_result = $tweet_result.$tweet_result1;
    
    print_r("ツイート"."<br>");
    foreach($tweet_result as $obj){
        print_r($obj);
    }
    print_r("<br>");
    print_r("ユーザー"."<br>");
    foreach($user_result as $obj){
        print_r($obj);
    }
    print_r("<br>");
    return true;
}
?>