<!DOCTYPE html>
<html>

<!-- <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>tweet</title>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">
    <link rel="shortcut icon" href="">
</head>

<body>
    <form action="./pighuman/tweet.php"  class="tweet" method="POST">
        <div>
            <img class="myIcon" src="<%= icon %>" alt="myIcon" />
            <textarea class="tweetText" cols="50" rows="7" maxlength="200" value="いまどうしてる？"></textarea>
            <div>
                <img src="<%= image%>" alt="ツイート画像" />
                <a href="./newTweetImage.html"><img src="./plusImage.jpg" alt="画像追加" /></a>
                <input class="newTweet" method="POST" type="submit" value="ツイート" />
            </div>
    </form>
</body>

</html> -->

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>tweet</title>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">
    <link rel="shortcut icon" href="">
</head>

<script>
    // 文字制限 試しに遷移する
    function getValue(txt){
        // テキストエリアの入力値が10文字以内なら遷移する
       if(document.getElementById(txt).value.length < 10) { 
            var form = document.forms['tweet'];
            form.method = 'POST';
            form.action = 'test.php';
            form.submit();
            return true;
        }
    }
</script>

<script>
    //　画像を選択して表示する
    function OnFileSelect(inputElement){
	// フォームで選択された全ファイルを取得
	var fileList = inputElement.files;
    
		// FileReaderオブジェクトを作成
		var fileReader = new FileReader() ;

		// 読み込み後の処理を決めておく
		fileReader.onload = function() {
			// Data URIを取得
			var dataUri = this.result ;

			// HTMLに書き出し (src属性にData URIを指定)
			document.body.innerHTML += '<a href="' + dataUri + '" preview="_blank"><img src="' + dataUri + '"></a>' ;
		
        }
		// ファイルをData URIとして読み込む
		fileReader.readAsDataURL( fileList[0] ) ;
    }
	
</script>

<body>
    <form name = "tweet">
        <div>
            <textarea id = "area" name = "body" cols="50" rows="7" maxlength="200" ></textarea>
            <div>
                <input type="file" id="preview" onchange="OnFileSelect(this);" simple>
                <input type="button" value="ツイート" onclick="getValue('area');"/>
            </div>
    </form>
</body>

</html>