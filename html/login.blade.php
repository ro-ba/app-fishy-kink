<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>login</title>
</head>

<body>
    <form class="input" method= action="POST">
        <div class="inputId"><input type="text" value="ID/メールアドレス" /></div>
        <div class="inputPass"><input type="text" value="パスワード" /></div>
        <div><a href="/login">ID・パスワードを忘れた場合はこちら</a></div>
        <input class="loginButton" type="submit" method="GET" value="ログイン">
        <div>または</div>
        <input class="registerButton" type="button" onclick="location.href='/signUp'" value="新規登録">
    </form>
</body>

</html>