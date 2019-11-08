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
<link rel="stylesheet" type="text/css" href="css/profile.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

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

</head>
<body>
    <div id="tweet" class="tweet" style="overflow-y:scroll;"></div>

    <div id="tweet" class="tweet" style="height:600px; width:100%; overflow-y:scroll;"></div>
    

<script src="https://code.jquery.com/jquery-3.0.0.min.js"></script> 

<script type="text/javascript">
  let userID = "{{$userData['userID'] }}";
</script>
<script type="text/javascript" src="{{ asset('js/assets/tweet.js') }}"></script>


</head>
<body>
@isset($userData)
  <div class = "userBar">
      <div class="userData">
          <img class="Images" id="myIcon" src='{{ $userData["userImg"] }}' alt="myIcon" />
          <p id="usenName">{{ $userData["userName"] }}</p>
          <p id="userId"><span>@</span>{{ $userData["userID"] }}</p>
      </div>
      @isset ($userData["follow"])
          <button type="button" onclick="location.href='/following?user={{$userData['userID'] }} '" class="follow">フォロー中　<span></span>{{ count($userData["follow"]) }} 人</button>
      @else
          <button type="button" onclick="location.href='/following?user={{$userData['userID'] }}'">フォロー<span class="follow"></span>0人</button>
      @endisset
      
      @isset ($userData["follower"]) 
          <button type="button" onclick="location.href='/followers?user={{$userData['userID'] }}'" class="follower">フォロワー <span></span>{{ count($userData["follower"]) }} 人</button>
      @else
          <button type="button" onclick="location.href='/followers?user={{$userData['userID'] }}'">フォロー<span class="follower"></span>0人</button>
          <p class="follower">フォロワー<span></span>0人</p>
      @endisset

      @if($isShowSettings)
        <input class="setButton" type="button" onclick="location.href='/settings'" value="プロフィール変更" />
      @endif

  <hr class="bar1"/>
  <hr class="bar2"/>
  <!-- <hr class="bar3"/>
  <hr class="h1">  -->

    <button class="btn-real-dent" onclick="location.href='/'">戻る
    <i class="fa fa=home"></i>
    </button>

     
</a>


  </div>
  <div class="profile">
    <p>プロフィール</p>
        <p>{{ $userData["profile"] }}</p>    
  </div>      
  <div class="row tweets">
    <div id="leftContents" class="col-sm-3"></div>
    <div id="centerContents" class="col-sm-6"></div>
    <div id="rightContents" class="col-sm-3"></div>
  </div>       
@else
  <b>ユーザーが存在しません。</b>
  <button onclick="location.href='/'">戻る</button>
@endisset
</body>

</html>
