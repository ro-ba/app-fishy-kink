<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>myPage</title>
<meta charset="utf-8">
<meta name="description" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="font/css/open-iconic-bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/myPage.css">

<script type="text/javascript">
  let userID = "{{ $userData["userID"] }}";
</script>
<script type="text/javascript" src="{{ asset('js/assets/tweet.js') }}"></script>

</head>
<body>
@isset($userData)
    <div>
        <div class="userData">
            <img id="myIcon" src='{{ $userData["userImg"] }}' alt="myIcon" />
            <p id="usenName">ユーザー {{ $userData["userName"] }}</p>
            <p id="userId"><span>@</span>{{ $userData["userID"] }}</p>
        </div>
        @if ( isset ($userData["follow"]) )

            <button type="button" onclick="location.href='/following'">フォロー<span class="follow"></span>{{ count($userData["follow"]) }}人</button>
        @else
            <button type="button" onclick="location.href='/following'">フォロー<span class="follow"></span>0人</button>
        @endif

        @if ( isset ($userData["follower"]) )
            <button type="button" onclick="location.href='/followers'">フォロワー<span class="follower"></span>{{ count($userData["follower"]) }} 人</button>
        @else
            <button type="button" onclick="location.href='/followers'">フォロー<span class="follower"></span>0人</button>
        @endif

        <input class="setButton" type="button" onclick="location.href='/setting'" value="プロフィール変更" />
    </div>
    <div class="profile">
        <p>プロフィール</p>
           <p>{{ $userData["profile"] }}</p>
    </div>
    <div id="alertContents"></div>
  <div class="loader">Loading...</div>
  <div class="row">
    <div id="leftContents" class="col-sm-3"></div>
    <div id="centerContents" class="col-sm-6"></div>
    <div id="rightContents" class="col-sm-3"></div>
  </div>
</body>

</html>