<?php
    function IDcheck($newid){
    //$newid = $_GET['newid'];
    $mongo = new MongoClient();
    $db = $mongo->selectDB("User");
    $col = new MongoCollection($db,"user");
    
    $check = $col -> findone(["_id" => $newid]);
    if($check){
        echo "NG";
    }else{
        echo "OK";
    }

    }
    if(isset($_POST[‘comment’])){
        $comment = $_POST[‘comment’];
        echo $comment;
    IDcheck("1a");
?>