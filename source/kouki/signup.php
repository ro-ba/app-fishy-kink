<?php
    // require "/vagrant/source/func/FKMongo.php";
    // require "/vagrant/source/func/FKHash.php";
    require_once dirname(__FILE__) . "../func/vendor/autoload.php";

//IDが被らないか、英字または数字で入力されているか
function IDcheck($newid, $data){ 
    // $data = connectMongo();
    $check = $data["userDB"]->findOne(["userID" => $newid]);
    print_r($check);
    if($check){
        //IDが被っている
        return "このIDは使われています";
    }else{
        //IDが英数字か
        if(preg_match("/^[a-zA-Z0-9]+$/",$newid )){
            //return "ok";
            return $newid;
        }else{
            return "IDは英数字で入力してください";
        }
    }
}

//パスワードチェック
function Passcheck($newpass){
    // 英数字チェック
    if (preg_match("/^[a-zA-Z0-9]+$/", $newpass)) {
        // 英数字の場合
        if (strlen($newpass) >= 4){
            return $newpass;
        } else {
            return "パスワードは４文字以上で入力してください";
        }
    } else {
        // 英数字ではない場合
        return "パスワードは英数字で入力してください";
    }
}

//エラー判定
function judg($ID,$Pass,$name){ 
    $c = 0;
    if(preg_match("/^[a-zA-Z0-9]+$/", $ID )){
        $c = $c + 5;
    }else{
        $c = $c + 1;
    }
    if(preg_match("/^[a-zA-Z0-9]+$/", $Pass)){
        $c = $c + 5;
    }else{
        $c = $c + 2;
    }
    //IDとパスワードがOKのとき
    if($c == 10){
        $data = connectMongo();
        $salt = salt("20");
        $Pass = fkHash($Pass,$salt);
        $array = array("userID" => $ID,"password" => $Pass ,"salt" => $salt,"userName" => $name);
        $data["userDB"]->insertOne($array);
        return "登録完了しました";
        //IDがエラーのとき
    }elseif($c == 6){
        return $ID;
        //パスワードがエラーの時
    }elseif($c == 7){
        return $Pass;
        //両方エラーの時
    }elseif($c == 3){
        $ID = $ID ."<br \>". $Pass;
        return $ID;
    }
}

//ソルト
function salt($length) { 
    $str = array_merge(range('a', 'z'), range('0', '9'), range('A', 'Z'));
    $r_str = null;
    for ($i = 0; $i < $length; $i++) {
        $r_str .= $str[rand(0, count($str) - 1)];
    }
    return $r_str;
}
// $name = $request->name;
// $id = $request->id;
// $pass = $request->password;

// $ID = IDcheck($id);
// $Pass = Passcheck($pass);

// $Judg = judg($ID,$Pass,$name);
// return $Judg;
    
?>