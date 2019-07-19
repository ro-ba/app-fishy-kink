<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="card mb-3">
    @isset($message)
        <div class="alert alert-{{ $message[0] }}">{{ $message[1] }} </div>
    @endisset
    <div class="card-body">
    <form method="POST" action="/login">
        @csrf
        <div class="form-group">
        <input class="form-control" type="text" name="userID" value="@isset($oldID) {{ $oldID }} @endisset" placeholder="ID"></div>
        <input class="form-control" type="password" name="password" placeholder="password"/></div>
        <div class="form-group">
            <input class="btn btn-primary" type="submit" value="ログイン" />
            <div class="btn btn-warning"><a href="/login">ID・パスワードを忘れた場合はこちら</a></div>
            <div>または</div>
            <input class="btn btn-success" type="button" onclick="location.href='/signUp'" value="新規登録">
        </div>
    </form>
    </div>
</body>

</html>