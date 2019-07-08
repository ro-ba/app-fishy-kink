    <?php
        require "/vagrant/source/func/FKMongo.php";
        require "/vagrant/source/func/FKHash.php";
        
        function login($request){

            $data = connectMongo();

            session( ["userID" => $request -> input("userID")]);
            session( ["pass" => $request -> input("password")]);

            $d = $request->session()->get('userID');

            $a = $data["userDB"]->findOne(["userID" => $d]);
        
            $ID         =  $a["userID"];
            $password   =  $a["password"];
            
            $salt       =  $a["salt"];
            $data = fkHash($request -> input("password"),$salt);
            test();

            if(session("userID") == $ID && $data == $password){
                \Session::flush();

                echo "<script>alert('ログイン成功');</script>";
                // return "OK";
            }else if(session("userID") != $ID ){
                echo "<script>alert('ログインに失敗しました。\nユーザIDが間違っているか登録されていません。');</script>";
            }else if(session("userID") == $ID && $data != $password){
                echo "<script>alert('ログインに失敗しました。\nパスワードが違っています。');</script>";
            }
                 
        }
    ?>