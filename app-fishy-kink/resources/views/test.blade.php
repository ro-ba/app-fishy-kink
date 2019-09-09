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
<script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
<script>
$(function(){ // 遅延処理
$('#button').click(
function() {
  $.ajax({
    type: 'GET',
    url: '/reloadTweet', // url: は読み込むURLを表す
    dataType: 'json', // 読み込むデータの種類を記入
    data: null
  }).done(function (results) {
    // 通信成功時の処理
    $('#main-contents').text(results);
  }).fail(function (err) {
    // 通信失敗時の処理
    alert('ファイルの取得に失敗しました。');
  });
}
);
});
</script>
</head>
<body>
    <input type="button" id="button" value="更新" />

    <div id="main-contents"><div>
</body>
</html>