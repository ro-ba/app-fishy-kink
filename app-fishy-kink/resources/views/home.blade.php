
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>home</title>
<meta charset="utf-8">
<meta name="description" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="">
<link rel="shortcut icon" href="">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div id="menu row d-inline col-md-12"> 
        <button type="button" class="link_button btn page-link text-dark d-inline-block" onclick="location.href='/home'">home</button>
        <button type="button" class="link_button btn page-link text-dark d-inline-block"  onclick="location.href='/notify'">通知</button>
        <button type="button" class="link_button btn page-link text-dark d-inline-block"  onclick="location.href='/DM'">メッセージ</button>
        <button type="button" class="link_button btn page-link text-dark d-inline-block"  onclick="location.href='/story'">ストーリー</button>

        
        <form method='get' action="/serchResult" class="form-inline d-inline" >
            <!-- <div class="form-group"> -->
                <image class="form-control" src=""></image>
                <input class="form-control" type=text name="serchString">
                <input class="form-control " type=submit value="検索">
            <!-- </div> -->
        </form>
        <button type="button" class="link_button btn page-link text-dark d-inline-block" onclick="location.href='/tweet'">ツイート</button>
        <button type="button" class="link_button btn page-link text-dark d-inline-block" onclick="location.href='/logout'">ログアウト</button>
    </div>
    
    <div class="row">
        <div id="leftContents" class="col-sm-3"></div>
        <div id="centerContents" class="col-sm-6">
            <div class="tweet card">
                <div class=tweetTop>
                        <div class="date">5/23</div> 　
                        <div class="time">11:34</div>
                </div>
                <div class=tweetMain>
                    <p>おなかがすいたなー</p>
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
        <div id="rightContents" class="col-sm-3"></div>
</body>
</html>