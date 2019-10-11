<?php
//require_once dirname(__FILE__) . '/vendor/autoload.php';

function myPageSetting($id, $request,$FishyKink){
    $name = $request->input("userName");
    $profile = $request->input("profileText");
    $userImg = [];
    if(empty($name)){ //userNameが空だったら
        return "変更できませんでした。";
    }else{ //空じゃなかったら変更
        // if($request->hasfile("preview")){
        //     $image = $request->file("preview");
        //     //拡張子取得
        //     $ext = explode("/",$image->getMimeType());
        //     //画像fileを取得してバイナリにエンコード
        //     $encode_img = base64_encode(file_get_contents($image));
        //     $userImg = 'data:image/jpg;base64,' . $encode_img;
        // };
        if($request->hasfile("userImg")){
            foreach($request->file("userImg") as $image){
                //拡張子取得
                $ext = explode("/",$image->getMimeType())[1];
                //画像fileを取得してバイナリにエンコード
                $encode_img = base64_encode(file_get_contents($image));
                
                $userImg[] = 'data:image/' . $ext . ';base64,' . $encode_img;
                var_dump($userImg);
                $FishyKink["userDB"]->updateOne(["userID" => $id], ['$set'=> ["userName" => $name , "profile" => $profile , "userImg" => $userImg]]);
            }
        }else{
        $FishyKink["userDB"]->updateOne(["userID" => $id], ['$set'=> ["userName" => $name , "profile" => $profile]]);
        }
       
        return "変更しました。";
    };
}
?>
