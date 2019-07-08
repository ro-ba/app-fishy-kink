<?php
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

    //$num = 
    //$anser = Passcheck("123a");
    //print_r($anser);
?>