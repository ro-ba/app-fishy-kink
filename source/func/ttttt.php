<?php
    // ini_set('date.timezone', 'Asia/Tokyo');
    // echo(date("Y/m/d H:i:s"));
?>

<?php
    require "FKMongo.php";
    require "FKHash.php";

    $a = fkHash("orange","range");
    $db = connectMongo();
    $db["userDB"]->insertOne(["userID" => "shibuya","password" => fkHash("orange","range"),"salt" => "range"]);
    
    $b = $db["userDB"]->findOne(["userID" => "shibuya"])["password"];
    print_r($a."</br>");
    print_r($b."</br>");

    print_r(strcmp($a,$b));

    // $data = connectMongo();
    // print_r($data['userDB']->findOne(["userID" => "tamano"]));
    // print_r($data['userDB']->findOne(array('userID' => $request->input('name'))));
    // print_r($data['userDB']->findOne(array('userID' => "shibuya")));

?>