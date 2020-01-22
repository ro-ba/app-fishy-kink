<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>検索</title>
<meta charset="utf-8">
<meta name="description" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="shortcut icon" href="">
<link rel="shortcut icon" href="images/FKicon.png">
<link rel="stylesheet" href="css/search.css" >
<link rel="stylesheet" href="css/user.css" >
<link rel="stylesheet" href="css/tweet.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="font/css/open-iconic-bootstrap.css">
<link rel="stylesheet" href="css/modal.css">
<link rel="stylesheet" href="css/follow-button.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script type="text/javascript">
  let userID = "";
  let session = { "userID" :"{{ session('userID') }}"};
  let defaultIcon = "{{ asset('images/default-icon.jpg') }}";
  let mini_loader = "{{ asset('images/tail-spin.svg')}}"
</script>
@isset($_GET['user'])
<script>
  let getParam = {"user": "{{ $_GET['user'] }}" } 
</script>
@endisset
<script type="text/javascript" src="{{ asset('js/assets/tweet.js') }}"></script>

</head>

<body>
@include('NaviMenu')

<!-- <div id="alertContents"></div> -->

<div class="row tweets">
  <div class="leftContents col-sm-3"></div>
  <div class="centerContents col-sm-6">

    <ul class="search-tab">
      <li class="tab is-active">ツイート</li>
      <li class="tab">ユーザー</li>
      <li class="tab">画像</li>
    </ul>
    <div class="panel-tab">
      <div class="panel search-result-tweet is-show" value="test"></div>
      <div class="panel search-result-user"></div>
      <div class="panel search-result-img"></div>
    </div>

  </div>
  <div class="rightContents col-sm-3"></div>
  </div>
</div>
@include('modalsForTweet')
</body>
</html>

<script>
  jQuery(function($){
    $('.tab').click(function(){
        $('.is-active').removeClass('is-active');
        $(this).addClass('is-active');
        $('.is-show').removeClass('is-show');
        // クリックしたタブからインデックス番号を取得
        const index = $(this).index();
        // クリックしたタブと同じインデックス番号をもつコンテンツを表示
        $('.panel').eq(index).addClass('is-show');
    });
  });
</script>

<script type="text/javascript" src="{{ asset('js/assets/user.js') }}">
</script>
<script type="text/javascript" src="{{ asset('js/assets/follow.js') }}"></script>
<script>

  let tweet_result = @json($results["tweet_result"]);
  let user_result = @json($results["user_result"]);
  let img_result = @json($results["img_result"]);
  dispTweets(tweet_result,"search-result-tweet");
  dispUsers(user_result,"search-result-user");
  dispTweets(img_result,"search-result-img");
  init();

</script>

