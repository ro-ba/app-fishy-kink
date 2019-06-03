<?php
    $mongo = new Mongo();
    $db = $mongo->selectDB("userdb"); 
    $collection = $db->selectCollection("userdb");
    $id = "1a";
    $doc = array( "_id" => "$id" ); 
    $res = $collection->findOne( $doc ); 
    var_dump ($res); 

    //idチェック
    //if($newid){
    //    echo "このIDは設定できません";
    //} else {
    //    echo "OK";
    //}
?>