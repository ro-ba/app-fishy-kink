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
        <img name="myIcon" src="<%= icon %>" alt="myIcon" />
        <p name="usenName">ホリカクァ（仮）</p>
        <p name="userId">@horikakua</p>
        <p>フォロー<span name="follow"></span>人</p>
        <p>フォロワー<span name="follower"></span>人</p>
        <input type="button" onclick="location.href='/setting'" value="プロフィール変更" />
    </div>
    <div>
        <p name="profile">プロフィール</p>
    </div>
    <div>
        <p name="tweet">ツイート</p>
    </div>
</body>

</html>