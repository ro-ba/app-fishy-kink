<?php
//require_once dirname(__FILE__) . '/vendor/autoload.php';

function myPageSetting($id, $request,$FishyKink){
    $name = $request->input("userName");
    $profile = $request->input("profileText");
    $FishyKink["userDB"]->updateOne(["userID" => $id], ['$set'=> ["userName" => $name]]);
    $FishyKink["userDB"]->updateOne(["userID" => $id], ['$set'=> ["profile" => $profile]]);
        
    return "変更しました";
}

?>