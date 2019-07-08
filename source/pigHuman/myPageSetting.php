<?php
//require_once dirname(__FILE__) . '/vendor/autoload.php';

require "/vagrant/source/func/FKMongo.php";
require "/vagrant/source/func/FKSession.php";
$FishyKink = connectMongo();

function myPageSetting($request,$FishyKink){
    $request = $request -> all();
    $userID = session('userID');

    $FishyKink['userDB']->updata(array("userID"=>$userID),$request);
    
    return true;
}

?>