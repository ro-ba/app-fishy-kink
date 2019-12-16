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
<!-- ↓body閉じタグ直前でjQueryを読み込む" -->
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
@if ( isset($originTweets) )
  @if( isset($originTweets["originTweetID"] ) )
    <div class="tweetTop card-header" onclick=`location.href="/replyTree?tweetId={{ $originTweets['originTweetID'] }}"`>
  @else
    <div class="tweetTop card-header" onclick=`location.href="/replyTree?tweetId={{ $originTweets['_id'] }}"`>
  @endif 
    <div class="tweetTop-left" style="display:inline-block; vertical-align:middle;">
      <img src="{{ $originTweets['userImg'] }}" width="50px" height="50px" />
      <div class="tweetTop-right" style="display:inline-block; vertical-align:middle; position:relative; left:10%;">
        <div class="tweet-user">
            <a href="/profile?user={{ $originTweets['userID'] }}">
              <span>{{ $originTweets["userName"] }}</span><span>@</span><span>{{ $originTweets["userID"] }}</span>
            </a>
        </div>
      </div>
    </div>
    <div class="tweetMain card-body">{{ $originTweets["text"] }}</div>
    <div class="imagePlaces" style=float:left>
    @if(isset($originTweets["img"] ))
      @foreach( $originTweets["img"] as $key => $img)
        <img src=" {{ $img }}" width="200" height="150" />
      @endforeach
    @endif
  </div>
@endif

@if(isset($replys))
  @foreach($replys as $reply)
    <div class="tweetTop card-header" onclick=`location.href="/replyTree?tweetId={{ $reply['_id'] }}"`>
      <div class="tweetTop-left" style="display:inline-block; vertical-align:middle;">
        <img src="{{ $reply['userImg'] }}" width="50px" height="50px" />
        <div class="tweetTop-right" style="display:inline-block; vertical-align:middle; position:relative; left:10%;">
          <div class="tweet-user">
              <a href="/profile?user={{ $reply['userID'] }}">
                <span>{{ $reply["userName"] }}</span><span>@</span><span>{{ $reply["userID"] }}</span>
              </a>
          </div>
        </div>
      </div>
      <div class="tweetMain card-body">{{ $reply["text"] }}</div>
      <div class="imagePlaces" style=float:left>
      @if(isset($reply["img"] ))
        @foreach( $reply["img"] as $key => $img)
          <img src=" {{ $img }}" width="200" height="150" />
        @endforeach
      @endif
    </div>
  @endforeach
@endif
</body>
</html>
