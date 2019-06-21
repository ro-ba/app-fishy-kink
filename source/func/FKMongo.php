<?php
require_once dirname(__FILE__) . "/vendor/autoload.php";

function connectMongo(){   
    $client = new MongoDB\Client("mongodb://localhost:27017");
    $FishyKinkDB = $client->selectDatabase('FishyKink');
    $userDB = $FishyKinkDB->selectCollection('user');
    $tweetDB = $FishyKinkDB->selectCollection('tweet');
    $DMDB = $FishyKinkDB->selectCollection('DM');
    $notifyDB= $FishyKinkDB->selectCollection('notify');
    return ["userDB" => $userDB, "tweetDB" => $tweetDB, "DMDB" => $DMDB, "notifyDB" => $notifyDB];
}
?>