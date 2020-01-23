
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>ダイレクトメッセージ</title>
<meta charset="utf-8">
<meta name="description" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="">
<link rel="shortcut icon" href="images/FKicon.png">
<link rel="shortcut icon" href="">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<style>
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

</head>
<body>
@include('NaviMenu')
    <form>
        <div>ダイレクトメッセージ</div>
        <div>現在トークはありません</div>
        <div>トークしようぜ！！</div>
        <div align="right"><a href="#.html">⊕追加ボタン</a></div>
        <!-- 　↑ のちにCSSで直す -->
    </form>        

    <button id="openModal">Open modal</button>

<!-- モーダルエリアここから -->
<section id="modalArea" class="modalArea">
  <div id="modalBg" class="modalBg"></div>
  <div class="modalWrapper">
    <div class="modalContents">
      <h1>Here are modal without jQuery!</h1>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
    </div>
    <div id="closeModal" class="closeModal">
      ×
    </div>
  </div>
</section>
<!-- モーダルエリアここまで -->

<!-- ↓body閉じタグ直前でjQueryを読み込む -->

</body>
</html>

<script>
    (function () {
  const modalArea = document.getElementById('modalArea');
  const openModal = document.getElementById('openModal');
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