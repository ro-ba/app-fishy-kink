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
        <!-- <input id="follower" type="radio" name="tab_item" checked>
        <label class="tab_item" for="follower">フォロワー</label> -->

        <input id="follow" type="radio" name="tab_item" checked>
        <label class="tab_item" for="follow">フォロー中</label>

    <div class="tab_content" id="follow_content">
        @isset($followData)
            @isset($followData["follow"][0])
                
                @foreach ($followData["follow"] as $key => $following)
            <ul class ="list_none">
                <li >
                    {{$followerName[$key]}}    
                <button type="button" onclick="location.href='/profile?user={{ $following }}'">
                    {{ $following }}
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

    <input  type="button" onclick="location.href='/profile'" value="戻る">
   

    <!-- <div class="tab_content" id="followerS_content">
           
    </div> -->

</body>
</html>
