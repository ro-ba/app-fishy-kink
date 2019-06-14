<?php
    require "../func/FKMongo.php";
    function IDcheck($newid){
        $data = connectMongo();
        $check = $data["userDB"]->findOne(["_id" => $newid]);

        if($check){
            return "登録できません";
        }else{
            return "True";
        }

    }
    //$anser = IDcheck("1a");
    //print_r($anser);
?>