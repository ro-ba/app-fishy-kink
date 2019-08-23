
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
@isset($userData)
    <div>
        <div class="userData">
            <img id="myIcon" src="<%= icon %>" alt="myIcon" />
            <p id="usenName">ユーザー {{ $userData["userName"] }}</p>
            <p id="userId"><span>@</span>{{ $userData["userID"] }}</p>
        </div>
        @if ( isset ($userData["follow"]) )
            <p>フォロー<span class="follow"></span>{{ count($userData["follow"]) }}人</p>
        @else
            <p>フォロー<span class="follow"></span>0人</p>
        @endif

        @if ( isset ($userData["follower"]) )
            <p>フォロワー<span class="follower"></span>{{ count($userData["follower"]) }} 人</p>
        @else
            <p>フォロー<span class="follower"></span>0人</p>
        @endif

        <input class="setButton" type="button" onclick="location.href='/setting'" value="プロフィール変更" />
    </div>
    <div class="profile">
        <p>プロフィール</p>
        <p>{{ $userData["profile"] }}</p>
    </div>
    <div class="tweet">
        <p >ツイート</p>
    </div>
    @else
    <p id="error">エラー</p>
    @endisset
</body>

</html>