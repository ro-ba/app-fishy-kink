<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>検索</title>
<meta charset="utf-8">
<meta name="description" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="">
<link rel="stylesheet" href="css/search.css" >
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


</head>

<body>
    <div class="main">

        <div class="search">
        <button type="button" class="link_button btn page-link text-dark d-inline-block" onclick="location.href='/home'">戻る</button>
            <form method='get' action="/search" class="form-inline d-inline">
                <input type="text" name="searchString" class="form-control" value="">
                <input type="submit" class="form-control" value="検索">
            </form>
        
        </div>

        <div class="content">
            <ul class="search-tab">
                <li class="tab is-active">ツイート</li>
                <li class="tab">ユーザー</li>
                <li class="tab">画像</li>
            </ul>

            <div class="panel-tab">
                <div class="panel is-show">
                    ツイート内容
                        @foreach($result["tweet_result"] as $tweet)
                        <div class="tweet">
                            <div class="userimg">
                                {{ $tweet["userImg"] }}
                            </div>
                            <div class="userID">
                                {{ $tweet["userID"] }}
                            </div>
                            <div class="time">
                                {{ $tweet["time"] }}
                            </div>
                            <div class="text">
                                {{ $tweet["text"] }}
                            </div>
                            @if(count($tweet["img"]) > 0)
                            <?php 
                            $count = count($tweet["img"]);
                            ?>
                                @for($i = 0; $i < $count; $i++)
                                    <div class="img">
                                        {{ $tweet["img"][$i] }}
                                    </div>
                                @endfor
                            @endif
                        </div>
                        @endforeach
                </div>
                <div class="panel">
                    ユーザー
                    @foreach($result["user_result"] as $user)
                        <div class="user">
                            <div class="userimg">
                                {{ $user["userImg"] }}
                            </div>
                            <div class="name">
                                {{ $user["userName"] }}
                            </div>
                            <div class="userID">
                                {{ $user["userID"] }}
                            </div>
                            <div class="profile">
                                {{ $user["profile"] }}
                            </div>
                        </div>
                        @endforeach
                </div>
                <div class="panel">
                    画像
                    @foreach($result["img_result"] as $img)
                        <div class="image">
                            <div class="userimg">
                                {{ $img["userImg"] }}
                            </div>
                            <div class="userID">
                                {{ $img["userID"] }}
                            </div>
                            <div class="time">
                                {{ $img["time"] }}
                            </div>
                            <div class="text">
                                {{ $img["text"] }}
                            </div>
                            <?php 
                            $count = count($tweet["img"]);
                            ?>
                            @for($i = 0; $i < $count; $i++)
                                <div class="img">
                                    {{ $tweet["img"][$i] }}
                                </div>
                            @endfor
                        </div>
                        @endforeach
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script>
  jQuery(function($){
    $('.tab').click(function(){
        $('.is-active').removeClass('is-active');
        $(this).addClass('is-active');
        $('.is-show').removeClass('is-show');
        // クリックしたタブからインデックス番号を取得
        const index = $(this).index();
        // クリックしたタブと同じインデックス番号をもつコンテンツを表示
        $('.panel').eq(index).addClass('is-show');
    });
  });
</script>

<!-- <!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Search</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <input type="text"/>
</body>

</html> -->
