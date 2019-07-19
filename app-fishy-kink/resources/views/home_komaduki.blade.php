
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>home</title>
<meta charset="utf-8">
<meta name="description" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- <link rel="stylesheet" type="text" href="style.css"> -->
<link rel="shortcut icon" href="">
</head>
<body>
    <div id="menu"> 
        <div class="link_button">
            <button type="button"onclick="location.href='./home.html'">home</button>
        </div>
        <div class="link_button">
            <button type="button"onclick="location.href='./notify.html'">通知</button>
        </div>
        <div class="link_button">
            <button type="button"onclick="location.href='./dMessage.html'">メッセージ</button>
        </div>
        <div class="link_button">
            <button type="button"onclick="location.href='./story.html'">ストーリー</button>
        </div>
        <div id="link_icon"></div>
        <form method='get' action="/serchResult.html" >
            <image src=""></image>
            <input type=text name="serchString">
            <input type=submit value="検索">
        </form>
        <div class="link_button">
            <button type="button"onclick="location.href='./tweet.html'">ツイート</button>
        </div>
        <div class="link_button">
            <button type="button"onclick="location.href='./logout'">ログアウト</button>
        </div>
    </div>
    <div id="mainContents">
        <div id="leftContents"></div>
        <div id="centerContents">
            <div class="tweet">
                <div class=tweetTop>
                        <div class="date"></div> 　
                            
                        <div class="time"></div>
                            
                </div>
                <div class=tweetMain>
                    <p>
                    </p>
                </div>
                <div class="tweetBottom">
                    <div class="reply">
                        <image src=""></image>
                    </div>
                    <div class="retweet">
                        <image src=""></image>
                    </div>
                    <div class="fab">
                        <image src=""></image>
                    </div>
                </div>
            </div>
        </div>
        <div id="rightContents"></div>
    </div>
</body>
</html>