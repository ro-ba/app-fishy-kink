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
        <!-- @foreach($userData as $users) -->
        <img class="myIcon" src="<%= icon %>" alt="myIcon" />
        <!-- <p class="usenName">{{ $users->userName }}}</p>
        <p class="userId">{{ $users->userID }}</p>
        <p>フォロー<span class="follow"></span>{{ $users->follow }}人</p>
        <p>フォロワー<span class="follower"></span>{{ $users->follower }}人</p> -->
        <input type="button" onclick="location.href='/setting'" value="プロフィール変更" />
    </div>
    <div>
        <p class="profile">プロフィール</p>
        <!-- {{ $users->profile }} -->
    </div>
    <div>
        <p class="tweet">ツイート</p>
        <!-- {{ $users->tweet }}
        @endforeach -->
    </div>
</body>

</html>