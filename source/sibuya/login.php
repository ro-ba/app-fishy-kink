    <?php
        require "/vagrant/source/func/FKHash.php";
        
        function login($request ,&$data){

            $return = [];

            $userID = $request -> input("userID");
            $pass = $request -> input("password");
            
            $a = $data["userDB"]->findOne(["userID" => $userID]);

            $ID         =  $a["userID"];
            $password   =  $a["password"];

            $salt       =  $a["salt"];
            $data = fk_hash($request -> input("password"),$salt);
            
            if($userID== $ID && $data == $password){
                
                session(["userID" => $userID]);
     
                return null;
            }else if($userID != $ID ){

                $return["message"] = ["danger","ユーザIDが間違っているか登録されていません。"];
                $return["userID"] = $userID;
                return $return;
            }else if($userID == $ID  && $data != $password){
                
                $return["message"] = ["danger","パスワードが違っています。"];
                $return["userID"] = $userID;
                return $return;
            }
        }
    ?>