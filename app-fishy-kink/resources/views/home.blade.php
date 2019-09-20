
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>home</title>
<meta charset="utf-8">
<meta name="description" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="">
<link rel="shortcut icon" href="">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="font/css/open-iconic-bootstrap.css">

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
        $('#centerContents').empty();
        results.forEach(function(tweet){
          // console.log(tweet);
          $('#centerContents').append('<div class="tweet card">');      
          
          if (tweet["type"] == "tweet") {
            $('#centerContents').append('<div class="tweetTop card-header">'+'<div class="tweet-user ">' + tweet["userID"] + '</div>' + '<div class="time">'+ tweet["time"] + '</div></div>'); 
          } 
          // リツイート         
          else if (tweet["type"] == "retweet"){
            $('#centerContents').append('<div class="tweetTop card-header">'+'<div class="tweet-user ">' + '<div class="retweet-user">'+ tweet["userID"] + 'さんがリツイートしました</div>' + tweet["userID"] + '</div>' + '<div class="time">'+ tweet["time"] + '</div></div>'); 
          }
          $('#centerContents').append('<div class="tweetMain card-body">'+ tweet["text"] + '</div>');

          @isset($tweet["img"][0])
            @foreach($tweet["img"] as $img)
                <img src=" {{ $img }}" />
            @endforeach
            @endisset
          $('#centerContents').append('<div class="tweetBottom d-inline">');
          $('#centerContents').append('<div class="reply d-inline-block"><image src="images/reply.jpg"/></div>');                          
          $('#centerContents').append('<div class="retweet d-inline-block"><image src="images/retweet.png"/></div>');
          $('#centerContents').append('<div class="fab d-inline-block"><image src="images/fabo.jpg"/></div></div>');
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
=======
</head>
<body>
    <div id="menu row d-inline col-md-12"> 
        <button type="button" class="link_button btn page-link text-dark d-inline-block" onclick="location.href='/home'">home</button>
        <button type="button" class="link_button btn page-link text-dark d-inline-block"  onclick="location.href='/notify'">通知</button>
        <button type="button" class="link_button btn page-link text-dark d-inline-block"  onclick="location.href='/DM'">メッセージ</button>
        <button type="button" class="link_button btn page-link text-dark d-inline-block"  onclick="location.href='/story'">ストーリー</button>
        <input type="image" class="link_button btn page-link text-dark d-inline-block" onclick="location.href='/profile'"
        src="{{ $userIcon }}" height="40" width="40" class="img-thumbnail"
        style="width: auto; padding:0; margin:0; background:none; border:0; font-size:0; line-height:0; overflow:visible; cursor:pointer;"
        >
        </button>
        <button type="button" class="btn btn-default"> <font color="red"> <span class="oi oi-magnifying-glass"></span> 検索 </font></button>

        <form method='get' action="/search" class="form-inline d-inline" >
            <!-- <div class="form-group"> -->
                <input class="form-control" type=text name="searchString">
                <input class="form-control" type=submit value="検索">
            <!-- </div> -->
        </form>
        <button type="button" class="link_button btn page-link text-dark d-inline-block" target=”_blank” onclick='open1()' onclick="location.href='/tweet'">ツイート</button>
        
        <script type="text/javascript">
            function open1() {
            window.open("/tweet", "hoge", 'width=600, height=600');
        }
        </script>
        
        <button type="button" class="link_button btn page-link text-dark d-inline-block" onclick="location.href='/logout'">ログアウト</button>
    </div>
    
    <div class="row">
        <div id="leftContents" class="col-sm-3"></div>
        <div id="centerContents" class="col-sm-6"></div>
        <div id="rightContents" class="col-sm-3"></div>
</body>
</html>