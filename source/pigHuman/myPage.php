<?php
//require_once dirname(__FILE__) . '/vendor/autoload.php';

require "/vagrant/source/func/FKSession.php";


function myPage($FishyKink){

    function dbUser($FishyKink){

        $id = session('userID');

        $userCursor = $FishyKink["userDB"]->findOne(array('userID' => $id));
        foreach ($userCursor as $userData) {
            $Data[] = $userData;
        };
        $user_json = json_encode($Data);
        return $user_json;
    }

    function dbTweet($FishyKink){

        $id = session('userID');

        $tweetCursor = $FishyKink["tweetDB"]->findOne(array('userID' => $id));
        foreach ($tweetCursor as $tweetData) {
            $Data[] = $tweetData;
        };
        $tweet_json = json_encode($Data);
        return $tweet_json;
    }


    // if($flg== true){
    //$user_json = dbUser($FishyKink);
    //     return $user_json;
    // }else{
    //$tweet_json = dbTweet($FishyKink);
    //     return $tweet_json;
    // }


    $user = json_decode( dbUser($FishyKink), true );
    $tweet = json_decode( dbTweet($FishyKink), true );
    $res = array_merge_recursive( $user, $tweet );
    $resJson = json_encode( $res ,JSON_UNESCAPED_UNICODE );

    return $resJson;
}
<<<<<<< HEAD
?>
=======
?>
>>>>>>> 0125b78c979203250c4220892c9dcb38098aca95
