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
        <div class=userData>
            <img id="myIcon" src="<%= icon %>" alt="myIcon" />
            <p id="usenName">ホリカクァ（仮）</p>
            <p id="userId">@horikakua</p>
        </div>
        <p>フォロー<span class="follow"></span>人</p>
        <p>フォロワー<span class="follower"></span>人</p>
        <input class="setButton" type="button" onclick="location.href='/setting'" value="プロフィール変更" />
    </div>
    <div>
        <p name="profile">プロフィール</p>
    </div>
    <div>
        <p name="tweet">ツイート</p>
    </div>
</body>

</html>