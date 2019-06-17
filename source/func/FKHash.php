<?php
function fkHash($password, $salt){
    $data = $password.$salt;
    print_r($data);
    for($i = 0; $i < 3; $i++){
        $data = hash_hmac("sha256",$data, false);
    }
}      

?>