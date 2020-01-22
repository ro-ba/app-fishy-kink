<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>welcome</title>
  <meta charset="utf-8">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta name="csrf-token" content="{{ csrf_token() }}">
   <link rel="shortcut icon" href="images/FKicon.png">
  <link rel="stylesheet" href="">
  <link rel="stylesheet" href="css/welcome.css">
  <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="font/css/open-iconic-bootstrap.css">
  <script type="text/javascript">
  let userID = "";
  let session = { "userID" :"{{ session('userID') }}"};
  let defaultIcon = "{{ asset('images/default-icon.jpg') }}";
</script>
<!-- ↓body閉じタグ直前でjQueryを読み込む -->
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
    <div class="welcome-message col-md-12">
        <div class="a display-2 text-center">さぁ　はじめよう</div>
    </div>
    <button class="all-follow-button">すべてのユーザーをフォローする</button>
    <div class="centerContents">
        <div class="recommend-user-list"></div>
    </div>

    <a class="next-page btn-default" tyep="button" href="/">
        FishyKinkを始める
        <span class="oi oi-chevron-right"></span>
        <span class="oi oi-chevron-right"></span>
    </a>
</body>
<script>
    $(function(){
        $(".welcome-message").fadeIn(3000);
        $(".all-follow-button").fadeIn(5000);
        $(".next-page").fadeIn(5000);
    });
</script>
<script type="text/javascript" src="{{ asset('js/assets/user.js') }}">
</script>
<script>
    // let recommend_users = @json($recommend_users);   
    dispUsers( @json($recommend_users) ,"recommend-user-list");
</script>

</html>