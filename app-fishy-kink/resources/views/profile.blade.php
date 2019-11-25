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
<!-- <link rel="stylesheet" type="text/css" href="css/profile.css"> -->
<link rel="stylesheet" type="text/css" href="css/profile.css">
<link href="https://fonts.googleapis.com/earlyaccess/kokoro.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/earlyaccess/kokoro.css" rel="stylesheet">
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

/** ここまで **/
</style>
<script src="https://code.jquery.com/jquery-3.0.0.min.js"></script> 

<script type="text/javascript">
  let userID = "{{ $userData['userID'] }}";
  let session = { "userID" :"{{ session('userID') }}"};
</script>
<script type="text/javascript" src="{{ asset('js/assets/tweet.js') }}"></script>
</head>

<body>

<!-- りぷらい -->
<div id="modalContents"></div>
  <section id="modalArea1" class="modalArea1">
    <div id="modalBg1" class="modalBg1"></div>
    <div class="modalWrapper1">
      <div class="modalContents1">
        <div id="parentTweet"></div>
        <textarea class="tweetText" cols="50" rows="7" maxlength="200" name="tweetText" placeholder="りぷらい"></textarea>
        <button id="replySend">送信</button>
        <div id="closeModal1" class="closeModal1">
          × 
        </div>
    </div>
  </section>
<div>


@isset($userData)

    <div class="profile">
      <div id=wrap>


        <div class="image">
          <img class="myicon" id="myIcon" src='{{ $userData["userImg"] }}' alt="myIcon" />
        </div>

        <ul class="user">
              <li class="user-name">{{ $userData["userName"] }}</li>
            @if($isShowSettings)
              <li class="user-edit"><input class="setButton" type="button" onclick="location.href='/settings'" value="プロフィール変更" /></li>
            @endif
        </ul>

        <div class="user-id"><span>@</span>{{ $userData["userID"] }}</div>
             
        <ul class="follows">
            @isset ($userData["follow"])
                <li class="follow"><button type="button" onclick="location.href='/following?user={{$userData['userID'] }} '">フォロー中　<span></span>{{ count($userData["follow"]) }} 人</button></li>
            @else
                <li class="follow"><button type="button" onclick="location.href='/following?user={{$userData['userID'] }}'">フォロー<span></span>0人</button></li>
            @endisset
            
            @isset ($userData["follower"]) 
                <li class="follower"><button type="button" onclick="location.href='/followers?user={{$userData['userID'] }}'">フォロワー <span></span>{{ count($userData["follower"]) }} 人</button></li>
            @else
                <li class="follow"><button type="button" onclick="location.href='/followers?user={{$userData['userID'] }}'">フォロー<span></span>0人</button></li>
                <li class="follower">フォロワー<span></span>0人</li>
            @endisset

            <li><button class="btn-real-dent" onclick="location.href='/'">戻る</button></li>
        <ul>

      </div>

    <div class="my-profile"> 
      <p class="pro-content">{{ $userData["profile"] }}</p>    
    </div>

    <hr />

    <div class="loader"></div>

    <div class="row tweets">
      <div id="leftContents" class="col-sm-3"></div>
      <div id="centerContents" class="col-sm-6"></div>
      <div id="rightContents" class="col-sm-3"></div>
    </div>       
  @else
    <b>ユーザーが存在しません。</b>
    <button onclick="location.href='/'">戻る</button>
  @endisset
  </div>               
</body>

</body>
</html>