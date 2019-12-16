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
<link rel="stylesheet" href="css/loader.css">
  <link rel="stylesheet" href="css/loader.css">

<script type="text/javascript">
  let userID = "";
  let session = { "userID" :"{{ session('userID') }}"};
  let defaultIcon = "{{ asset('images/default-icon.jpg') }}";
</script>

<script type="text/javascript" src="{{ asset('js/assets/replyTree.js') }}"></script>
<!-- ↓body閉じタグ直前でjQueryを読み込む -->
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
@if ( isset($originTweets) )
  @foreach( $originTweets as tweets )
    @if( isset($Origintweets->originTweetID) )
      <div class="tweetTop card-header" onclick=`location.href="/replyTree?tweetId={{ $tweets->originTweetID }}"`>
    @else
      <div class="tweetTop card-header" onclick=`location.href="/replyTree?tweetId={{ $tweets->_id }}"`>
    @endif
      <div class="tweetTop-left" style="display:inline-block; vertical-align:middle;">
        <img src="{{ $tweets['userIcon'] }}" width="50px" height="50px" />
        <div class="tweetTop-right" style="display:inline-block; vertical-align:middle; position:relative; left:10%;">
          <div class="tweet-user">
              <a href="/profile?user={{ $tweets['userID'] }}">
                <span>{{ $originUser }}</span><span>@</span><span>{{ $tweets->userID }}</span>
              </a>
          </div>
        </div>
      </div>
      <div class="tweetMain card-body">{{ $tweets["text"] }}</div>
      <div class="imagePlaces" style=float:left>
      @if(isset($tweets["img"]))
        @foreach( $tweets as $key => $img)
          <img src=" {{ $value }}" width="200" height="150" />
        @endforeach
      @endif
    </div>
  @endforeach

    <div class="row tweets">
        <div class="leftContents col-sm-3"></div>
        <div class="centerContents col-sm-6"></div>
        <div class="rightContents col-sm-3"></div>
    </div>
  </div>
@else
  ツイートがありません
@endif
</body>
</html>


<script>
  $(function () { // 遅延処理
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
      }).done(function (results) {
          // 通信成功時の処理
          result = results;
          dispTweets(result);
      }).fail(function (err) {
          // 通信失敗時の処理
          alert('ファイルの取得に失敗しました。');
      });
  });
</script>