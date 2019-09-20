<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">
    <link rel="shortcut icon" href="">
</head>

<body>
    <div>
    <form method = post>
        <img class="myIcon" src="$icon" alt="myIcon" />
        <div>ユーザ名<input type="text" class="userName" value="$name" /></div>
        <div>自己紹介</div>
        <div><textarea class="userId" cols="50" rows="7" maxlength="200" value="$profile"></textarea></div>
        <input class="save" type="submit" value="保存" />
    </form>
    </div>
</body>

</html>