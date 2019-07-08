<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>tweet</title>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">
    <link rel="shortcut icon" href="">
</head>

<body>
    <form action="./pighuman/tweet.php"  class="tweet" method="POST">
        <div>
            <img class="myIcon" src="<%= icon %>" alt="myIcon" />
            <textarea class="tweetText" cols="50" rows="7" maxlength="200" value="いまどうしてる？"></textarea>
            <div>
                <img src="<%= image%>" alt="ツイート画像" />
                <a href="./newTweetImage.html"><img src="./plusImage.jpg" alt="画像追加" /></a>
                <input class="newTweet" method="POST" type="submit" value="ツイート" />
            </div>
    </form>
</body>

</html>
