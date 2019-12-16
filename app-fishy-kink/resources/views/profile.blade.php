<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>myPage</title>
<meta charset="utf-8">
<meta name="description" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="shortcut icon" href="">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="font/css/open-iconic-bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/profile.css">
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
  let session = { "userID" :"{{ session('userID') }}"};
</script>
<script type="text/javascript" src="{{ asset('js/assets/tweet.js') }}"></script>
</head>

<body>
@yield('pcontent')
<!-- <div id="menu row d-inline col-md-12">
        <button type="button" class="link_button btn page-link text-dark d-inline-block" onclick="location.href='/home'">home</button>
        <button type="button" class="link_button btn page-link text-dark d-inline-block" onclick="location.href='/notify'">通知
        @if($count != 0)
        <p class = "readCount"  data-badge="{{ $count }}"></p></button>
        @endif
        <button type="button" class="link_button btn page-link text-dark d-inline-block" onclick="location.href='/DM'">メッセージ</button>
        <button type="button" class="link_button btn page-link text-dark d-inline-block" onclick="location.href='/story'">ストーリー</button>
        <input type="image" class="link_button btn page-link text-dark d-inline-block" onclick="location.href='/profile'" src="{{ $userIcon }}" height="40" width="40" class="img-thumbnail" style="width: auto; padding:0; margin:0; background:none; border:0; font-size:0; line-height:0; overflow:visible; cursor:pointer;">
        </button>

        <form method='get' action="/search" class="form-inline d-inline">

        <input class="form-control" type=text name="searchString">
        <button class="form-control" type=input> <span class="oi oi-magnifying-glass"></span> 検索 </button>
    
        </form>
        <button type="button" id="tweet" class="link_button btn page-link text-dark d-inline-block">ツイート</button>
            <button type=" button" class="link_button btn page-link text-dark d-inline-block" onclick="location.href='/logout'">ログアウト</button>
    </div> -->
@isset($userData)
    <div class="profile">
      <div id=wrap>

        <div class="image">
          <img class="myicon" id="myIcon" src='{{ $userData["userImg"] }}' alt="myIcon" />
        </div>

        <ul class="user">
            <li class="user-name">{{ $userData["userName"] }}</li>
            @if(!$isShowSettings)
              <form method=POST>
              @csrf
                @if($nowFollow == False)
                  <!-- <button type="submit" class="nowFollow">フォローする</button> -->
                  <button type="submit" class="noFollow" style="color:#696969;" 
                  onmouseover="this.style.color='#696969',
                  this.innerHTML='フォローする'" 
                  onmouseout="this.style.color='#696969',
                  this.innerHTML='フォローしていません'">
                  フォローしていません</button>
                @else
                  <!-- <button type="submit" class="nowFollow">フォロー中</button> -->
                  <button type="submit" class="nowFollow" style="color:#696969;" 
                  onmouseover="this.style.color='red',
                  this.innerHTML='フォローを外す'" 
                  onmouseout="this.style.color='#696969',
                  this.innerHTML='フォロー中'">
                  フォロー中</button>
                @endif
              </form>
            @endif
            @if($isShowSettings)
              <li class="user-edit"><input class="setButton" type="button" onclick="location.href='/settings'" value="プロフィール変更" /></li>
            @endif
        </ul>

        <div class="user-id"><span>@</span>{{ $userData["userID"] }}</div>
             
        <ul class="follows">
                <li class="follow"><button type="button" onclick="location.href='/following?user={{$userData['userID'] }} '">フォロー中 <span></span>{{ count($userData["follow"]) }} 人</button></li>
                <li class="follower"><button type="button" onclick="location.href='/followers?user={{$userData['userID'] }} '">フォロワー <span></span>{{ count($userData["follower"]) }} 人</button></li>

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
    <a>ユーザーが存在しません。</a>
    <button onclick="location.href='/'">戻る</button>
  @endisset
  </div>               
</body>

</body>
</html>