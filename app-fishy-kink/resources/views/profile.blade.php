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
  <link rel="stylesheet" type="text/css" href="css/modal.css">
  <link rel="stylesheet" type="text/css" href="css/follow-button.css">
  <link rel="stylesheet" type="text/css" href="css/profile.css">
  <link rel="stylesheet" type="text/css" href="css/tweet.css">
  <link rel="shortcut icon" href="images/FKicon.png">
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
    let session = {
      "userID": "{{ session('userID') }}"
    };
    let defaultIcon = "{{ asset('images/default-icon.jpg') }}";
  </script>
  <script type="text/javascript" src="{{ asset('js/assets/tweet.js') }}"></script>
</head>

<body>
  @include('NaviMenu')

@isset($userData)
    <div class="profile">
      <div class=wrap>
        <div class="image">
          <img class="myicon" id="myIcon" src='{{ $userData["userImg"] }}' alt="myIcon" />
        </div>
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

    <div class="loader">Loading...</div>
    <div class="row tweets">
      <div class="leftContents col-sm-3"></div>
      <div class="centerContents col-sm-6"></div>
      <div class="rightContents col-sm-3"></div>
    </div>

    @else
    <a>ユーザーが存在しません。</a>
    <button onclick="location.href='/'">戻る</button>
    @endisset

    @include('modalsForTweet')
  </div>
</body>
<script>
  // /******************************************************************* ページ読み込んだ瞬間に実行される *******************************************************************/
  $(function() { // 遅延処理
    $.ajax({
      type: 'POST',
      url: '/api/reloadTweets', // url: は読み込むURLを表す
      dataType: 'json', // 読み込むデータの種類を記入
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data: {
        userID: userID
      },
      cache: false
    }).done(function(results) {
      // 通信成功時の処理
      result = results;
      dispTweets(result);
    }).fail(function(err) {
      // 通信失敗時の処理
      alert('ファイルの取得に失敗しました。');
    });
  });
</script>
<script type="text/javascript" src="{{ asset('js/assets/navMenu.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/assets/follow.js') }}"></script>

<script>
  //ボタンを押したらフォローする　または　フォローを外す
  $(function() {
    $(".Follow-button").click(function() {
      follow(userID, $(this));
    });
  });
</script>

</html>