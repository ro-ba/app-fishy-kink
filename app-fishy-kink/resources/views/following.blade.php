<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>followers</title>
<meta charset="utf-8">
<meta name="description" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
    <div class="search-main">
        <div class="search">
            <form action="">
                <input type="text" value="" class="">
                <input type=submit value="検索">
            </form>
        </div>

        <ul class="search-tab">
            <li class="tab_list"><a href="#following">フォロー</a></li>    
        </ul>
        @isset($followData)
            @isset($followData["follow"][0])
                
                @foreach ($followData["follow"] as $key => $following)
                <button type="button" onclick="location.href='/profile?user={{ $following }}'">
                    {{ $following }}
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
    </div>

</body>
</html>
