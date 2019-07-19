<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>マイページ</title>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="myPage.css">
    <link rel="shortcut icon" href="">
</head>

<body>
    <div>
        <div id=userData>
            <img id="myIcon" src="<%= icon %>" alt="myIcon" />
            <p id="userName">ホリカクァ（仮）</p>
            <p id="userId">@horikakua</p>
        </div>
        <p id="follow">フォロー</p>
        <p id="follower">フォロワー</p>
        <div id=profile>プロフィール
            <p id=text></p>
        </div>
        <input class="setButton" type="button" onclick="location.href='/setting'" value="プロフィール変更" />
    </div>
    <div id="tweet">ツイート
        <p id="tweetText"></p>
    </div>
</body>

</html>