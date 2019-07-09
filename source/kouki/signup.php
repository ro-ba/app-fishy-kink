<?php
    // if(preg_match("/^[a-zA-Z0-9]+$/", $ID )){
    //     if(preg_match("/^[a-zA-Z0-9]+$/", $Pass)){
    //         $salt = salt("20");
    //         $Passsolt = $Pass . $salt;
    //         $Pass = password_hash($Passsolt , PASSWORD_DEFAULT);
    //         //print_r($Passsolt);
    //         print_r($Pass);

    //         //$data["userDB"]->insertOne(["userID" => $ID,"password" => $Pass ,"solt" => $salt,"userName" => $Name]);
    //     }else{
    //         print_r($Pass);
    //     }
    // }else{
    //     print_r($ID);
    // }

    function IDcheck($data,$newid,$message){
        $check = $data["userDB"]->findOne(["userID" => $newid]);
        if($check){
            $message[] = "このIDは使われています";
        }else{
            if(preg_match("/^[a-zA-Z0-9]+$/",$newid )){
                return true;
            }else{
                $message[] = "IDは英数字で入力してください";
            }
        }
        return false;
    }

    function Passcheck($newpass){
        // 英数字チェック
        if (preg_match('/[0-9].*[a-zA-Z]|[a-zA-Z].*[0-9]/', $newpass)) {
            // 英数字の場合
            if (strlen($newpass) >= 4){
                return $newpass;
            } else {
                return "パスワードの文字数が足りません";
            }
        } else {
            // 英数字ではない場合
            return "パスワードは英数字両方を使ってください";
        }
    }

    function salt($length) {
        $str = array_merge(range('a', 'z'), range('0', '9'), range('A', 'Z'));
        $r_str = null;
        for ($i = 0; $i < $length; $i++) {
            $r_str .= $str[rand(0, count($str) - 1)];
        }
        return $r_str;
    }
    
?>