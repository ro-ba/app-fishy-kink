<?php
    require "/vagrant/source/func/FKMongo.php";

function shibuya_test($request){    //$requestにはpostで送られたパラメータが入っている
    $data = connectMongo();
    session( ["userID" => $request -> input("userID")]);
    session( ["pass" => $request -> input("password")]);
    // print_r(session("loginname"));
    // print_r(session("pass"));
    if(session("userID") != "shibuya" || session("pass") != "asdfgh"){
        ?>
        ログインに失敗しました。<br />
        <a href="login.html">セッション生成ページ</a>
        <?php
        exit;
    }
}
    
?>