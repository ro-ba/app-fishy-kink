
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
<link rel="stylesheet" href="font/css/open-iconic-bootstrap.css">
</head>
<body>
    <div id="menu row d-inline col-md-12"> 
        <button type="button" class="link_button btn page-link text-dark d-inline-block" onclick="location.href='/home'">home</button>
        <button type="button" class="link_button btn page-link text-dark d-inline-block"  onclick="location.href='/notify'">通知</button>
        <button type="button" class="link_button btn page-link text-dark d-inline-block"  onclick="location.href='/DM'">メッセージ</button>
        <button type="button" class="link_button btn page-link text-dark d-inline-block"  onclick="location.href='/story'">ストーリー</button>
        <button type="button" class="link_button btn page-link text-dark d-inline-block"><img class="form-control" src=""/></button>
        <button type="button" class="btn btn-default"> <font color="red"> <span class="oi oi-magnifying-glass"></span> 検索 </font></button>

        <form method='get' action="/serchResult" class="form-inline d-inline" >
            <!-- <div class="form-group"> -->
                <input class="form-control" type=text name="serchString">
                <input class="form-control" type=submit value="検索">
            <!-- </div> -->
        </form>
        <button type="button" class="link_button btn page-link text-dark d-inline-block" onclick="location.href='/tweet'">ツイート</button>
        <button type="button" class="link_button btn page-link text-dark d-inline-block" onclick="location.href='/logout'">ログアウト</button>
    </div>
    
    <div class="row">
        <div id="leftContents" class="col-sm-3"></div>
        <div id="centerContents" class="col-sm-6">
            <div class="tweet card">
            @foreach ($tweets as $tweet)
                <div class="tweetTop card-header">
                @if ($tweet["type"] == "retweet")
                    <div class="retweet-user">{{ $tweet["userID"] }}さんがリツイートしました</div>

                @endif
                <div class="tweet-user"> {{ $tweet["userID"] }} </div>
                <div class="time"> {{ $tweet["time"] }}</div>
                        <!-- <div class="date">{{ explode(" ",$tweet["time"])[0] }}</div> 　
                        <div class="time">{{ explode(" ",$tweet["time"])[1] }}</div> -->
                </div>
                <div class="tweetMain card-body">
                    {{ $tweet["text"] }}
                    
                </div>
                <p>
                    <?php
                        $img = "data:image/jpeg;base64,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"; 
                    // echo $img;
                    ?>
                    <image src="data:image/jpg;base64,<?php echo $img; ?>">
                    </p>
                <div class="tweetBottom d-inline">
                    <div class="reply d-inline-block">
                        <image src="images/reply.jpg"/>
                    </div>
                    <div class="retweet d-inline-block">
                        <image src="images/retweet.png"/>
                    </div>
                    <div class="fab d-inline-block">
                        <image src="images/fabo.jpg"/>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
        <div id="rightContents" class="col-sm-3"></div>
</body>
</html>