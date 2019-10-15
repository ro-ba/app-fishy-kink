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
<script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="font/css/open-iconic-bootstrap.css">

<style>
.accordion .inner {display: none;}
.accordion p {cursor: pointer;}
.accordion {display:inline;}
</style>

<script>
$(function(){
  $("#centerContents").on('click',".fab",function() {
    // var tweetid = $("#centerContents > #tweetID").val();
    var tweetid = $(this).prevAll("#tweetID").val();
    var push_button = this;
    $.ajax({
      type: 'POST',
      url: '/api/fabChange',
      dataType: 'json',
      data: {
        userID: "{{ session('userID') }}", 
        tweetID: tweetid, 
        _token:'{{ csrf_token() }}'
      },
      cache: false
    }).done(function(results){
      if (results["message"] == "add"){
        $(push_button).children().css("color","red");
      }else{
        $(push_button).children().css("color","gray");
      }
    });
  });
});


</script>

<script>

var imageArr = 
 [
  'images/fabo.jpg',
  'images/faboDis.jpg'
 ];
 var now_image = 0;



// function fab(userid,tweetid){
//   console.log(tweetID);
//   $.ajax({
//       type: 'POST',
//       url: '/api/fabChange',    // url: は読み込むURLを表す
//       dataType: 'json',           // 読み込むデータの種類を記入
//       data: { 
//         userID:userid , 
//         tweetID:tweetid , 
//         _token:'{{ csrf_token() }}'},
//       cache: false
//       }).done(function (results) {
//         alert('成功しました。');
//       }).fail(function (err) {
//         // 通信失敗時の処理
//       });
// };


