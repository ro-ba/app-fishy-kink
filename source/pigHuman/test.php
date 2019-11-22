<?php
require "/vagrant/source/func/FKMongo.php";

$FishyKink = connect_mongo();

$FishyKink["notifyDB"]->deleteMany(["userID" => "takuwa"]);
?>
