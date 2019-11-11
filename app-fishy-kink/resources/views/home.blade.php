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
  <link rel="shortcut icon" href="">
  <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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

    /* モーダルCSS */
{
  box-sizing: border-box;
}
body {
  font-family:'Avenir','Helvetica, Neue','Helvetica','Arial';
}


/* モーダルCSSここから */
.modalArea {
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

.modalBg {
  width: 100%;
  height: 100%;
  background-color: rgba(30,30,30,0.9);
}

.modalWrapper {
  position: absolute;
  top: 50%;
  left: 50%;
  transform:translate(-50%,-50%);
  width: 70%;
  max-width: 500px;
  padding: 10px 30px;
  background-color: #fff;
}

.closeModal {
  position: absolute;
  top: 0.5rem;
  right: 1rem;
  cursor: pointer;
}

.is-show { /* モーダル表示用クラス */
  visibility: visible;
  opacity : 1;
}
/* モーダルCSSここまで */

/* モーダルCSSここから */
.modalArea1 {
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

.modalBg1 {
  width: 100%;
  height: 100%;
  background-color: rgba(30,30,30,0.9);
}

.modalWrapper1 {
  position: absolute;
  top: 50%;
  left: 50%;
  transform:translate(-50%,-50%);
  width: 70%;
  max-width: 500px;
  padding: 10px 30px;
  background-color: #fff;
}

.closeModal1 {
  position: absolute;
  top: 0.5rem;
  right: 1rem;
  cursor: pointer;
}

.is-show1 { /* モーダル表示用クラス */
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

/* #openModal {
  position: absolute;
  top: 50%;
  left: 50%;
  transform:translate(-50%,-50%);
} */
  </style>

<script type="text/javascript">
  let userID = "";
</script>
<script type="text/javascript" src="{{ asset('js/assets/tweet.js') }}"></script>
<!-- ↓body閉じタグ直前でjQueryを読み込む -->
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>

    /******************************************************************* ツイートのサブウィンドウ表示 *******************************************************************/
    function openTweet() {
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


<button id="openModal">Open modal</button>


  <div id="menu row d-inline col-md-12">

    <button type="button" class="link_button btn page-link text-dark d-inline-block" onclick="location.href='/home'">home</button>
    <button type="button" class="link_button btn page-link text-dark d-inline-block" onclick="location.href='/notify'">通知</button>
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
    <button type="button" id="qqqq" class="link_button btn page-link text-dark d-inline-block">ツイート</button>
        <button type=" button" class="link_button btn page-link text-dark d-inline-block" onclick="location.href='/logout'">ログアウト</button>
  </div>
  <div id="alertContents"></div>
  <div class="loader">Loading...</div>
  <div class="row tweets">
    <div id="leftContents" class="col-sm-3"></div>
    <div id="centerContents" class="col-sm-6"></div>
    <div id="rightContents" class="col-sm-3"></div>
  </div>
</body>
</html>

<!-- モーダルエリアここから -->
<section id="modalArea" class="modalArea">
  <div id="modalBg" class="modalBg"></div>
  <div class="modalWrapper">
    <div class="modalContents">
    <div id="tweets">
    <form action="tweet"  class="tweet" method="POST" enctype="multipart/form-data">
    @csrf
        <div id="wrap">
            <div class="myTweet">
                <img class="myIcon" src="<%= icon %>" alt="myIcon" />
                <textarea class="tweetText" cols="50" rows="7" maxlength="200" name="tweetText" placeholder="いまどうしてる？"></textarea>
            </div>

            <div class="content">
                <label>
                    <span class="filelabel">
                        <img src="/images/cicon.png" width="60" height="60" alt="ファイル選択">
                    </span>
                    <input type="file" id="file" name="tweetImage[]" accept="image/*" onchange="loadImage(this);" multiple/>
                </label>
                <div class="t-submit">
                    <input class="newTweet" method="POST" type="submit" value="tweet" />   
                </div>
            </div>

            <div class="tweet-image">
                                <p id="preview"></p>
            </div>
        </div>
        </div>

    </form>
    <div id="closeModal" class="closeModal">
      ×
    </div>
  </div>
</section>
<!-- モーダルエリアここまで -->


<section id="modalArea1" class="modalArea1">
  <div id="modalBg1" class="modalBg1"></div>
  <div class="modalWrapper1">
    <div class="modalContents1">
    <textarea class="tweetText" cols="50" rows="7" maxlength="200" name="tweetText" placeholder="りぷらい"></textarea>
    <div id="closeModal1" class="closeModal1">
      ×
    </div>
  </div>
</section>



<script>
$(function () {
      const modalArea = document.getElementById('modalArea');
      const openModal = document.getElementById('qqqq');
      const closeModal = document.getElementById('closeModal');
      const modalBg = document.getElementById('modalBg');
      const toggle = [openModal,closeModal,modalBg];
  
      for(let i=0, len=toggle.length ; i<len ; i++){
        toggle[i].addEventListener('click',function(){
        modalArea.classList.toggle('is-show');
        },false);
      }
    }());
</script>

<script>
$(function () {
  const modalArea = document.getElementById('modalArea1');
  const openModal = document.getElementById('openModal');
  const closeModal = document.getElementById('closeModal1');
  const modalBg = document.getElementById('modalBg1');
  const toggle = [openModal,closeModal,modalBg];
  
  for(let i=0, len=toggle.length ; i<len ; i++){
    toggle[i].addEventListener('click',function(){
      modalArea.classList.toggle('is-show1');
    },false);
  }
}());
</script>