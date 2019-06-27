







<?php

    $mongo = new Mongo();
    $db = $mongo -> selectDB("test");
    $col = $ db->createCollection("test_col");
    $col->insert(array("key" => "value"));

?>
?>