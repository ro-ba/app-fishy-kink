<?php
function search($search){
    $db = connect_mongo();
    #$search = $request->input("searchString");
    #$search = "おにぎり たべ";
    $search = mb_convert_kana($search, 's');
    $search = explode(" ", $search);
    $count = count($search);
    $result = [];
    for($i = 0; $i < $count; $i++){
        $search_word = $search[$i];
        $find = array("text" => new \MongoDB\BSON\Regex("$search_word"));
        if($i == 0){
            $datas = $db ["tweetDB"] -> find($find);
        }else{
            $datas = $datas->find($find);
        }
    }
    foreach($datas as $obj){
        array_push($result, $obj);
        print_r($result);
        //array_push($result,"<br />" );
    }
    return $result;
}
?>
