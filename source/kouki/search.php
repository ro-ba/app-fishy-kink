<?php
require "/vagrant/source/func/FKMongo.php";

function search(){
    $db = connect_mongo();
    //$search = $request->input("search");
    $search = "おにぎり たべ";
    $search = explode(" ", $search);
    $count = count($search);
    #print_r($search);
    $result = [];
    for($i = 0; $i < $count; $i++){
        $search_word = $search[$i];
        #print_r($search_word);
        $find = array("text" => new \MongoDB\BSON\Regex("$search_word"));
        $datas = $db ["tweetDB"] -> find($find);
    }
        foreach($datas as $id => $obj){
            array_push($result, $obj);
        }
    print_r($result);
    return $result;
}
$search = search();
?>
