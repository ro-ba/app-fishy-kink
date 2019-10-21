<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>myPage</title>
<meta charset="utf-8">
<meta name="description" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="font/css/open-iconic-bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/profile.css">
</head>
<body>


        <!-- <input class="setButton" type="button" onclick="location.href='/setting'" value="プロフィール変更" />
    <hr class="bar1">

    </div>
    <div class="profile">
        <p>プロフィール</p>
           <p>{{ $userData["profile"] }}</p> -->

           
    <!-- <div id="tweet" class="tweet" style="height:600px; width:100%; overflow-y:scroll;"></div> -->
    <div id="tweet" class="tweet" style="overflow-y:scroll;"></div>
    
    

    <div id="tweet" class="tweet" style="height:600px; width:100%; overflow-y:scroll;"></div>
    

<script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
<script>
$(function(){ // 遅延処理
  setInterval((function update(){ //1000ミリ秒ごとにupdateという関数を実行する
    $.ajax({
      type: 'POST',
      url: '/api/reloadTweets',    // url: は読み込むURLを表す
      dataType: 'json',           // 読み込むデータの種類を記入
      data: {userID:'{{ $userData["userID"] }}',
            _token: '{{ csrf_token() }}'
            },
      cache: false
      }).done(function (results) {
        // 通信成功時の処理          
        $('#tweet').empty();
        let tweetType = "";

        results.forEach(function(tweet){


          // リツイート 
          if (tweet["type"] == "retweet") {
            tweetType = '<div class="retweet-user">リツイート済み</div>';
          } 

          else {
            tweetType = ""
          }        
          $('#tweet').append(
                '<div class="tweetTop card-header">'+
                    '<div class="tweet-user">' +
                    '</div>' +
                    tweetType + 
                    '<a href=/profile?user=' + tweet["userID"] +'>'+
                        tweet["userID"] +
                    '</a> '+
                   '<div class="time">'
                        + tweet["time"] + 
                    '</div> '+
                '</div></div>');
                $('#tweet').append('<div class="tweetMain card-body">'+ tweet["text"] + '</div>');

          // 画像表示
          $('#tweet').append('<div style=float:left>');
          for(var i=0;i<tweet["img"].length;i++){
            $('#tweet').append('<img src="' + tweet["img"][i] + '"width="200" height="150" />');
          }
          $('#tweet').append('</div><p>');
          
          $('#tweet').append('<div class="tweetBottom d-inline">');
          $('#tweet').append('<button type="button" class="reply">リプライ</button>');             
          $('#tweet').append('<button type="button" class="retweet">リツーイト</button>');
          $('#tweet').append('<button type="button" class="good">いいね</button>');

          // $('#centerContents').append('<div class="tweetBottom d-inline">');
          // $('#centerContents').append('<div class="reply d-inline-block"><image src="images/reply.jpg"/></div>');                          
          // $('#centerContents').append('<div class="retweet d-inline-block"><image src="images/retweet.png"/></div>');
          // $('#centerContents').append('<div class="fab d-inline-block"><image src="images/fabo.jpg"/></div></div>');
          
          $('#tweet').append(
            '<div class="tweetBottom d-inline"> '+
                '<div class="reply d-inline-block"> '+
                '<image src="images/reply.jpg"/> '+
                '</div> '+
                '<div class="retweet d-inline-block"> '+
                    '<image src="images/retweet.png"/> '+
                '</div> '+
                '<div class="fab d-inline-block"> '+
                    '<image src="images/fabo.jpg"/> '+
                '</div> '+
            '</div>'
          );                       
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
@isset($userData)
  <div class = "userBar">
      <div class="userData">
          <img class="Images" id="myIcon" src='{{ $userData["userImg"] }}' alt="myIcon" />
          <p id="usenName">ユーザー {{ $userData["userName"] }}</p>
          <p id="userId"><span>@</span>{{ $userData["userID"] }}</p>
      </div>
      @isset ($userData["follow"])
          <button type="button" onclick="location.href='/following'" class="follow">フォロー<span></span>{{ count($userData["follow"]) }} 人</button>
      @else
          <button type="button" onclick="location.href='/following'">フォロー<span class="follow"></span>0人</button>
      @endisset
      
      @isset ($userData["follower"]) 
          <button type="button" onclick="location.href='/followers'" class="follower">フォロワー<span></span>{{ count($userData["follower"]) }} 人</button>
      @else
          <button type="button" onclick="location.href='/followers'">フォロー<span class="follower"></span>0人</button>
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
  <div id="tweet" class="tweet" style=""></div>        
@else
  <b>ユーザーが存在しません。</b>
  <button onclick="location.href='/'">戻る</button>

  <div id="tweet" class="tweet" style="height:600px; width:100%; overflow-y:scroll;"></div> 
         

@endisset
</body>

</html>