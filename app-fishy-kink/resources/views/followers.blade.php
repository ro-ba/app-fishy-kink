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

    <script>
     $(document).on('click','.tabs',function()){
        $.ajax({
        type: 'POST',
        url: '/api/getFollowing',
        dataType: 'json',
        async: false,
        data: {
            userID: getParam('user'),
            _token: '{{ csrf_token() }}'
        },
        cache: false
        }).done(function(result) {
            
        });
        return tweet;

     }

    </script>


</head>
<body>
        <div class="tabs">
        <input id="follow" type="radio" name="tab_item" checked>
        <label class="tab_item" for="follow">フォロー中</label>

        <input id="follower" type="radio" name="tab_item" checked>
        <label class="tab_item" for="follower">フォロワー</label>

    <div class="tab_content" id="followerS_content">
       @isset($followerData)
            @isset($followerData["follower"][0])
                @if(count($userProfile["follower"]) == 1)
                         <ul class ="list_none">
                            <li>
                            <a onclick="location.href='/profile?user={{$follower['userID']}}'"><img src='{{$follower["userImg"]}}'/></a>
                                    {{$follower["userName"]}}    
                                <button class="word_btn" type="button" onclick="location.href='/profile?user={{$follower['userID']}}'">
                                    <span>@</span>{{$follower["userID"]}}
                                </button>
                                <div class="profilePro">{{$follower["profile"]}}</div>
                            </li>
                        </ul>
                @elseif(count($userProfile["follower"]) > 1)     
                    @foreach ($followerData["follower"] as $key => $followers)
                        <ul class ="list_none">
                            <li>
                            <a onclick="location.href='/profile?user={{ $followers }}'"><img src='{{ $followerImg[$key] }}'/></a>
                                    {{$followerName[$key]}}    
                                <button class="word_btn" type="button" onclick="location.href='/profile?user={{ $followers }}'">
                                    <span>@</span>{{ $followers }}
                                </button>

                                <div class="profilePro">
                                {{
                                    $followerPro[$key]
                                    ,$key = $key + 1   
                                }}  
                                </div>
                            </li>
                        </ul>
                    @endforeach
                @endif
            @endisset
        @endisset
    </div>

        <!-- フォロー中表示 -->
    <div class="tab_content" id="follow_content">
        
    </div>

    <div>
        <button  class="btn-square" type="button" onclick="location.href='/profile'">戻る</button>
    </div>  

</body>
</html>
