<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>login</title>
</head>

<body>
    <!-- <form class="input" method="POST" action="/login">
        <div class="inputId"><input type="text" name="userID" value="ID/メールアドレス" /></div>
        <div class="inputPass"><input type="text" name="password" value="パスワード" /></div>
        <div><a href="/login">ID・パスワードを忘れた場合はこちら</a></div>
        <input class="loginButton" type="submit" value="ログイン">
        <div>または</div>
        <input class="registerButton" type="button" onclick="location.href='/signUp'" value="新規登録">
    </form> -->
    <form method="POST" action="/login">
        @csrf
        <!-- {{ csrf_field() }} -->
        <div>userID:<input type="text" name="userID"/></div>
        <div>password:<input type="password" name="password"/></div>
        <input type="submit" value="login" />
    </form>
    <div><a href="login">ID・パスワードを忘れた場合はこちら</a></div>
    <div>または</div>
    <input class="registerButton" type="button" onclick="location.href='./signUp'" value="新規登録">
    
</body>

</html>