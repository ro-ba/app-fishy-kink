<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ログイン</title>
<link rel="stylesheet" href="css/login.css">
<link rel="shortcut icon" href="images/FKicon.png">
<link href="https://fonts.googleapis.com/css?family=Caveat|Josefin+Sans|Vibes&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Dosis|Inconsolata|Josefin+Sans|Turret+Road&display=swap" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
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
                          <input class="id" type="text" name="userID" value="@isset($oldID) {{ $oldID }} @endisset" placeholder="ID">
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
<script>
    if ($(".id").val()){
        console.log("hello");
        $('input[type="password"]').focus();
    }else{
        $(".id").focus();
    }
</script>
</html>