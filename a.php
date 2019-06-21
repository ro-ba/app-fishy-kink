<?php
    require "source/func/FKMongo.php";

$data = connectMongo();

SESSION_start();

$_SESSION["loginname"] = $_POST["userID"];
echo $_SESSION["loginname"] ;
$_SESSION["pass"] = $_POST["pass"];
if($_SESSION["loginname"] != "shibuya" || $_SESSION["pass"] != "asdfgh"){
    ?>
    ログインに失敗しました。<br />
    <a href="login.html">セッション生成ページ</a>
    <?php
    exit;
}
    
?>