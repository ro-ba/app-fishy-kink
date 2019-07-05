    <?php
    require "/vagrant/source/func/FKMongo.php";
    require "/vagrant/source/func/FKHash.php";

    $data = connectMongo();
    
    function shibuya_test($request){
    // global $data;
    $data = connectMongo();

    session( ["userID" => $request -> input("userID")]);
    session( ["pass" => $request -> input("password")]);

    $d = $request->session()->get('userID');

    $a = $data["userDB"]->findOne(["userID" => $d]);
   
    $ID         =  $a["userID"];
    $password   =  $a["password"];
    
    $salt       =  $a["salt"];
    $data = fkHash($request -> input("password"),$salt)."</br>";
    // print_r($password);
    // print_r("</br>");
    // print_r( $data);
    // print_r(strcmp($data,$password));
    for ($i = 0;$i < strlen($data); $i++){
        print_r($i);
        // if($data[$i] !== $password[$i]){
        //     // echo("犯人は".$password[$i]."ですですですで");
        // }
    }

    if(session("userID") !== $ID || $data !== $password){
        // print_r(strcmp($data,$password));
    // if(strcmp($data,$password) != 0){
        \Session::flush();
        ?>
        ログインに失敗しました。<br />
        <a href="login">ログインページヘ</a>
        <?php
        exit;
    }          

    }

    ?>