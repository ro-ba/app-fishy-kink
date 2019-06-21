<?php
require "/vagrant/source/func/FKMongo.php";

function tweet($request){
    $data = connectMongo();
    $request = $request -> all();

    //$cursor = $data["userDB"]->find(["userID"=>"tamano"]);
    //$cursor = $data["userDB"]->findOne(["userID"=>$_SESSION[‘userName’]]);
    // foreach($cursor as $userData){
    //     $user=$userData;
    // };


    if(!empty($request['image'])){
        $data["tweetDB"]->insertOne(["tweetID" => session('userID'),"text" => $request['tweetText'],"image"=>$request['image']]);
        return true;
    }
    else{
        $data["tweetDB"]->insertOne(["tweetID" => session('userID'),"text" => $request['tweetText']]);
        return true;
    }
}

?>
