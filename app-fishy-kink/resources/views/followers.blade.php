<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>followers</title>
<meta charset="utf-8">
<meta name="description" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/Follow.css">

<script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>

</head>

<body>
        
    <?php
        if (isset($_GET['user'])){
            $target =   $_GET['user'];
        }else{
            $target =   session("userID");
        }
    ?>
    <div class="tabs">
        <input id="follow" onclick="location.href='/following?user={{$target}}'" type="button" name="tab_item" >
        <label class="tab_item1" for="follow">フォロー中</label>
        <input id="follower" onclick="location.href='/followers?user={{$target}}'"  type="button" name="tab_item" class="checked">
        <label class="tab_item2" for="follower">フォロワー</label>

        <div class="tab_content" id="followerS_content">
            @foreach( $users as $user)
                <ul class ="list_none">
                    <li>
                        <a onclick="location.href='/profile?user={{ $user['userID'] }}'">
                            <img src='{{ $user["userImg"] }}'/>
                        </a>
                        {{$user["userName"]}}    
                        <button class="word_btn" type="button" onclick="location.href='/profile?user={{ $user['userID'] }}'">
                            <span>@</span>{{ $user['userID'] }}
                        </button>

                        <div class="profilePro">
                            {{ $user['profile'] }}
                        </div>
                        
                        
                    </li>
                </ul>
            @endforeach
        </div>
    <div>
    @isset($_GET['user'])
        <button  class="btn-square" type="button" onclick="location.href='/profile?user={{$_GET['user']}}'">戻る</button>
    @else
        <button  class="btn-square" type="button" onclick="location.href='/profile?user={{session('userID')}}'">戻る</button>
    @endisset
    </div>
    
</body>
</html>
