<?php
require "/vagrant/source/func/FKMongo.php";

$db = connect_mongo();
$tweetID = "5d15adfc763834624de38f22";
$fablist = $db["tweetDB"] -> findOne(["_id" => new MongoDB\BSON\ObjectId($tweetID)])["fabUser"];
print_r(gettype($fablist));
print_r("\n");
var_dump((array)$fablist);
?>
