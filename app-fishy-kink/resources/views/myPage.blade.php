<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>マイページ</title>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">
    <link rel="shortcut icon" href="">
</head>

<body>
    <div>
        <img class="myIcon" src="<%= icon %>" alt="myIcon" />
        <p class="usenName">ホリカクァ（仮）</p>
        <p class="userId">@horikakua</p>
        <p>フォロー<span class="follow"></span>人</p>
        <p>フォロワー<span class="follower"></span>人</p>
        <input type="button" onclick="location.href='/setting'" value="プロフィール変更" />
    </div>
    <div>
        <p class="profile">プロフィール</p>
    </div>
    <div>
        <p class="tweet">ツイート</p>
    </div>
</body>

</html>