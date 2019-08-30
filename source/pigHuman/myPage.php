<?php
//require_once dirname(__FILE__) . '/vendor/autoload.php';

require "/vagrant/source/func/FKSession.php";
// require "/vagrant/source/func/FKMongo.php";

// $FishyKink = connect_mongo();

function myPage($FishyKink){

    function dbUser($FishyKink){

        $id = session('userID');
        //$id = 'ino';

        $userCursor = $FishyKink["userDB"]->findOne(array('userID' => $id));
        $Data = [];
        foreach ($userCursor as $key => $userData) {
            $Data[$key] = $userData;
        };
        //$user_json = json_encode($Data);
        return $Data;
    }

    function dbTweet($FishyKink){

        $id = session('userID');
        // $id = 'takuwa';

        $tweetCursor = $FishyKink["tweetDB"]->findOne(array('userID' => $id));

        $Data = [];
        if(isset($tweetCursor)){
           foreach ($tweetCursor as $key => $tweetData) {
                $Data[$key] = $tweetData;
            }
        }
        else{
            $Data["tweet"] = "ツイートがありません";
        }

        //$tweet_json = json_encode($Data);
        return $Data;
    }


    // if($flg== true){
    //$user_json = dbUser($FishyKink);
    //     return $user_json;
    // }else{
    //$tweet_json = dbTweet($FishyKink);
    //     return $tweet_json;
    // }


    $user = dbUser($FishyKink);
    $tweet = dbTweet($FishyKink);
    $res = array_merge( $user, $tweet );


    //$resJson = json_encode( $res ,JSON_UNESCAPED_UNICODE );
    return $res;
}

// myPage($FishyKink);

?>

