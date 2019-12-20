function dispUsers(results, searchType = "") {
    if (searchType) {
        doc = $(`.centerContents .${searchType}`);
    } else {
        doc = $('.centerContents');
    }
    $(doc).empty();
    $('.loader').fadeIn();
    console.log(results);
    results.forEach(function (tweet) {
        $(doc).append(createUserElement(tweet));
    });
    $('.loader').fadeOut();
}

/******************************************************************* user一人分のJSONからエレメントを生成*******************************************************************/
function createUserElement(user) {

    let userDocument = "";
    let userID = user["userID"];

    userDocument = `
        <div class="tabs">
        <input id="follow" onclick="location.href='/following?user=${userID}'" type="button" name="tab_item" >
        <label class="tab_item1" for="follow">フォロー中</label>
        <input id="follower" onclick="location.href='/followers?user=${userID}'"  type="button" name="tab_item" class="checked">
        <label class="tab_item2" for="follower">フォロワー</label>
    `;

    userDocument = `
        <div class="tab_content1" id="followerS_content">
       @isset($followerData)
            @isset($followerData["follower"][0])
                @if(count($userProfile["follower"]) == 1)
                         <ul class ="list_none">
                            <li>
                            <a onclick="location.href='/profile?user={{$follower['userID']}}'"><img src='{{$follower["userImg"]}}'/></a>
                                    {{$follower["userName"]}}    
                                <button class="word_btn" type="button" onclick="location.href='/profile?user={{$follower['userID']}}'">
                                    <span>@</span>{{$follower["userID"]}}
                                </button>
                                <div class="profilePro">{{$follower["profile"]}}</div>

                            </li>
                        </ul>
    
                @elseif(count($userProfile["follower"]) > 1)     
                    @foreach ($followerData["follower"] as $key => $followers)
                        <ul class ="list_none">
                            <li>
                            <a onclick="location.href='/profile?user={{ $followers }}'"><img src='{{ $followerImg[$key] }}'/></a>
                                    {{$followerName[$key]}}    
                                <button class="word_btn" type="button" onclick="location.href='/profile?user={{ $followers }}'">
                                    <span>@</span>{{ $followers }}
                                </button>

                                <div class="profilePro">
                                {{$followerPro[$key],$key = $key + 1}}  
                                </div>
                            </li>
                        </ul>
                    @endforeach
                @endif
            @endisset
        @endisset
        </div>

        <!-- フォロー中表示 -->
    
    <div class="tab_content2" id="follow_content">
        <ul  class="list_none" id="list">
        </ul>
    </div>
        
    <div>
    @isset($_GET['user'])
        <button  class="btn-square" type="button" onclick="location.href='/profile?user={{$_GET['user']}}'">戻る</button>
    @else
        <button  class="btn-square" type="button" onclick="location.href='/profile?user={{session('userID')}}'">戻る</button>
    @endisset
    </div>
    `;


    return userDocument;


}