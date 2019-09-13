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
  $(function(){
    setInterval(update,1000); //10000ミリ秒ごとにupdateという関数を実行する
  });
function update() {
  $.ajax({
    type: 'GET',
    url: '/api/reloadTweet', // url: は読み込むURLを表す
    dataType: 'json', // 読み込むデータの種類を記入
    data: null
  }).done(function (results) {
    // 通信成功時の処理
    $('#main-contents').text();
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
}
});
</script>
</head>
<body>
    <input type="button" id="button" value="更新" />

    <div id="main-contents"><div>
</body>
</html>