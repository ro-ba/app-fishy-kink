<!DOCTYPE html>
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
        <div>
            <img class="myIcon" src="<%= icon %>" alt="myIcon" />
            <textarea class="tweetText" cols="50" rows="7" maxlength="200" name="tweetText" placeholder="いまどうしてる？"></textarea>
            <div>
                <img src="<%= image%>" alt="ツイート画像" />
<<<<<<< HEAD
                <input type="file" name="tweetImage"/>
                <input class="newTweet" method="POST" type="submit" value="tweet" onClick="window.close()"/>
=======
                <input type="file" name="tweetImage[]" multiple="multiple" accept="image/*"/>
                <!-- <input class="newTweet" method="POST" type="submit" value="tweet" onClick="window.close();"/>    -->
                <input class="newTweet" method="POST" type="submit" value="tweet" />   
>>>>>>> 0f26889c9f3251aea9f0d0f86e3c525adf4c2a0f
            </div>
            
        </div>
    </form>
</body>

</html>

