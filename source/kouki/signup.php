<?php
    require "../func/FKMongo.php";
    require "../func/FKHash.php";
    $data = connectMongo();

    //if(isset($_POST[‘name’]) ){
    //    $name = $_POST[‘name’];
    //    $Name = $name;
    //    }else{
    //       print_r("名前を入力してください");
    //    }


    //$ID = IDcheck($id);
    //$Pass = Passcheck($pass);

    $ID = IDcheck("あ");
    $Pass = Passcheck("Pasrr");

    //if(preg_match("/^[a-zA-Z0-9]+$/", $ID )){
    //    if(preg_match("/^[a-zA-Z0-9]+$/", $Pass)){
    //        $salt = salt("20");
    //        $Pass = fkHash($Pass,$salt);
            //$data["userDB"]->insertOne(["userID" => $ID,"password" => $Pass ,"solt" => $salt,"userName" => $Name]);
    //    }else{
    //        print_r($Pass);
    //    }
    //}else{
    //    print_r($ID);
    //}
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
    
    if($c == 10){
        $salt = salt("20");
        $Pass = fkHash($Pass,$salt);
        //$data["userDB"]->insertOne(["userID" => $ID,"password" => $Pass ,"solt" => $salt,"userName" => $Name]);
    }elseif($c == 6){
        print_r($ID);
    }elseif($c == 7){
        print_r($Pass);
    }elseif($c == 3){
        $ID = $ID ."<br \>". $Pass;
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
                return "IDは英数字で入力してください";
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