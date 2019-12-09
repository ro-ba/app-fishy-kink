<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>myPage</title>
<meta charset="utf-8">
<meta name="description" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="shortcut icon" href="">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="font/css/open-iconic-bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/profile.css">
<link href="https://fonts.googleapis.com/earlyaccess/kokoro.css" rel="stylesheet">
<link rel="stylesheet" href="css/loader.css">
  <link rel="stylesheet" href="css/loader.css">

<script type="text/javascript">
  let userID = "";
  let session = { "userID" :"{{ session('userID') }}"};
  let defaultIcon = "{{ asset('images/default-icon.jpg') }}";
</script>

<script type="text/javascript" src="{{ asset('js/assets/replyTree.js') }}"></script>
<!-- ↓body閉じタグ直前でjQueryを読み込む -->
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js">
</head>

<body>
<div class="loader">Loading...</div>
    <div class="row tweets">
        <!-- <div id="leftContents" class="col-sm-3"></div>
        <div id="centerContents" class="col-sm-6"></div>
        <div id="rightContents" class="col-sm-3"></div> -->
        <div class="leftContents col-sm-3"></div>
        <div class="centerContents col-sm-6"></div>
        <div class="rightContents col-sm-3"></div>
    </div>
</body>
</html>