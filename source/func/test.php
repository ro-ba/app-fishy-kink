<?php
require "/vagrant/source/func/FKMongo.php";
require "/vagrant/source/kouki/search.php";
$db = connect_mongo();
$results = search($db,"おにぎり");
print_r($results);
// foreach($results as $result){
//     insert_origin_tweet($db,$result);
// }
?>
