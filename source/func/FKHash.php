<?php
function fkHash($password, $salt){
    $data = $password.$salt;
    for($i = 0; $i < 1; $i++){
        $data = hash_hmac("sha256",$data,false);
    }
    return trim($data);
}      

?>