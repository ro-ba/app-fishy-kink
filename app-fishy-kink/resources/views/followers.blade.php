<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>followers</title>
<meta charset="utf-8">
<meta name="description" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/Followers.css">

</head>
<body>
    <div class="search-main">
        <div class="search">
            <form action="">
                <input type="text" value="" class="">
                <input type=submit value="検索">
            </form>
        </div>

        <div class="tabs">
        <input id="follower" type="radio" name="tab_item" checked>
        <label class="tab_item" for="follower">フォロワー</label>

        <!-- <input id="follow" type="radio" name="tab_item" checked>
        <label class="tab_item" for="follow">フォロー</label> -->

    <div class="tab_content" id="follower_content">
       @isset($followData)
            @isset($followData["follower"][0])
                @foreach ($followData["follower"] as $key => $followers)
            <ul calss="list_none"> 
                <li>
                    {{$followerName[$key]}}    
                    <button type="button" onclick="location.href='/profile?user={{ $followers }}'">
                        {{ $followers }}
                    </button>
                </li>
            </ul>
                <div class="profilePro">
                   {{
                    $followerPro[$key]
                    ,$key = $key + 1  
                    }}
                </div>
                @endforeach
            @endisset
        @endisset
    </div>

    <!-- <div class="tab_content" id="follow_content">
      
    </div> -->

        <div>
        <input class="btn btn-success" type="button" onclick="location.href='/profile'" value="戻る"/>
        </div>

</body>
</html>
