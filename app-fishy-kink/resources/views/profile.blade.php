<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>profile</title>
<meta charset="utf-8">
<meta name="description" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="shortcut icon" href="">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="font/css/open-iconic-bootstrap.css">
<!-- <link rel="stylesheet" type="text/css" href="css/profile.css"> -->
<link rel="stylesheet" type="text/css" href="css/profileh.css">
<link href="https://fonts.googleapis.com/earlyaccess/kokoro.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/earlyaccess/kokoro.css" rel="stylesheet">
<link rel="stylesheet" href="css/loader.css">

<style>
  .accordion .inner {
    display: none;
  }

  .accordion p {
    cursor: pointer;
  }

  .accordion {
    display: inline;
  }
</style>

<script src="https://code.jquery.com/jquery-3.0.0.min.js"></script> 

<script type="text/javascript">
  let userID = "{{ $userData['userID'] }}";
</script>
<script type="text/javascript" src="{{ asset('js/assets/tweet.js') }}"></script>

</head>
<body>
    <!-- <div id="tweet" class="tweet" style="overflow-y:scroll;"></div> -->

    <!-- <div id="tweet" class="tweet" style="height:600px; width:100%; overflow-y:scroll;"></div> -->

</head>
<body>
@isset($userData)

    <div class="profile">
      <div id=wrap>

        <div class="image">
          <img class="myicon" id="myIcon" src='{{ $userData["userImg"] }}' alt="myIcon" />
        </div>

        <ul class="user">
              <li class="user-name">{{ $userData["userName"] }}</li>
            @if($isShowSettings)
              <li class="user-edit"><input class="setButton" type="button" onclick="location.href='/settings'" value="プロフィール変更" /></li>
            @endif
        </ul>

        <div class="user-id"><span>@</span>{{ $userData["userID"] }}</div>
          
        <ul class="follows">
            @isset ($userData["follow"])
                <li class="follow"><button type="button" onclick="location.href='/following?user={{$userData['userID'] }} '">フォロー中　<span></span>{{ count($userData["follow"]) }} 人</button></li>
            @else
                <li class="follow"><button type="button" onclick="location.href='/following?user={{$userData['userID'] }}'">フォロー<span></span>0人</button></li>
            @endisset
            
            @isset ($userData["follower"]) 
                <li class="follower"><button type="button" onclick="location.href='/followers?user={{$userData['userID'] }}'">フォロワー <span></span>{{ count($userData["follower"]) }} 人</button></li>
            @else
                <li class="follow"><button type="button" onclick="location.href='/followers?user={{$userData['userID'] }}'">フォロー<span></span>0人</button></li>
                <li class="follower">フォロワー<span></span>0人</li>
            @endisset

            <li><button class="btn-real-dent" onclick="location.href='/'">戻る</button></li>
        <ul>

      </div>

    <div class="my-profile"> 
      <p class="pro-content">{{ $userData["profile"] }}</p>    
    </div>

    <hr />

    <div class="loader"></div>

    <div class="row tweets">
      <div id="leftContents" class="col-sm-3"></div>
      <div id="centerContents" class="col-sm-6"></div>
      <div id="rightContents" class="col-sm-3"></div>
    </div>       
  @else
    <b>ユーザーが存在しません。</b>
    <button onclick="location.href='/'">戻る</button>
  @endisset
  </div>

</body>
</html>