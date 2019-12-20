<?php
function reco(){
    $db = connect_mongo();
    $count = $db ["userDB"] -> count();
    if($count < 10){
            $user = $db ["userDB"] -> find();
            foreach($user as $result){
                print_r($result);
            }
    }else{
        $user =  $db ["userDB"] -> aggregate([{$sample: { "size": 3 }}]);
        foreach($user as $result){
            print_r($result);
        }
    }
        
    return true;
}
