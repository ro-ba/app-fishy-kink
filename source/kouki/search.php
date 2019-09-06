<?php
function search($search){
    $db = connect_mongo();
    $search = mb_convert_kana($search, 's');//全角スペースを半角にする
    $search = explode(" ", $search);
    $count = count($search);
    $find = [];//
    for($i = 0; $i < $count; $i++){
        $search_word = $search[$i];
        //検索する文字列の数文下の配列を増やす
        ${"find".$i} = array("text" => new \MongoDB\BSON\Regex("$search_word"));
        array_push($find, ${"find".$i});
    }
    $datas = $db ["tweetDB"] -> find(array('$and' => $find));//検索する
    //$datas = $db ["tweetDB"] -> find(array("text" => "おにぎり","text" => "たべたい"));
    
    foreach($datas as $obj){
        //array_push($result, $obj);
        //print_r($result);
        print_r($obj);
    }
    return true;
}
?>
