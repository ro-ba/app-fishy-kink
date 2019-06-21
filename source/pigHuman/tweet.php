<?php
require "/vagrant/source/func/FKMongo.php";

$data = connectMongo();
$cursor = $data["userDB"]->find(["userID"=>"tamano"]);
//$cursor = $data["userDB"]->findOne(["userID"=>$_SESSION[‘userName’]]);
foreach($cursor as $userData){
    $user=$userData;
};
if(!empty($_POST['image'])){
    $data["tweetDB"]->insertOne(["tweetID" => $user["userID"],"text" => $_POST['tweetText'],"image"=>$_POST['image']]);
}
else{
    $data["tweetDB"]->insertOne(["tweetID" => $user["userID"],"text" => $_POST['tweetText']]);
}
//tweet($user);
echo "実行完了";
header( "Location: ../html/home.blade.php" ) ;
?>