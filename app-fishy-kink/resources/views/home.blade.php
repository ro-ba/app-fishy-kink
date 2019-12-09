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
  <link rel="stylesheet" href="">

  <link rel="stylesheet" href="css/tweet.css">

  <link rel="shortcut icon" href="images/FKicon.png">
  <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="css/home.css">
  <link rel="stylesheet" href="font/css/open-iconic-bootstrap.css">
  <link rel="stylesheet" href="css/loader.css">
  <link rel="stylesheet" href="css/home.css">

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

<script type="text/javascript">
  let userID = "";
  let session = { "userID" :"{{ session('userID') }}"};
  let defaultIcon = "{{ asset('images/default-icon.jpg') }}";
</script>
<script type="text/javascript" src="{{ asset('js/assets/tweet.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/assets/notifyCount.js') }}"></script>
<!-- ↓body閉じタグ直前でjQueryを読み込む -->
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    /******************************************************************* 別タブで表示 *******************************************************************/
    function open1() {
      var w = (screen.width - 600) / 2;
      var h = (screen.height - 600) / 2;
      window.open("/tweet", "hoge", "width=600, height=500" + ",left=" + w + ",top=" + h + ",directions=0 , location=0  , menubar=0 , scrollbars=0 , status=0 , toolbar=0 , resizable=0");      
    }
    /******************************************************************* 別タブで表示２（仮） *******************************************************************/
    function open2() {
      window.open("/tweet", "hoge", "width=600, height=600 , location=no");
    }
  </script>
</head>

<body>


  <div id="menu row d-inline col-md-12">

    <button type="button" class="link_button btn page-link text-dark d-inline-block" onclick="location.href='/home'">home</button>
    <button type="button" class="link_button btn page-link text-dark d-inline-block" onclick="location.href='/notify'">通知
    @if($count != 0)
      <p class = "readCount"  data-badge="{{ $count }}"></p></button>
    @endif
    <button type="button" class="link_button btn page-link text-dark d-inline-block" onclick="location.href='/DM'">メッセージ</button>
    <button type="button" class="link_button btn page-link text-dark d-inline-block" onclick="location.href='/story'">ストーリー</button>
    <input type="image" class="link_button btn page-link text-dark d-inline-block" onclick="location.href='/profile'" src="{{ $userIcon }}" height="40" width="40" class="img-thumbnail" style="width: auto; padding:0; margin:0; background:none; border:0; font-size:0; line-height:0; overflow:visible; cursor:pointer;">
    </button>

    <form method='get' action="/search" class="form-inline d-inline">
      <!-- <div class="form-group"> -->
      <input class="form-control" type=text name="searchString">
      <button class="form-control" type=input> <span class="oi oi-magnifying-glass"></span> 検索 </button>
      <!-- </div> -->
    </form>
    <button type="button" id="tweet" class="link_button btn page-link text-dark d-inline-block">ツイート</button>
        <button type=" button" class="link_button btn page-link text-dark d-inline-block" onclick="location.href='/logout'">ログアウト</button>
  </div>
  <div id="alertContents"></div>

  <div class="loader">Loading...</div>
  <div class="row tweets">
    <!-- <div id="leftContents" class="col-sm-3"></div>
    <div id="centerContents" class="col-sm-6"></div>
    <div id="rightContents" class="col-sm-3"></div> -->
    <div class="leftContents col-sm-3"></div>
    <div class="centerContents col-sm-6"></div>
    <div class="rightContents col-sm-3"></div>
  </div>
  
</body>
</html>

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
            <img src="/images/imgicon.jpg" width="60" height="60" alt="ファイル選択">
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
    <form action="tweet"  class="tweet" method="POST" enctype="multipart/form-data">
    @csrf
        <div id="wrap">
            <div class="myTweet">
                <img class="myIcon" src="{{ $userIcon }}" alt="myIcon" />
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

    </form>
    <div id="closeTweet" class="closeTweet">
      ×
    </div>
  </div>
</section>

<script>
(function () {
    setTimeout(function () {
        const modalArea = document.getElementById('tweetArea');
        const openModal = document.getElementById('tweet');
        const closeModal = document.getElementById('closeTweet');
        const modalBg = document.getElementById('tweetBg');
        const sendButton = document.getElementById('newTweet');
        const toggle = [openModal,closeModal,modalBg , sendButton];

        for(let i=0, len=toggle.length ; i<len ; i++){
          toggle[i].addEventListener('click',function(){    // イベント処理(クリック時)
            //tweetのpreview-imageを初期化
            $(".preview-image").html('<p class="pre">PREVIEW</p>');
            modalArea.classList.toggle('tweet-show');            // modalAreaのクラスの値を切り替える 
          },false);
        }
    }, 1);
  }());
</script>




