<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Settings</title>
<meta charset="utf-8">
<meta name="description" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="font/css/open-iconic-bootstrap.css">
<!-- <link rel="stylesheet" type="text/css" href="css/setting.css"> -->
<!-- <script type="text/javascript" src="{{ URL::asset('js/prev-image.js') }}"></script> -->
<script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
<script type="text/javascript" src="js/prev-image.js"></script>
</head>
<body>
@isset($userData)
    <div>
        <form method="post" enctype="multipart/form-data">
        @csrf
            <div class="userData">
                <div class="userImage">
                    <img class="myIcon preview" src='{{ $userData["userImg"] }}' alt="myIcon" style="width:200px; height:200px;"/>
                    <input type="file" name="userImage"  accept="image/*"/>
                </div>
                <div class="userID">
                    ユーザーID： {{ $userData["userID"] }}
                </div>
                <div class="userName">
                ユーザー名：
                <input type="text" name="userName" class="usenName" value='{{ $userData["userName"] }}'>
                <div class="profile">
                    <p>プロフィール</p>
                    <textarea name="profileText" rows="4" cols="80">{{ $userData["profile"] }}</textarea>
                </div>
            </div>
            
            <input class="btn btn-primary" type="submit" value="適用">
            <input class="btn btn-default" type="button" onclick="location.href='/profile'" value="戻る">
        </form>
@else
    <p id="error">エラー</p>
@endisset
</body>

</html>