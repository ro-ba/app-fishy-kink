<?php
//Usage: FKMongo.connectMongo()
require "FKMongo.php";

$data = connectMongo();
// key = userDB, tweetDB, DMDB, NotifyDB
$data["userDB"]->insertOne(["name" => "たまの","tweetID" => "tamano"]);

$a = $data["userDB"]->findOne(["name" => "たまの"]);
print_r($a);


//Usage:FKHash.fkHash()
require "FKHash.php";

$password = "P@ssword";
$salt = "Atsushi Tamano";
$data = fkHash($password,$salt);
print_r($data);

//Usage:FKSession.session_exists()
require "FKSession.php";

if (session_exists()){
    //
}else{
    //
}
?>


