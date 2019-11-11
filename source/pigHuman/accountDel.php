<?php
function accountDel($id,$FishyKink){
    $FishyKink["userDB"]->remove(["userID" => $id]);
    $FishyKink["tweetDB"]->remove(["userID" => $id]);
    $FishyKink["tweetDB"]->remove(["originTweetID" => $id]);
    $deleteData = $FishyKink["tweetDB"]->find(["fabUser" => $id ]);
    foreach($deleteData as $i){
        if($i["fabUser"=>$id]){
            $delete = str_replace($id,'',$i);
            $FishyKink["tweetDB"]->update([ "_id" => $i["_id"] ],[$set=>[$delete]);
        };
    };
    unset($_SESSION("visited"));
    return true;
};

?>
