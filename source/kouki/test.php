<?php 
function test(){
    $data = [];

    function test2(){
        $this->$data;
        $data[] = "こんにちわ";
        $data[] = "ありがとう";
    }
    test2();
    print_r($data);
}

test();
?>