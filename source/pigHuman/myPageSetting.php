<?php
//require_once dirname(__FILE__) . '/vendor/autoload.php';

function myPageSetting($id,$name,$profile){
    $request = $request -> all();
    //$id = session('userID');
    // $FishyKink['userDB']->updata(array("userID"=>$id),$request);
    $FishyKink["userDB"] -> 
    update(array("userID" => $id),
    array('$set' => array("userName" => $name)),
    //array('$set' => array("userImg" => 'data:image/' . $ext . ';base64,' . $encode_img)),
    array('$set' => array("profile" => $profile)));
        
    return "OK";
}

?>