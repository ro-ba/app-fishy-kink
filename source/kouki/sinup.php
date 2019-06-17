<?php
    require "../func/FKMongo.php";
    $data = connectMongo();

    $ID = IDcheck("123Aaa");
    $Pass = Passcheck("pAss");
    //$Name = ;
    
    if(preg_match("/^[a-zA-Z0-9]+$/", $ID )){
        if(preg_match("/^[a-zA-Z0-9]+$/", $Pass)){
            print_r($ID);
            print_r($Pass);
            //$data["userDB"]->insertOne(["userID" => $ID,"password" => $Pass ,"userName" => $name]);
        }else{
            print_r($Pass);
        }
    }else{
        print_r($ID);
    }

    function IDcheck($newid){
        $data = connectMongo();
        $check = $data["userDB"]->findOne(["_id" => $newid]);

        if($check){
            return "このIDは使われています";
        }else{
            if(preg_match("/^[a-zA-Z0-9]+$/",$newid )){
                return $newid;
            }else{
                return "英数字で入力してください";
            }
        }

    }

    function Passcheck($newpass){
        // 英数字チェック
        if (preg_match('/[0-9].*[a-zA-Z]|[a-zA-Z].*[0-9]/', $newpass)) {
            // 英数字の場合
            if (strlen($newpass) >= 4){
                return $newpass;
            } else {
                return "文字数が足らない";
            }
        } else {
            // 英数字ではない場合
            return "英数字両方を使ってください";
        }
    }
    
?>