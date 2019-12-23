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
<link rel="stylesheet" href="css/search.css" >
<!-- <link rel="stylesheet" href="css/tweet.css"> -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="font/css/open-iconic-bootstrap.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

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

    .readCount{
      z-index: 3;
      position: absolute;
      color: red;/*文字は白に*/
      font-weight: bold; /*太字に*/
      font-size: 0.7em;/*サイズ2倍*/
      font-family :Quicksand, sans-serif;/*Google Font*/
      top: 60%;
      left: 80%;
    }


    /** 駒月が追加 **/
    /* モーダルCSS */
    {
    box-sizing: border-box;
    }
    body {
    font-family:'Avenir','Helvetica, Neue','Helvetica','Arial';
    }


    /* モーダルCSSここから */
    .tweetArea {
    visibility: hidden; /* displayではなくvisibility */
    opacity : 0;
    position: fixed;
    z-index: 10; /* サイトによってここの数値は調整 */
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    transition: .4s;
    }

    .tweetBg {
    width: 100%;
    height: 100%;
    background-color: rgba(30,30,30,0.9);
    }

    .tweetWrapper {
    position: absolute;
    top: 50%;
    left: 50%;
    transform:translate(-50%,-50%);
    width: 70%;
    max-width: 500px;
    padding: 10px 30px;
    background-color: #fff;
    }

    .closeTweet {
    position: absolute;
    top: 0.5rem;
    right: 1rem;
    cursor: pointer;
    }

    .tweet-show { /* モーダル表示用クラス */
    visibility: visible;
    opacity : 1;
    }
    /* モーダルCSSここまで */

    /* モーダルCSSここから */
    .replyArea {
    visibility: hidden; /* displayではなくvisibility */
    opacity : 0;
    position: fixed;
    z-index: 10; /* サイトによってここの数値は調整 */
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    transition: .4s;
    }

    .replyBg {
    width: 100%;
    height: 100%;
    background-color: rgba(30,30,30,0.9);
    }

    .replyWrapper {
    position: absolute;
    top: 50%;
    left: 50%;
    transform:translate(-50%,-50%);
    width: 70%;
    max-width: 500px;
    padding: 10px 30px;
    background-color: #fff;
    }

    .closeReply {
    position: absolute;
    top: 0.5rem;
    right: 1rem;
    cursor: pointer;
    }

    .reply-show { /* モーダル表示用クラス */
    visibility: visible;
    opacity : 1;
    }
    /* モーダルCSSここまで */


    /* 以下ボタンスタイル */
    button {
    padding: 10px;
    background-color: #fff;
    border: 1px solid #282828;
    border-radius: 2px;
    cursor: pointer;
    }
</style>

</head>

<body>
@include('NaviMenu')

<div id="alertContents"></div>
    <div class="main">
        <div class="search">
        <button type="button" class="link_button btn page-link text-dark d-inline-block" onclick="location.href='/home'">戻る</button>
            <form method='get' action="/search" class="form-inline d-inline">
                <input type="text" name="searchString" class="form-control" value="">
                <input type="submit" class="form-control" value="検索">
            </form>
        
        </div>

        <div class="row tweets">
            <div class="leftContents col-sm-3"></div>
            <div class="centerContents col-sm-6">

                <div class="content">
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
            </div>
            <div class="rightContents col-sm-3"></div>
        </div>
    </div>
<!-- りぷらい -->
<div id="replyContents">
  <section id="replyArea" class="replyArea">
    <div id="replyBg" class="replyBg"></div>
    <div class="replyWrapper">
      <div id="parentTweet"></div>
      <!-- <form action="reply" class="reply" method="POST" enctype="multipart/form-data"> -->
      @csrf
        <textarea class="tweetText" cols="50" rows="7" maxlength="200" name="tweetText" placeholder="りぷらい"></textarea>
        <label>
          <span class="filelabel">
            <img src="/images/cicon.png" width="60" height="60" alt="ファイル選択">
          </span>
          <input type="file" id="file" name="tweetImage[]" accept="image/*" onchange="loadImage(this);" multiple/>
        </label>
        <button id="replySend" value="test">送信</button>
        <div class="tweet-image">
          <p class="preview-image"></p>
        </div>
      <!-- </form> -->
      <div id="closeReply" class="closeReply">
        × 
      </div>
    </div>
  </section>
</div>

<!-- ツイート -->
<section id="tweetArea" class="tweetArea">
  <div id="tweetBg" class="tweetBg"></div>
  <div class="tweetWrapper">
  <div class="tweetContents">
  <div id="tweets">
      <div id="wrap">
          <div class="myTweet">
              <img class="myIcon" src="{{ Session::get('userIcon') }}" alt="myIcon" />
              <textarea id="tweetText" class="tweetText" cols="50" rows="7" maxlength="200" name="tweetText" onkeyup="textCheck();" placeholder="いまどうしてる？"></textarea>
          </div>

          <div class="content">
              <label>
                  <span class="filelabel">
                      <img src="/images/imgicon.jpg" width="60" height="60" alt="ファイル選択">
                  </span>
                  <input type="file" id="file" name="tweetImage[]" accept="image/*" onchange="loadImage(this);" multiple/>
              </label>
              <div class="t-submit">
                  <button id = newTweet class="newTweet" disabled=true> tweet </button>
              </div>
          </div>

          <div class="tweet-image">
              <p class="preview-image"></p>
              
          </div>
      </div>
      </div>
    <div id="closeTweet" class="closeTweet">
      ×
    </div>
  </div>
</section>

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

<script type="text/javascript">
  let userID = "";
  let session = { "userID" :"{{ session('userID') }}"};
  let defaultIcon = "{{ asset('images/default-icon.jpg') }}";
</script>
@isset($_GET['user'])
<script>
  let getParam = {"user": "{{ $_GET['user'] }}" } 
</script>
@endisset
<script type="text/javascript" src="{{ asset('js/assets/tweet.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/assets/user.js') }}"></script>
<script>

let tweet_result = @json($results["tweet_result"]);
let user_result = @json($results["user_result"]);
let img_result = @json($results["img_result"]);
dispTweets(tweet_result,"search-result-tweet");
dispUsers(tweet_result,"search-result-user");
dispTweets(img_result,"search-result-img");

</script>
