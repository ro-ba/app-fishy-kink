
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
        <input type="image" class="link_button btn page-link text-dark d-inline-block" onclick="location.href='/myPage'"
        src="{{ $userIcon }}" height="40" width="40" class="img-thumbnail"
        style="width: auto; padding:0; margin:0; background:none; border:0; font-size:0; line-height:0; overflow:visible; cursor:pointer;"
        >
        </button>
        <button type="button" class="btn btn-default"> <font color="red"> <span class="oi oi-magnifying-glass"></span> 検索 </font></button>

        <form method='get' action="/search" class="form-inline d-inline" >
            <!-- <div class="form-group"> -->
                <input class="form-control" type=text name="searchString">
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