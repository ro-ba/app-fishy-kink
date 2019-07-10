<?php

// function check_ID(&$data,$newID,&$message){
    
//     if($data["userDB"]->findOne(["userID" => $newID])){
//         $message["userID"] = ["danger", "このIDは使われています"];
//         return false;
//     }
//     if(preg_match("/^[a-zA-Z0-9]+$/", $newID)){
//         return true;
//     }else{
//         $message["userID"] = ["danger", "IDは英数字で入力してください"];
//     }
//     return false;
// }

function check_password_rules($newPass, &$message){
    //パスワードが半角英字・数字を両方含み、文字数が4文字以上の場合
    if (strlen($newPass) >= 4 && preg_match('/[0-9].*[a-zA-Z]|[a-zA-Z].*[0-9]/', $newPass)){
        return true;
    }else{
        //文字数が4文字未満の場合
        if (strlen($newPass) < 4){
            $message["password"] = ["danger", "パスワードの文字数が足りません"];
        }
        // 英数字ではない場合
        if (!preg_match('/[0-9].*[a-zA-Z]|[a-zA-Z].*[0-9]/', $newPass)){
            $message["password"] =  ["danger", "パスワードは英数字両方を使ってください"];
        }      
    }
    return false;
}

function add_user(&$data, $userID, $password, $userName, $salt){
    $user = array(
        "userID" => $userID,
        "userName" => $username,
        "password" => $password,
        "salt"  =>  $salt
    );
    $data["userDB"] ->  insertOne($user);
}

function generate_salt() {
    $length = 20;
    $str = array_merge(range('a', 'z'), range('0', '9'), range('A', 'Z'));
    $r_str = null;
    for ($i = 0; $i < $length; $i++) {
        $r_str .= $str[rand(0, count($str) - 1)];
    }
    return $r_str;
}
?>