$(function(){ // 遅延処理
  setInterval((function update(){ //1000ミリ秒ごとにupdateという関数を実行する
    $.ajax({
      type: 'POST',
      url: '/api/reloadTweet',    // url: は読み込むURLを表す
      dataType: 'json',           // 読み込むデータの種類を記入
      data: {userID:'',
            _token: '{{ csrf_token() }}'
            },
      cache: false
      }).done(function (results) {
        // 通信成功時の処理
        $('#centerContents').empty();
        let tweetType = "";
        results.forEach(function(tweet){
          // console.log(tweet);
          $('#centerContents').append('<div class="tweet card">');    
          $('#centerContents').append("<input id=tweetID type='hidden' value="+ tweet["_id"]['$oid'] +" />");
          // リツイート 
          if (tweet["type"] == "retweet") {
            tweetType = '<div class="retweet-user">'+ tweet["userID"] + 'さんがリツイートしました</div>';
          } 
                  
          else {
            tweetType = ""
          }
            $('#centerContents').append(
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
                '</div>');
          $('#centerContents').append('<div class="tweetMain card-body">'+ tweet["text"] + '</div>');

          // 画像表示
          $('#centerContents').append('<div style=float:left>');
          for(var i=0;i<tweet["img"].length;i++){
            $('#centerContents').append('<img src="' + tweet["img"][i] + '"width="200" height="150" />');
          }
          $('#centerContents').append('</div><p>');

          $('#centerContents').append('<div class="tweetBottom d-inline">');

          $('#centerContents').append('<button type="button" class="reply">リプライ</button>'); 

          $('#centerContents').append('<div class="accordion">' +
                                          '<button type="button" class="reTweet">リツイート</button>' +
                                          '<div class="inner">' +
                                            '<a href= "target=”_blank” onclick= func onclick="location.href="view">リツイート</a><p>' +
                                            '<a href=javascript:open2()>🖊コメントつけてリツイート</a>' +
                                          '</div>' +
                                      '</div>');
                                      
          $('#centerContents').append('<button type="button" class="good">いいね</button>');

          // $('#centerContents').append('<div class="tweetBottom d-inline">');
          // $('#centerContents').append('<div class="reply d-inline-block"><image src="images/reply.jpg"/></div>');                          
          // $('#centerContents').append('<div class="retweet d-inline-block"><image src="images/retweet.png"/></div>');
          // $('#centerContents').append('<div class="fab d-inline-block"><image src="images/fabo.jpg"/></div></div>');
          
          $('#centerContents').append(
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
          
          // var tweet_json = JSON.stringify(tweet["_id"])
          
          // $('#centerContents').append('<button class=fab type=button class=good ><span class="oi oi-heart" style=""></span> </button></div>');

          if (tweet["fabUser"].indexOf("{{ session('userID') }}") == -1){
            $('#centerContents').append('<button class=fab type=button class=good ><span class="oi oi-heart" style="color:gray;"></span> </button></div>');
          }else{
            $('#centerContents').append('<button class=fab type=button class=good ><span class="oi oi-heart" style="color:red;"></span> </button></div>');
          }
          
          
      });
      // $('#main-contents').text(results);
      }).fail(function (err) {
        // 通信失敗時の処理
        alert('ファイルの取得に失敗しました。');
      });
      return update;
    }()),100000);
});

</script>

<script>
$(document).on("click", ".reTweet", function () {
  
  //クリックされた.accordion2の中のp要素に隣接する.accordion2の中の.innerを開いたり閉じたりする。
  $(this).next('.accordion .inner').slideToggle();

  //クリックされた.accordion2の中のp要素以外の.accordion2の中のp要素に隣接する.accordion2の中の.innerを閉じる
  $('.accordion').not($(this)).next('.accordion .inner').slideUp();

});
</script>

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
        <button type="button" class="link_button btn page-link text-dark d-inline-block" target=”_blank” onclick='open1();'">ツイート</button>
        


        
        
        <button type="button" class="link_button btn page-link text-dark d-inline-block" onclick="location.href='/logout'">ログアウト</button>
    </div>
    
    <div class="row">
        <div id="leftContents" class="col-sm-3"></div>

        <div id="centerContents" class="col-sm-6">
            <div class="tweet card">
            @foreach ($tweets as $tweet)
                <div class="tweetTop card-header">
                @if ($tweet["type"] == "retweet")
                    <div class="retweet-user">{{ $tweet["userID"] }}さんがリツイートしました</div>

                @endif
                <a name=user href="/profile?user={{ $tweet['userID'] }}" >{{ $tweet['userID'] }}</a>
                <div class="time"> {{ $tweet["time"] }}</div>
                        <!-- <div class="date">{{ explode(" ",$tweet["time"])[0] }}</div> 　
                        <div class="time">{{ explode(" ",$tweet["time"])[1] }}</div> -->
                </div>
                <div class="tweetMain card-body">
                    {{ $tweet["text"] }}                    
                </div>
                  
                <div style = float: left>
                @isset($tweet["img"][0])
                    @foreach($tweet["img"] as $img)
                     <img src=" {{ $img }}" width="200" height="150"/>
                    @endforeach
                @endisset
                </div>
                <div class="tweetBottom d-inline">
                    <div class="reply d-inline-block">
                      <input name="reply" type="image" src="images/reply.jpg" onclick="reply()" alt="リプライ">
                    </div>
                    <div class="retweet d-inline-block">
                      <input name="retweet" type="image" src="images/retweet.png" onclick="retweet()" alt="リツイート"/>
                    </div>
                    <div class="fab d-inline-block">
                      <input  class="fab" name="fab" type="image" src="images/faboDis.jpg" alt="いいね"/>
                    </div>
                </div>
            @endforeach

            
            </div>
        </div>


        <div id="rightContents" class="col-sm-3"></div>

</body>
<img class="" height="100" width="100" 
        src="images/twitter.jpg"
        />
</html>

<script type="text/javascript">
  function open1() {
    window.open("/tweet", "hoge", "width=600, height=600 , location=no");
  }
</script>

<script type="text/javascript">
  function open2() {
    window.open("/tweet", "hoge", "width=600, height=600 , location=no");
  }
</script>


