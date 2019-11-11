<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title></title>
<meta charset="utf-8">
<meta name="description" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="">
<link rel="shortcut icon" href="">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
<script type="text/javascript" src="js/assets/test.js"></script>
<script>

$(function() { 
      $(document).on("click", ".follower", function() {
        $.ajax({
          type: 'POST',
          url: '/api/getFollowing', // url: は読み込むURLを表す
          dataType: 'json', // 読み込むデータの種類を記入
          data: {
            userID: 'tamano',
            _token: '{{ csrf_token() }}'
          },
          cache: false
        }).done(function(results) {
            console.log(results["follow"]);
        });
      });
    });
</script>

<script>
$(function(){
  $(document).on("click",".tweet",function(){
    $.ajax({
      type:'POST',
      url:  '/api/getTweet',
      dataType: 'json',
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data:{
        tweetID: '5dc4f7134836b77d5b5be053'
      },
      cache: false
    }).done(function(results){
        console.log(results["tweet"]);
    });
  });
});

</script>
<body>
<button class=follower>フォロワー</button>
<button class=tweet>ツイート</button>
</body>

</html> 