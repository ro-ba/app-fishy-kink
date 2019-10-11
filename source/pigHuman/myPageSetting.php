<?php
//require_once dirname(__FILE__) . '/vendor/autoload.php';

function myPageSetting($id, $request,$FishyKink){
    $name = $request->input("userName");
    $profile = $request->input("profileText");
    ( empty($name) ) ?  print_r("ユーザーネームを入力してください") : $FishyKink["userDB"]->updateOne(["userID" => $id], ['$set'=> ["userName" => $name , "profile" => $profile]]);  
}
?>
