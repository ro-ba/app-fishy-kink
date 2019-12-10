<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>検索</title>
<meta charset="utf-8">
<meta name="description" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="shortcut icon" href="">
<link rel="stylesheet" href="css/search.css" >
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script type="text/javascript">
  let userID = "";
  let session = { "userID" :"{{ session('userID') }}"};
  let defaultIcon = "{{ asset('images/default-icon.jpg') }}";
</script>
<script type="text/javascript" src="{{ asset('js/assets/tweet.js') }}"></script>
<script>

let tweet_result = @json($results["tweet_result"]);
console.log(tweet_result);
dispTweets(tweet_result,"search-result-tweet");

</script>
</head>

<body>
<div id="alertContents"></div>
    <div class="main">

        <div class="search">
        <button type="button" class="link_button btn page-link text-dark d-inline-block" onclick="location.href='/home'">戻る</button>
            <form method='get' action="/search" class="form-inline d-inline">
                <input type="text" name="searchString" class="form-control" value="">
                <input type="submit" class="form-control" value="検索">
            </form>
        
        </div>

        <div class="row tweets">
            <div class="leftContents col-sm-3"></div>
            <div class="centerContents col-sm-6">

                <div class="content">
                    <ul class="search-tab">
                        <li class="tab is-active">ツイート</li>
                        <li class="tab">ユーザー</li>
                        <li class="tab">画像</li>
                    </ul>

                    <div class="panel-tab">
                        <div class="panel search-result-tweet is-show "></div>
                        <div class="panel search-result-user"></div>
                        <div class="panel search-result-img"></div>
                    </div>
                </div>
            </div>
            <div class="rightContents col-sm-3"></div>
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
