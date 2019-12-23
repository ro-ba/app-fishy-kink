    <div style="text-align:center" id="menu row d-inline col-md-12">
        <button type="button"  style="width:150px;height:50px;" class="link_button btn page-link text-dark d-inline-block " onclick="location.href='/home'">home</button>
        <button type="button"   style="width:150px;height:50px;" class="link_button btn page-link text-dark d-inline-block NotifyButton" onclick="location.href='/notify'">通知
        <div class="notifyCountBudge"></div>
        </button>
        <button type="button" style="width:150px;height:50px;" class="link_button btn page-link text-dark d-inline-block" onclick="location.href='/DM'">メッセージ</button>
        <button type="button"  style="width:150px;height:50px;" class="link_button btn page-link text-dark d-inline-block" onclick="location.href='/story'">ストーリー</button>
        <input type="image" class="link_button btn page-link text-dark d-inline-block" onclick="location.href='/profile'" src="{{ Session::get('userIcon') }}" height="50" width="50" class="img-thumbnail" style="width: auto; padding:0; margin:0; background:none; border:0; font-size:0; line-height:0; overflow:visible; cursor:pointer;">
        </button>
        <div class="d-inline-block" style="width:250px;height:50px;background-color: #C0C0C0;">
        <form method='get' action="/search" class="form-inline d-inline">   
        <input class="form-control" type=text name="searchString" placeholder="ユーザ検索" style="margin-top:5px;border:none;width:145px;height:40px;background-color:#C2EEFF;"><button  style="margin-top:5px;border:none;width:90px;height:40px;background-color:#1E90FF;" class="form-control" type=input>
        <span class="oi oi-magnifying-glass"></span> 検索 </button>
        </form>
        </div>
        <button type="button" style="width:150px;height:50px;" id="tweet" class="link_button btn page-link text-dark d-inline-block">ツイート</button>
            <button type=" button" style="width:150px;height:50px;" class="link_button btn page-link text-dark d-inline-block" onclick="location.href='/logout'">ログアウト</button>
    </div>
