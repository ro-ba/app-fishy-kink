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

       
            <a location.href='/followers' value="フォロワー"></a>
            <!-- <a href="#following">フォロワー</a>           -->
        

        <div class="">
            
    

        @isset($followData)
            @isset($followData["follower"][0])
                @foreach ($followData["follower"] as $key => $followers)
                <button type="button" onclick="location.href='/profile?user={{ $followers }}'">
                    {{ $followers }}
                    </button>
                   {{
                    $followerPro[$key]
                    ,$key = $key + 1  
                    }}
                @endforeach
            @endisset
        @endisset
   
        <input class="btn btn-success" type="button" onclick="location.href='/profile'" value="戻る">
       
    </div>

</body>
</html>
