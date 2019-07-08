    <?php
        require "/vagrant/source/func/FKMongo.php";
        require "/vagrant/source/func/FKHash.php";
        
        function login($request){

            $return = [];

            $data = connectMongo();

            $userID = $request -> input("userID");
            $pass = $request -> input("password");

            $d = $request ->get('userID');

            $a = $data["userDB"]->findOne(["userID" => $d]);

            $ID         =  $a["userID"];
            $password   =  $a["password"];

            $salt       =  $a["salt"];
            $data = fkHash($request -> input("password"),$salt);
            
            if($userID== $ID && $data == $password){
                session(["userID" => $userID]);
                session(["pass" => $pass]);
                
                return null;
            }else if($userID != $ID ){

                $return["message"] = "ユーザIDが間違っているか登録されていません。";
                $return["userID"] = $userID;
                return $return;
            
            }else if($userID == $ID  && $data != $password){

                $return["message"] = "パスワードが違っています。";
                $return["userID"] = $userID;
                return $return;
            }
        }
    ?>