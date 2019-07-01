    <?php
    require "/vagrant/source/func/FKMongo.php";
    $data = connectMongo();
    
    function shibuya_test($request){
    // global $data;
    $data = connectMongo();

    $a = $data["userDB"]->findOne(array("userID" => $request -> input("userID")));
    print_r($a);
    // foreach ($a as $doc) {
    //     $ID[] =  $doc["userID"];
    //     $Pass[] = $doc["passWord"];
    //     // print_r($ID);
    // }
    
    session( ["userID" => $request -> input("userID")]);
    session( ["pass" => $request -> input("password")]);


    // $a = $data["userDB"]->findOne(["userID" => $ID[1]]);
    // $ID     =  $a["userID"];
    // $Pass   =  $a["passWord"];
    // print_r($a);

                if(session("userID") != $ID || session("pass") != $Pass){
                ?>
                     ログインに失敗しました。<br />
                    <a href="login">ログインページヘ</a>
                <?php
                exit;
                }           

    }

    ?>