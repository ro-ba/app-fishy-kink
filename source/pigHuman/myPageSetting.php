<?php
//require_once dirname(__FILE__) . '/vendor/autoload.php';

function myPageSetting($request){
    $request = $request -> all();
    $id = session('userID');

    // $FishyKink['userDB']->updata(array("userID"=>$id),$request);
    $FishyKink["userDB"] -> 
    update(array("userID" => $id),
    array('$set' => array("userName" => $request->input("userName"))),
    array('$set' => array("userImg" => 'data:image/' . $ext . ';base64,' . $encode_img)),
    array('$set' => array("profile" => $request->input("profileText"))));
        
    return true;
}

?>