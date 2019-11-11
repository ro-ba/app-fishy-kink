<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>tweet</title>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/tweet.css">
    <link rel="shortcut icon" href="">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>
    <form action="tweet"  class="tweet" method="POST" enctype="multipart/form-data" onclick="this.form.submit();window.close()">
    @csrf
        <div id="wrap">
            <div class="myTweet">
                <img class="myIcon" src='{{$userData["userImg"]}}' alt="myIcon" />
                <textarea class="tweetText" cols="50" rows="7" maxlength="200" name="tweetText" placeholder="いまどうしてる？"></textarea>
            </div>

            <div class="content">
                <label>
                    <span class="filelabel">
                        <img src="/images/imgicon.jpg" width="60" height="60" alt="ファイル選択">
                    </span>
                    <input type="file" id="file" name="tweetImage[]" accept="image/*" onchange="loadImage(this);" multiple/>
                </label>
                <div class="t-submit">
                    <input class="newTweet" method="POST" type="submit" value="tweet" />   
                </div>
            </div>

            <div class="tweet-image">              
                <p id="preview"></p>
            </div>
        </div>

    </form>
</body>
</html>

<script>
    function loadImage(obj)
    {
        document.getElementById('preview').innerHTML = '<p class="pre">PREVIEW</p>';
        for (i = 0; i < 4; i++) {
            var fileReader = new FileReader();
            fileReader.onload = (function (e) {
                document.getElementById('preview').innerHTML += '<img src="' + e.target.result + '">';
            });
            fileReader.readAsDataURL(obj.files[i]);
        }
    }
</script>



<!-- <!DOCTYPE html>
<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>tweet</title>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">
    <link rel="shortcut icon" href="">
</head>

<body>
    <form action="tweet"  class="tweet" method="POST" enctype="multipart/form-data">
    
    @csrf
    <img class="myIcon" src="<%= icon %>" alt="myIcon" />
            
            <textarea class="tweetText" cols="50" rows="7" maxlength="200" name="tweetText" placeholder="いまどうしてる？"></textarea>
            <div class="">
                <img src="<%= image %>" alt="ツイート画像" />

                <input type="file" name="tweetImage[]" multiple="multiple" accept="image/*"/>

                <input class="newTweet" method="POST" type="submit" value="tweet" />   
            </div>
        </div>

    </form>
</body>

</html> -->