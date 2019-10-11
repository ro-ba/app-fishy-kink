<?php
//require_once dirname(__FILE__) . '/vendor/autoload.php';

function myPageSetting($id, $request,$FishyKink){
    $name = $request->input("userName");
    $profile = $request->input("profileText");
    $userImg = $request->file("userImg");
    if(empty($name)){ //userNameが空だったら
        return "変更できませんでした。";
    }else{ //空じゃなかったら変更
        if($request->hasfile("myIconPreview")){
            $image = $request->file("myIconPreview")
            //拡張子取得
            // $ext = explode("/",$image->getMimeType())[1];
            //画像fileを取得してバイナリにエンコード
            $img = base64_encode(file_get_contents($image));
            // $userImg[] = 'data:image/' . $ext . ';base64,' . $encode_img;
        };
        $FishyKink["userDB"]->updateOne(["userID" => $id], ['$set'=> ["userName" => $name , "profile" => $profile , "userImg" => $img]]);
        return "変更しました。";
    };
}
?>
