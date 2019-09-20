<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title></title>
<meta charset="utf-8">
<meta name="description" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="">
<link rel="shortcut icon" href="">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
<script>
$(function(){ // 遅延処理
  setInterval((function update(){ //1000ミリ秒ごとにupdateという関数を実行する
    $.ajax({
      type: 'GET',
      url: '/api/reloadTweet',    // url: は読み込むURLを表す
      dataType: 'json',           // 読み込むデータの種類を記入
      data: null,
      cache: false
      }).done(function (results) {
        // 通信成功時の処理
        $('#main-contents').empty();
        results.forEach(function(tweet){
          // console.log(tweet);
          $('#main-contents').append('<div class="tweetTop card-header">');
          if (tweet["type"] == "retweet"){
            $('#main-contents').append('<div class="retweet-user">'+ tweet["userID"] + 'さんがリツイートしました</div>');
          }
          $('#main-contents').append('<div class="tweet-user">'+ tweet["userID"] + '</div>');
          $('#main-contents').append('<div class="tweetMain card-body">'+ tweet["text"] + '</div>');
      });
      // $('#main-contents').text(results);
      }).fail(function (err) {
        // 通信失敗時の処理
        alert('ファイルの取得に失敗しました。');
      });
      return update;
    }()),1000);
});
</script>
</head>
<body>
    <input type="button" id="button" value="更新" />

    <div id="main-contents"><div>
</body>
</html>

<div id="centerContents" class="col-sm-6">
            <div class="tweet card">
            @foreach ($tweets as $tweet)
                <div class="tweetTop card-header">
                @if ($tweet["type"] == "retweet")
                    <div class="retweet-user">{{ $tweet["userID"] }}さんがリツイートしました</div>

                @endif
                <div class="tweet-user"> {{ $tweet["userID"] }} </div>
                <div class="time"> {{ $tweet["time"] }}</div>
                        <!-- <div class="date">{{ explode(" ",$tweet["time"])[0] }}</div> 　
                        <div class="time">{{ explode(" ",$tweet["time"])[1] }}</div> -->
                </div>
                <div class="tweetMain card-body">
                    {{ $tweet["text"] }}
                </div>

                @isset($tweet["img"][0])
                @foreach($tweet["img"] as $img)
                    <img src=" {{ $img }}" />
                @endforeach
                @endisset
                <div class="tweetBottom d-inline">
                    <div class="reply d-inline-block">
                        <image src="images/reply.jpg"/>
                    </div>
                    <div class="retweet d-inline-block">
                        <image src="images/retweet.png"/>
                    </div>
                    <div class="fab d-inline-block">
                        <image src="images/fabo.jpg"/>
                    </div>
                </div>
            @endforeach
            </div>