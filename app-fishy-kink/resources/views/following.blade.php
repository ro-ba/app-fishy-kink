<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>following</title>
<meta charset="utf-8">
<meta name="description" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="css/user.css">
<link rel="stylesheet" href="css/follow-button.css">
<link rel="stylesheet" href="css/following-follower.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="font/css/open-iconic-bootstrap.css">
<link rel="shortcut icon" href="images/FKicon.png">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
  let userID = "";
  let session = { "userID" :"{{ session('userID') }}"};
  let defaultIcon = "{{ asset('images/default-icon.jpg') }}";
  let mini_loader = "{{ asset('images/tail-spin.svg')}}";
</script>
   
</head>
<body>

<?php
        if (isset($_GET['user'])){
            $target =   $_GET['user'];
        }else{
            $target =   session("userID");
        }
    ?>
    <div class="tabs">
        <input id="follow" onclick="location.href='/following?user={{$target}}'" type="button" name="tab_item" class="checked">
        <label class="tab_item1" for="follow">フォロー中</label>
        <input id="follower" onclick="location.href='/followers?user={{$target}}'" type="button" name="tab_item">
        <label class="tab_item2" for="follower">フォロワー</label>

        <div class="tab_content centerContents" id="followerS_content">
            <div class="following-list"></div>
        </div>

    
    @isset($_GET['user'])
        <button  class="return-button border btn" type="button" onclick="location.href='/profile?user={{$_GET['user']}}'">戻る</button>
    @else
        <button  class="return-button border btn" type="button" onclick="location.href='/profile?user={{session('userID')}}'">戻る</button>
    @endisset
    </div>
    
</body>
<script type="text/javascript" src="{{ asset('js/assets/user.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/assets/follow.js') }}"></script>
<script>
    dispUsers( @json($users) ,"following-list");
</script>
</html>
