<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>home</title>
  <meta charset="utf-8">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta name="csrf-token" content="{{ csrf_token() }}">
   <link rel="shortcut icon" href="images/FKicon.png">
  <link rel="stylesheet" href="">
  <link rel="stylesheet" href="css/tweet.css">
  <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="css/home.css">
  <link rel="stylesheet" href="font/css/open-iconic-bootstrap.css">
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

textarea {
  width: 90%;
  resize: none;
}

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


/* モーダルCSSここから */
.quoteReTweetArea {
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

.quoteReTweetBg {
  width: 100%;
  height: 100%;
  background-color: rgba(30,30,30,0.9);
}

.quoteReTweetWrapper {
  position: absolute;
  top: 50%;
  left: 50%;
  transform:translate(-50%,-50%);
  width: 70%;
  max-width: 500px;
  padding: 10px 30px;
  background-color: #fff;
}

.closeQuoteReTweet {
  position: absolute;
  top: 0.5rem;
  right: 1rem;
  cursor: pointer;
}

.quoteReTweet-show { /* モーダル表示用クラス */
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

#replySend {
  margin: 2px 0 0 0;
  padding: 10px 20px;
  transition: .1s;
}

#replySend:hover {
  background-color: #eee;
}

  </style>

<script type="text/javascript">
  let userID = "";
  let session = { "userID" :"{{ session('userID') }}"};
  let defaultIcon = "{{ asset('images/default-icon.jpg') }}";
</script>
<script type="text/javascript" src="{{ asset('js/assets/tweet.js') }}"></script>
<!-- ↓body閉じタグ直前でjQueryを読み込む -->
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    /******************************************************************* 別タブで表示２（仮） *******************************************************************/
    function open2() {
      window.open("/tweet", "hoge", "width=600, height=600 , location=no");
    }
  </script>
</head>
<body>

    @include('NaviMenu')

    <div id="alertContents"></div>
    <div class="loader">Loading...</div>
    <div class="row tweets">
        <div class="leftContents col-sm-3"></div>
        <div class="centerContents col-sm-6"></div>
        <div class="rightContents col-sm-3"></div>
    </div>
</body>
</html>

<!-- ツイート -->
<section id="tweetArea" class="tweetArea">
  <div id="tweetBg" class="tweetBg"></div>
  <div class="tweetWrapper">
    <div class="tweetContents">
    <div id="tweets">
      <form id="tweet-form">
      @csrf
          <div id="wrap">
              <div class="myTweet">
                  <img class="myIcon" src="{{ Session::get('userIcon') }}" alt="myIcon" />
                  <textarea id="tweetText" class="tweetText" cols="50" rows="7" maxlength="200" name="tweetText" onkeyup="tweetCheck();" placeholder="いまどうしてる？"></textarea>
              </div>
              <div class="content">
                    <ul class="tw">
                      <label>
                          <li><img src="/images/imgicon.jpg" width="60" height="60" alt="ファイル選択"></li>
                          <input type="file" id="tweetFile" name="tweetImage[]" accept="image/*" onchange="loadImage(this , 'tweet');" multiple/>

                      </label>
                      <div class="t-submit">
                          <li><button type=button id = newTweet class="newTweet" disabled=true> tweet </button></li>
                      </div>
                    </ul>
              </div>
              <div class="tweet-image">
                <p class="preview-image"></p>
              </div>
          </div>
          </form>
        </div>
    <div id="closeTweet" class="closeTweet">
      ×
    </div>
    <div id="tweetFileAlert"><div> 
  </div>
</section>

<!-- リプライ -->
<div id="replyContents">
  <section id="replyArea" class="replyArea">
    <div id="replyBg" class="replyBg"></div>
    <div class="replyWrapper">
    <form id="reply-form">
      <div id="parentTweet1"></div>
      @csrf
        <div class="myTweet">
          <textarea id="replyText" class="replyText" cols="50" rows="7" maxlength="200" name="replyText" onkeyup="replyCheck();" placeholder="りぷらい"></textarea>
        </div>

        <div class="contentReply">
          <ul class="tw">
            <label>
              <li><img src="/images/imgicon.jpg" width="60" height="60" alt="ファイル選択"></li>
              <input type="file" id="replyFile" name="replyImage[]" accept="image/*" onchange="loadImage(this , 'reply');" multiple/>

            </label>
            <li><button type=button id="replySend" disabled=true>送信</button></li>
          </ul>
        </div>
        <div class="tweet-image">
          <p class="preview-image"></p>
        </div>
    </form>
      <div id="closeReply" class="closeReply">
        × 
      </div>
        <div id="replyFileAlert"></div>
  </div>
  </section>

<!-- 引用リツイート -->
<div id="quoteReTweetContents">
  <section id="quoteReTweetArea" class="quoteReTweetArea">
    <div id="quoteReTweetBg" class="quoteReTweetBg"></div>
    <div class="quoteReTweetWrapper">
    <form id="quoteReTweet-form">
      @csrf
        <div class="myTweet">
          <textarea id="quoteReTweetText" class="quoteReTweetText" cols="50" rows="7" maxlength="200" name="quoteReTweetText" onkeyup="quoteReTweetCheck();" placeholder="🖊コメントつけてリツイート"></textarea>
        </div>
        <div class="contentReply">
          <!-- <ul class="tw"> -->
            <label>
              <li><img src="/images/imgicon.jpg" width="60" height="60" alt="ファイル選択"></li>
              <input type="file" id="quoteReTweetFile" name="quoteReTweetImage[]" accept="image/*" onchange="loadImage(this , 'quoteReTweet');" multiple/>

            </label>
            <div id="parentTweet2"></div>
            <li><button type=button id="quoteReTweetSend" disabled=true>送信</button></li>
          <!-- </ul> -->
        </div>
        <div class="tweet-image">
          <p class="preview-image"></p>
        </div>
    </form>
      <div id="closeQuoteReTweet" class="closeQuoteReTweet">
        × 
      </div>
        <div id="quoteReTweetFileAlert"></div>
  </div>
  </section>

<script>
// /******************************************************************* ページ読み込んだ瞬間に実行される *******************************************************************/
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
<script type="text/javascript" src="{{ asset('js/assets/navMenu.js') }}"></script>




