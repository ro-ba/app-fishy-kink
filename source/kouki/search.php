<?php
require "/vagrant/source/func/FKMongo.php";
function search(){
    $db = connect_mongo();
    //$search = $request->input("search");
    $find = array("text" => new \MongoDB\BSON\Regex("おにぎり"));
    $datas = $db ["tweetDB"] -> find($find);
    $result = [];
    foreach($datas as $id => $obj){
        array_push($result, $obj);
    }
    print_r($result);
    return $result;
}
$search = search();
?>
