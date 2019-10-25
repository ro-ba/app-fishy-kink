<<<<<<< HEAD
<?php
//require_once dirname(__FILE__) . '/vendor/autoload.php';

function myPageSetting($id, $request,$FishyKink){
    $name = $request->input("userName");
    $profile = $request->input("profileText");
<<<<<<< HEAD
    ( empty($name) ) ?  print_r("ユーザーネームを入力してください") : $FishyKink["userDB"]->updateOne(["userID" => $id], ['$set'=> ["userName" => $name , "profile" => $profile]]);  
=======
    $userImg = $request->userImg;
    if(empty($name)){ //userNameが空だったら
        return "変更できませんでした。";
    }else{ //空じゃなかったら変更
        if(isset($userImg)){
            //拡張子取得
            $ext = explode("/",$userImg->getMimeType())[1];
            //画像fileを取得してバイナリにエンコード
            $encode_img = base64_encode(file_get_contents($userImg));
            $userImage = 'data:image/' . $ext . ';base64,' . $encode_img;
            $FishyKink["userDB"]->updateOne(["userID" => $id], ['$set'=> ["userName" => $name , "profile" => $profile , "userImg" => $userImage]]);
        }else{
            $FishyKink["userDB"]->updateOne(["userID" => $id], ['$set'=> ["userName" => $name , "profile" => $profile]]);
        }
       
        return "変更しました。";
    };
>>>>>>> 824700c268d3fa7f0aba41639f1f8ebec0e707fc
}
?>
=======
<?php
//require_once dirname(__FILE__) . '/vendor/autoload.php';

function myPageSetting($id, $request,$FishyKink){
    $name = $request->input("userName");
    $profile = $request->input("profileText");

    $userImg = $request->userImg;
    if(empty($name)){ //userNameが空だったら
        return "変更できませんでした。";
    }else{ //空じゃなかったら変更
        if(isset($userImg)){
            //拡張子取得
            $ext = explode("/",$userImg->getMimeType())[1];
            //画像fileを取得してバイナリにエンコード
            $encode_img = base64_encode(file_get_contents($userImg));
            $userImage = 'data:image/' . $ext . ';base64,' . $encode_img;
            //ユーザーデータベースを更新
            $FishyKink["userDB"]->updateOne(["userID" => $id], ['$set'=> ["userName" => $name , "profile" => $profile , "userImg" => $userImage]]);
            
            //ツイートデータベースを一括更新
            $FishyKink["tweetDB"] -> updateMany(["userID" => $id], ['$set' => ["userImg" => $userImage]]);
        }else{
            $FishyKink["userDB"]->updateOne(["userID" => $id], ['$set'=> ["userName" => $name , "profile" => $profile]]);
        }
       
        return "変更しました。";
    };

}
?>
>>>>>>> 98bfcb3f59bf607807ef011c74a6c55e7e4feef4
