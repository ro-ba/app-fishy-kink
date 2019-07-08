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

            if(session("userID") !== $ID || $data !== $password){
                \Session::flush();
                ?>
                <script>
                    alert("ログインに失敗しました");
                </script>
                <?php
            }          
        }

        ?>