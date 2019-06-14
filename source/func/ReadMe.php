<?php
require "FKMongo.php";

$data = connectMongo();
// key = userDB, tweetDB,DMDB
$data["userDB"]->insertOne(["name" => "たまの","tweetID" => "tamano"]);

$a = $data["userDB"]->findOne(["name" => "たまの"]);
print_r($a);
?>
