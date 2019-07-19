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
    <div class="card-body">
    <form method="post">
        @csrf
        <h4 class="card-title">新規アカウント登録</h4>
        <div class="form-group">
        @if ($errors->has("username"))
            <input class="form-control is-invalid" type="text" name="username" value="{{ old('username') }}" placeholder="username">
            <p class="alert alert-danger">{{ $errors->first("username") }}</p>
        @else
            <input class="form-control @if(old('username'))is-valid @endif " type="text" name="username" value="{{ old('username') }}" placeholder="username">
        @endif
        </div>
        <div class="form-group">
        @if ($errors->has("userID"))
            <input class="form-control is-invalid" type="text" name="userID" value="{{ old('userID') }}" placeholder="ID"> 
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->get("userID") as $error)
                    <li> {{ $error }} </li>
                    @endforeach
                </ul>
            </div>
        @else
            <input class="form-control @if(old('userID'))is-valid @endif" type="text" name="userID" value="{{ old('userID') }}" placeholder="ID">
        @endif
        </div>

        <div class="form-group">
        @if ($errors->has("password"))
            <input class="form-control is-invalid" type="password" name="password" placeholder="password" >
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->get("password") as $error)
                    <li> {{ $error }} </li>
                    @endforeach
                </ul>
            </div>
        @else
            <input class="form-control" type="password" name="password" placeholder="password" >
            <small class="form-text text-muted">
                パスワードは4～20文字で英字・数字を両方含む必要があります。
            </small>
        @endif
        </div>
        
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