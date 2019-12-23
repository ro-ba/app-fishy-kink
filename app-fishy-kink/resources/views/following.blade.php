<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>following</title>
<meta charset="utf-8">
<meta name="description" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/Follow.css">
<script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>

   
</head>
<body>
            <div class="tabs">
            <input id="follow" onclick="location.href='/following?user={{$_GET['user']}}'" type="button" name="tab_item" class="checked">
            <label class="tab_item1" for="follow">フォロー中</label>
            <input id="follower" onclick="location.href='/followers?user={{$_GET['user']}}'"  type="button" name="tab_item" >
            <label class="tab_item2" for="follower">フォロワー</label>
       
        
      
<!-- フォロー中表示 -->
    <div class="tab_content2" id="follow_content">
        @isset($followingData)
            @isset($followingData["follow"][0])
                @if(count($userProfile["follow"]) == 1)
                            <ul class ="list_none">
                                <li>
                                <a onclick="location.href='/profile?user={{$follow['userID']}}'"><img src='{{$follow["userImg"]}}'/></a>
                                        {{$follow["userName"]}}    
                                    <button class="word_btn" type="button" onclick="location.href='/profile?user={{$follow['userID']}}'">
                                        <span>@</span>{{$follow["userID"]}}
                                    </button>
                                    <div class="profilePro">{{$follow["profile"]}}</div>
                                </li>
                            </ul>
                @elseif(count($userProfile["follow"]) > 1)     
                    @foreach ($followingData["follow"] as $key => $following)
                        <ul class ="list_none">
                            <li>
                            <a onclick="location.href='/profile?user={{ $following }}'"><img src='{{ $followingImg[$key]}}'/></a>
                                    {{$followingName[$key]}}    
                                <button class="word_btn" type="button" onclick="location.href='/profile?user={{ $following }}'">
                                <span>@</span>{{ $following }}
                                </button>
                                <div class="profilePro">
                                    {{ $followingPro[$key] ,$key = $key + 1 }} 
                                </div>
                            </li>
                        </ul>
                    @endforeach
                @endif
            @endisset
        @endisset
                    
    </div>

    <!-- フォロワー表示 -->
    <div class="tab_content1" id="followerS_content">
        <ul class="list_none" id="list">
        </ul>
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
