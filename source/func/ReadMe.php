<?php
//Usage: FKMongo
require "FKMongo.php";

$data = connectMongo();
// key = userDB, tweetDB,DMDB
$data["userDB"]->insertOne(["name" => "たまの","tweetID" => "tamano"]);

$a = $data["userDB"]->findOne(["name" => "たまの"]);
print_r($a);


//Usage:FKHash
require "FKHash.php";

$password = "P@ssword";
$salt = "Atsushi Tamano";
$data = fkHash($password,$salt);
print_r($data);
?>
