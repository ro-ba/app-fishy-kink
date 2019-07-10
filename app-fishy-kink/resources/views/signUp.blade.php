<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>新規登録</title>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">
    <link rel="shortcut icon" href="">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body class="bg-secondary">
<div class="card mb-3">
    <div class="card-header">
    </div>
    <div class="card-body">
    <form method="post">
        @csrf
        <h4 class="card-title">新規アカウント登録</h4>
        <div class="form-group">
            <input class="form-control" type="text" name="username" placeholder="名前">
        </div>

        <div class="form-group">
            <input class="form-control" type="text" name="userID" placeholder="ID">
        </div>
        @if ($errors->first("userID"))
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->get("userID") as $error)
                    <li> {{ $error }} </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-group">
            <input class="form-control" type="password" name="password" placeholder="パスワード" >
        </div>
        @if ($errors->first("password"))
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->get("password") as $error)
                    <li> {{ $error }} </li>
                    @endforeach
                    <!-- <p class="validation">※{{$errors->first('userid')}}</p> -->
                </ul>
            </div>
        @else
            <div class="form-text text-muted">
                パスワードは4～20文字で英字・数字を両方含む必要があります。
            </div>
        @endif
        
        <div class="form-group">
            <input class="btn btn-success" type="submit" value="新規登録">
        </div>
    </form>
    または
    <div ><a class="btn btn-primary" href="/login">ログイン</a></div>
    </div>
</div>
    
</body>

</html>