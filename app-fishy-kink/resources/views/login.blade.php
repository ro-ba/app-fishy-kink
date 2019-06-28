<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <form method="POST" action="/login">
        <!-- @csrf -->
        {{ csrf_field() }}
        <div class="form-group">userID:<input class="form-control" type="text" name="userID"/></div>
        password:<input class="form-control" type="password" name="password"/></div>
        <div class="form-group"><input class="btn btn-primary" type="submit" value="ログイン" />
    </form>
    <div class="btn btn-warning"><a href="/login">ID・パスワードを忘れた場合はこちら</a></div>
    <div>または</div>
    <input class="btn btn-success" type="button" onclick="location.href='/signUp'" value="新規登録">
    
</body>

</html>