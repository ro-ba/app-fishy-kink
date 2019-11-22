<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Settings</title>
<meta charset="utf-8">
<meta name="description" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="font/css/open-iconic-bootstrap.css">
<link rel="stylesheet" href="css/notify.css">
<script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>


</head>
<body>
        <!-- <div class="tabs">
        <input id="all" type="radio" name="tab_item" checked>
        <label class="tab_item" for="all">すべて</label> -->

        <!-- <input id="@tweet" type="radio" name="tab_item" checked>
        <label class="tab_item" for="@tweet">＠ツイート</label> -->
      
    <!-- すべてタブ表示 -->
    @isset($userData)
        <div class = myData>
            <img class="Images" id="myIcon" src='{{ $userData["userImg"] }}' alt="myIcon" height="40" width="40" class="img-thumbnail" style="width: auto; padding:0; margin:0; background:none; border:0; font-size:0; line-height:0; overflow:visible; cursor:pointer;" />
            <a>通知</a>
        </div>
        <div class="tab_content" id="all_content">
            @isset($notifyList)
            <ul class ="list_none">
                @foreach( $notifyList as $notifys )
                    <div class = "notifyItem">
                        <a>{{ $notifys["text"] }}</a>
                        <a>{{ $notifys["time"] }}</a>
                    </div>
                @endforeach
            </ul>
            @else
                <li>通知がありません</li>
            @endisset          
        </div>

        <!-- ＠ツイート表示 -->
        <!-- <div class="tab_content" id="@tweet_content">
        
        </div>

        <div>
            <button  class="btn-square" type="button" onclick="location.href='/profile'">戻る</button>
        </div>   -->
    @else
        <a>エラー</a>
    @endisset
</body>
</html>