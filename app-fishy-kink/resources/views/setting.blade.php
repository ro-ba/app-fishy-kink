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
<link rel="stylesheet" type="text/css" href="css/setting.css">
</head>
<body>
@isset($userData)
    <div>
        <form method="post">
            <div class="userData">
                <img class="myIcon" src='{{ $userData["userImg"] }}' alt="myIcon" />
                <input type="text" class="usenName" value='{{ $userData["userName"] }}'>
                <p class="userId"><span>@</span>{{ $userData["userID"] }}</p>
            </div>
            <div class="profile">
                <p>プロフィール</p>
                <textarea name="profileText" rows="4" cols="80">{{ $userData["profile"] }}</textarea>
            </div>
            <input class="btn setting" type="submit" value="適用">
            <input class="btn btn-success" type="button" onclick="location.href='/myPage'" value="戻る">
        </form>
    @else
    <p id="error">エラー</p>
    @endisset
</body>

</html>