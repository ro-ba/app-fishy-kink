<?php
function search($search){
    $find_tweet = [];
    $find_user = [];
    $search_han = [];
    $search_zen = [];
    $find_tweet1 = [];
    $find_user1 = [];
    $db = connect_mongo();
    $search = mb_convert_kana($search, 's');//全角スペースを半角にする
    $search = explode(" ", $search);
    $count = count($search);

    for($i = 0; $i < $count; $i++){
        array_push($search_han,mb_convert_kana($search[$i], 'rn'));
        array_push($search_zen,mb_convert_kana($search[$i], 'RN'));
    }
    for($j = 0; $j < 2; $j++){
        if($j < 1){
            $search = $search_zen;
        }else{
            $search = $search_han;
        }
        for($i = 0; $i < $count; $i++){
            $search_word = $search[$i];
            //検索する文字列の数に応じて下の配列を増やす
            $tweet = ["text" => ['$regex' => $search_word, '$options' => 'i']];
            $user = ['$or' => [
                ["userName" => ['$regex' => $search_word, '$options' => 'i']],
                ["userID" => ['$regex' => $search_word, '$options' => 'i']],
                ["profile" => ['$regex' => $search_word, '$options' => 'i']]]];
            array_push($find_tweet,$tweet);
            array_push($find_user,$user);
        }
        array_push($find_tweet1,array('$and' => $find_tweet));
        $find_tweet = [];
        array_push($find_user1,array('$and' => $find_user));
        $find_user = [];
    }
    
    #print_r($find_tweet1);
    $tweet_result = $db ["tweetDB"] -> find(['$or' => $find_tweet1]);//ツイート検索
    $user_result = $db ["userDB"] -> find(['$or' => $find_user1]);

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