<?php
require_once dirname(__FILE__) . "/vendor/autoload.php";
function connectMongo(){   
    $client = new MongoDB\Client("mongodb://localhost:27017");
    $FishyKinkDB = $client->selectDatabase('FishyKink');
    $userDB = $FishyKinkDB->selectCollection('user');
    $tweetDB = $FishyKinkDB->selectCollection('tweet');
    $DMDB = $FishyKinkDB->selectCollection('DM');
    return ["userDB" => $userDB, "tweetDB" => $tweetDB, "DMDB" => $DMDB];
}

// $collection->insertOne([ 'name' => '宇治松千夜', 'shop' => '甘兎庵', 'cv' => '佐藤聡美' ]);
// $collection->insertOne([ 'name' => '桐間紗路', 'shop' => 'フルール・ド・ラパン', 'cv' => '内田真礼']);
// $collection->insertMany([
//     [ 'name' => '保登心愛', 'shop' => 'ラビットハウス', 'cv' => '佐倉綾音' ],
//     [ 'name' => '香風智乃', 'shop' => 'ラビットハウス', 'cv' => '水瀬いのり' ],
//     [ 'name' => '天々座理世', 'shop' => 'ラビットハウス', 'cv' => '種田梨沙' ],
// ]);

// $chiya = $collection->findOne(['name' => '宇治松千夜']);

// $rabbithouse = $collection->find(['shop' => 'ラビットハウス']);
// foreach($rabbithouse as $rabbit){
//     print_r($rabbit);
// }

?>