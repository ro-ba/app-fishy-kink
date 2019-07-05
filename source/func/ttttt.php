<?php
    // ini_set('date.timezone', 'Asia/Tokyo');
    // echo(date("Y/m/d H:i:s"));
?>

<?php
    require "FKMongo.php";
    require "FKHash.php";

    print_r (fkHash("ino","banana"));
    // $data = connectMongo();
    // print_r($data['userDB']->findOne(["userID" => "tamano"]));
    // print_r($data['userDB']->findOne(array('userID' => $request->input('name'))));
    // print_r($data['userDB']->findOne(array('userID' => "shibuya")));

?>

########################################################

<!-- db.user.insert(
    {
            "userID"    :   "tamano",
            "userName"  :   "たまのくん",
            "password"  :   "a09c943bbab62458c23fd7a7921af3ac7a54aa600d31ef0b5f833bc99e3446dc",
            "salt"      :   "ichigo100%",
            "userImg"   :   "",
            "follow"    :   ["shibuya","nishibayashi","ino"],
            "follower"  :   ["shibuya","komaduki"],
            "profile"   :   "たまのです。よろしくおねがいします。",
            "birthday"  :   "1999-02-26"
    }
)

db.user.insert(
    {
        "userID"    :   "ino",
        "userName"  :   "いのくん",
        "password"  :   "d6c8d9fc078e5c71a2fe7a5b943dd91a0bbd75c5f24c365cf95e1c824b3a178c",
        "salt"      :   "MonsterStrike",
        "userImg"   :   "",
        "follow"    :   ["shibuya","nishibayashi","tamano"],
        "follower"  :   ["shibuya","tamano"],
        "profile"   :   "いのです。よろしくおねがいします。",
        "birthday"  :   "2000-01-01"
    }
)

db.tweet.insert(
    {
        "type"      :   "tweet",
        "text"      :   "おなかがへったよ～",
        "userID"    :   "tamano",
        "time"      :   "2019/06/28 13:34:20",
        "img"       :   [],
        "retweetUser"   :   ["shibuya","komaduki"],
        "fabUser"       :   ["nishibayashi"],
        "originTweetID"  :   "",
        "parentTweetID" :   ""
    }
)

db.tweet.insert(
    {
        "type"      :   "tweet",
        "text"      :   "おにぎり食べる？",
        "userID"    :   "ino",
        "time"      :   "2019/06/28 13:40:00",
        "img"       :   [],
        "retweetUser"   :   ["tamano"],
        "fabUser"       :   ["tamano"],
        "originTweetID"  :   "",
        "parentTweetID" :   ObjectId("5d15adfc763834624de38f22")
    }
)

db.tweet.insert(
    {
        "type"      :   "retweet",
        "text"      :   "おにぎりたべたい",
        "userID"    :   "tamano",
        "time"      :   "2019/06/28 13:40:59",
        "img"       :   [],
        "retweetUser"   :   [],
        "fabUser"       :   ["tamano"],
        "originTweetID"  :   ObjectId("5d15ae0d763834624de38f23"),
        "parentTweetID" : "",
    }
)

db.DM.insert(
    {
        "userID"    :   "tamano",
        "partnerID" :   "ino",
        "text"  :   "こんにちわ",
        "time"  :   "2019/06/28 15:02:01",
        "img"   :   []
    }
)

db.DM.insert(
    {
        "userID"    :   "tamano",
        "partnerID" :   "ino",
        "text"  :   "元気ですか？",
        "time"  :   "2019/06/28 15:02:03",
        "img"   :   []
    }
)

db.DM.insert(
    {
        "userID"    :   "ino",
        "partnerID" :   "tamano",
        "text"  :   "こんにちわ 元気ですよ。",
        "time"  :   "2019/06/28 15:03:00",
        "img"   :   []
    }
)

db.notify.insert(
    {
        "userID"    :   "tamano",
        "text"      :   "いのくんにフォローされました。",
        "time"      :   "2019/06/27 10:25:30"
    }
)

db.notify.insert(
    {
        "userID"    :   "tamano",
        "text"      :   "いのくんからDMが届いています。",
        "time"      :   "2019/06/27 10:35:30"
    }
)

db.notify.insert(
    {
        "userID"    :   "ino",
        "text"      :   "たまのくんにフォローされました。",
        "time"      :   "2019/06/27 10:25:30"
    }
) -->