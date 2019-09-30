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
            <form action="" class="form-inline d-inline">
                <input type="text" class="form-control" value="">
                <input type="submit" class="form-control" value="検索">
            </form>
        </div>

        <div class="content">
            <ul class="search-tab">
                <li class="tab is-active">ツイート</li>
                <li class="tab">ユーザー</li>
                <li class="tab">画像</li>
                <li class="tab">イニエスタ</li>
                <li class="tab">ブッフォン</li>
            </ul>

            <div class="panel-tab">
                <div class="panel is-show">
                    ツイート内容
                </div>
                <div class="panel">
                    ユーザー
                </div>
                <div class="panel">
                    画像
                </div>
                <div class="panel">
                    イニエスタ
                </div>
                <div class="panel">
                    ブッフォン
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
