<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>home</title>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="images/FKicon.png">
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="css/tweet.css">
    <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/modal.css">
    <link rel="stylesheet" href="css/tweet.css">
    <link rel="stylesheet" href="font/css/open-iconic-bootstrap.css">
    <link rel="stylesheet" href="css/loader.css">

    <script type="text/javascript">
        let userID = "";
        let session = {
            "userID": "{{ session('userID') }}"
        };
        let defaultIcon = "{{ asset('images/default-icon.jpg') }}";
    </script>
    <!-- ↓body閉じタグ直前でjQueryを読み込む -->
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>

    @include('NaviMenu')

    <div id="alertContents"></div>
    <div class="loader">Loading...</div>
    <div class="row tweets">
        <div class="leftContents col-sm-3"></div>
        <div class="centerContents col-sm-6"></div>
        <div class="rightContents col-sm-3"></div>
    </div>
    @include('modalsForTweet')
</body>

</html>
<script type="text/javascript" src="{{ asset('js/assets/tweet.js') }}"></script>
<script>
    /******************************************************************* ページ読み込んだ瞬間に実行される *******************************************************************/
    $(function() { // 遅延処理
        $.ajax({
            type: 'POST',
            url: '/api/reloadTweets', // url: は読み込むURLを表す
            dataType: 'json', // 読み込むデータの種類を記入
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                userID: userID
            },
            cache: false
        }).done(function(results) {
            // 通信成功時の処理
            dispTweets(results);
        }).fail(function(err) {
            // 通信失敗時の処理
            alert('ファイルの取得に失敗しました。');
        });
    });
</script>
<script type="text/javascript" src="{{ asset('js/assets/navMenu.js') }}"></script>