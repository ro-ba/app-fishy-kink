@extends('home')

@section('content')
    <div id="menu row d-inline col-md-12">
        <button type="button" class="link_button btn page-link text-dark d-inline-block" onclick="location.href='/home'">home</button>
        <button type="button" class="link_button btn page-link text-dark d-inline-block" onclick="location.href='/notify'">通知
        @if($count != 0)
        <p class = "readCount"  data-badge="{{ $count }}"></p></button>
        @endif
        <button type="button" class="link_button btn page-link text-dark d-inline-block" onclick="location.href='/DM'">メッセージ</button>
        <button type="button" class="link_button btn page-link text-dark d-inline-block" onclick="location.href='/story'">ストーリー</button>
        <input type="image" class="link_button btn page-link text-dark d-inline-block" onclick="location.href='/profile'" src="{{ $userIcon }}" height="40" width="40" class="img-thumbnail" style="width: auto; padding:0; margin:0; background:none; border:0; font-size:0; line-height:0; overflow:visible; cursor:pointer;">
        </button>

        <form method='get' action="/search" class="form-inline d-inline">

        <input class="form-control" type=text name="searchString">
        <button class="form-control" type=input> <span class="oi oi-magnifying-glass"></span> 検索 </button>
    
        </form>
        <button type="button" id="tweet" class="link_button btn page-link text-dark d-inline-block">ツイート</button>
            <button type=" button" class="link_button btn page-link text-dark d-inline-block" onclick="location.href='/logout'">ログアウト</button>
    </div>
@endsection

@extends('profile')

@section('pcontent')
    <div id="menu row d-inline col-md-12">
        <button type="button" class="link_button btn page-link text-dark d-inline-block" onclick="location.href='/home'">home</button>
        <button type="button" class="link_button btn page-link text-dark d-inline-block" onclick="location.href='/notify'">通知
        @if($count != 0)
        <p class = "readCount"  data-badge="{{ $count }}"></p></button>
        @endif
        <button type="button" class="link_button btn page-link text-dark d-inline-block" onclick="location.href='/DM'">メッセージ</button>
        <button type="button" class="link_button btn page-link text-dark d-inline-block" onclick="location.href='/story'">ストーリー</button>
        <input type="image" class="link_button btn page-link text-dark d-inline-block" onclick="location.href='/profile'" src="{{ $userIcon }}" height="40" width="40" class="img-thumbnail" style="width: auto; padding:0; margin:0; background:none; border:0; font-size:0; line-height:0; overflow:visible; cursor:pointer;">
        </button>

        <form method='get' action="/search" class="form-inline d-inline">

        <input class="form-control" type=text name="searchString">
        <button class="form-control" type=input> <span class="oi oi-magnifying-glass"></span> 検索 </button>
    
        </form>
        <button type="button" id="tweet" class="link_button btn page-link text-dark d-inline-block">ツイート</button>
            <button type=" button" class="link_button btn page-link text-dark d-inline-block" onclick="location.href='/logout'">ログアウト</button>
    </div>
@endsection