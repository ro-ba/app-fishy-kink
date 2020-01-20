function dispUsers(results, searchType = "") {
    if (searchType) {
        doc = $(`.centerContents .${searchType}`);
    } else {
        doc = $('.centerContents');
    }
    $(doc).empty();
    $('.loader').fadeIn();
    console.log(results);
    results.forEach(function (user) {
        $(doc).append(createUserElement(user));
    });
    $('.loader').fadeOut();
}

/******************************************************************* user一人分のJSONからエレメントを生成*******************************************************************/
function createUserElement(user) {

    let userDocument = "";
    let userID = user["userID"];

    console.log(user);

    userDocument += `
        <ul class ="list_none">
            <li>
                <a onclick="location.href='/profile?user=${user['userID']}'">
                    <img src='${user["userImg"]}'/>
                </a>
                ${user["userName"]}    
                <button class="word_btn" type="button" onclick="location.href='/profile?user=${user['userID']}'">
                    <span>@</span>${user['userID']}
                </button>

                <div class="profilePro">
                    ${user['profile']}
                </div>
                
                
            </li>
        </ul>
    `;

    // userDocument = `
    // `;


    return userDocument;


}


/******************************************************************* フォローしているかどうか *******************************************************************/
$(function () {
    $(".centerContents").on('click', ".normalReTweet", function () {
        // var tweetid = $(".centerContents > #tweetID").val();
        var tweetid = $(this).parents("").siblings("#tweetID").val();
        var push_button = this;
        $.ajax({
            type: 'POST',
            url: '/api/reTweet',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                tweetID: tweetid,
            },
            cache: false
        }).done(function (results) {
            //アコーディオンを閉じる処理
            $(push_button).parents(".inner").slideToggle();
            if (results["message"] == "add") {
                $(push_button).parents().prevAll(".reTweet").children().css("color", "green");
                $(push_button).text("リツイートを取り消す");
            } else if (results["message"] == "delete") {
                $(push_button).parents().prevAll(".reTweet").children().css("color", "gray");
                $(push_button).text("リツイート");
            } else {
                alert("リツイートできませんでした。");
            }
        });
    });
});