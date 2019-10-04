<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ログイン</title>
<link rel="stylesheet" href="css/login.css">
<link href="https://fonts.googleapis.com/css?family=Caveat|Josefin+Sans|Vibes&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Dosis|Inconsolata|Josefin+Sans|Turret+Road&display=swap" rel="stylesheet">
</head>

<body>
    <div class="main">
        <h1>Fishy Kink</h1>
        <div class="content">

            <div class="title">LOG IN</div>
            @isset($message)
              <div class="err-message">{{ $message[1] }}</div>
            @endisset

            <div class="login-form">
                <form method="POST" action="/login">
                    @csrf
                    <div class="login">
                        <div class="login-id">
                          <input class="login-id" type="text" name="userID" value="@isset($oldID) {{ $oldID }} @endisset" placeholder="ID">
                        </div>
                        <div class="login-password">
                            <input type="password" name="password" placeholder="Password"/>
                        </div>
                    </div>

                    <div class="login-submit"><input type="submit" value="ログイン" /></div>
                    <div class="forgot"><a href="/login">ID・パスワードを忘れた場合はこちら</a></div>

                    <h4 class="or">または</h4>

                    <div class="signup"><input type="button" onclick="location.href='/signUp'" value="新規登録"></div>
                </form>
            </div>

        </div>
    </div>
</body>
</html>

<!-- <!DOCTYPE html>
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

</html> -->