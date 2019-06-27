    <?php
    require "/vagrant/source/func/FKMongo.php";

    $data = connectMongo();
    $a = $data["userDB"]->findOne(["userID" => "shibuya"]);
    print_r($a);
    function shibuya_test($request){

        session( ["userID" => $request -> input("userID")]);
        session( ["pass" => $request -> input("password")]);

        if(session("userID") != "shibuya" || session("pass") != "asdfgh"){
            ?>
            ログインに失敗しました。<br />
            <a href="a.php">ログインページヘ</a>
            <?php
            exit;
        }
    }

    ?>