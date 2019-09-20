<?php
//require_once dirname(__FILE__) . '/vendor/autoload.php';

function myPageSetting($request,$FishyKink){
    $request = $request -> all();
    $id = session('userID');

    // $FishyKink['userDB']->updata(array("userID"=>$id),$request);
    $FishyKink["userDB"] -> update(array("userID"=>$id),[
        "userName" => $request->input("userName"),
        "userImg" => 'data:image/' . $ext . ';base64,' . $encode_img,
        "profile" => $request->input("profile")
    ]);
    return true;
}

?>