<?php
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

function accountDel($id,$FishyKink){
    // $fablist = (array) $FishyKink["tweetDB"]->findOne(["userID" => $id])["fabUser"];

    $retweet = $FishyKink["tweetDB"]->find(["userID" => $id]);
    foreach($retweet as $i){
        $FishyKink["tweetDB"]->deleteMany(["originTweetID" => $i["_id"]]);
    }

    $FishyKink["userDB"]->deleteOne(["userID" => $id]);
    $FishyKink["tweetDB"]->deleteMany(["userID" => $id]);
    // $FishyKink["tweetDB"]->deleteMany(["originTweetID" => $id]);
    $fablist = (array) $FishyKink["tweetDB"]->find(["fabUser" => $id ]);

    if (empty($FishyKink["tweetDB"]->findOne(["fabUser" => $id ]))){
        $return = "error";
    }else{
        //削除
        $fablist = array_diff($fablist, (array) $id);
        //indexを詰める
        $fablist = array_values($fablist);
        $return = "delete";
        //更新
        $FishyKink["tweetDB"]->updateOne(["fabUser" => $id ], ['$set' => ["fabUser" => $fablist]]);
    }
    // foreach($deleteData as $i){
    //     $delete = str_replace($id,'',$i);
    //     $FishyKink["tweetDB"]->updateOne([ "_id" => $i["_id"] ],[$set=>[$delete]]);
    // };
    session()->flush();
    // redirect("profile");
    return "削除しました";
};
?>

