<?php
    //require "../func/FKMongo.php";
    require "IDcheck.php";
    require "passwordcheck.php";
    $data = connectMongo();

    $ID = IDcheck("123aaa");
    $Pass = Passcheck("pas1");

    //$data["userDB"]->insertOne(["_id" => $ID,"pass" => $Pass]);

    print_r($ID);
    print_r($Pass);
?>