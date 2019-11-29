var result;
var tweetCount;
var count = 1;

/******************************************************************************ツイートIDからツイートデータを取得する************************************************************************/
function getTweet(tweetID) {
    $.ajax({
        type: 'POST',
        url: '/api/getTweet',
        dataType: 'json',
        async: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            tweetID: tweetID,
        },
        cache: false
    }).done(function (originTweet) {
        tweet = originTweet["tweet"];
    });
    return tweet;
};


/******************************************************************************ツイートのデータからオリジナルツイートのデータを取得する************************************************************************/
//replyのツリー作成で後で使うかも
// function getOriginTweet(tweet) {
//     $.ajax({
//         type: 'POST',
//         url: '/api/getOriginTweet',
//         dataType: 'json',
//         async: false,
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         },
//         data: {
//             tweetID: tweet["originTweetID"],
//         },
//         cache: false
//     }).done(function (originTweet) {
//         tweet = originTweet["tweet"];
//     });
//     return tweet;
// };

/******************************************************************* ページ読み込んだ瞬間に実行される *******************************************************************/
$(function () { // 遅延処理
    $.ajax({
        type: 'POST',
        url: '/api/reloadTweets', // url: は読み込むURLを表す
        dataType: 'json', // 読み込むデータの種類を記入
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            userID: userID
        },
        cache: false
    }).done(function (results) {
        // 通信成功時の処理
        result = results;
        dispTweets(result);
        replyWindow();
        tweetCount = results.length;
        count = 1;

    }).fail(function (err) {
        // 通信失敗時の処理
        alert('ファイルの取得に失敗しました。');
    });
});


/******************************************************************* 1秒ごとにツイートの数を取得し数に変動があった場合にアラート表示 *******************************************************************/
$(function () { // 遅延処理
    setInterval((function update() { //1000ミリ秒ごとに実行
        $.ajax({
            type: 'POST',
            url: '/api/reloadTweets', // url: は読み込むURLを表す
            dataType: 'json', // 読み込むデータの種類を記入
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                userID: userID
            },
            cache: false
        }).done(function (results) {
            if (tweetCount != results.length) {
                // アラートの追加
                document.getElementById('alertContents').innerHTML = '<div id="alert" class="alert alert-info" role="alert">' +
                    '<a href="#" class="alert-link">新しいツイート</a>' +
                    '</div>';
            }
        }).fail(function (err) {
            // 通信失敗時の処理
            alert('ファイルの取得に失敗しました。');
        });
        return update;
    }()), 10000);
});

/******************************************************************* ファボ *******************************************************************/
$(function () {
    $("#centerContents").on('click', ".favo", function () {
        tweetid = $(this).parents().siblings("#tweetID").val();
        var push_button = this;
        $.ajax({
            type: 'POST',
            url: '/api/favorite',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                tweetID: tweetid,
            },
            cache: false
        }).done(function (results) {
            if (results["message"] == "add") {
                $(push_button).css("color", "red");
                $(push_button).children().css("color", "red");
            } else if (results["message"] == "delete") {
                $(push_button).css("color", "gray");
                $(push_button).children().css("color", "gray");
            } else {
                alert("お気に入りに追加できませんでした");
            }
        });
    });
});

/******************************************************************* リツイート *******************************************************************/
$(function () {
    $("#centerContents").on('click', ".normalReTweet", function () {
        // var tweetid = $("#centerContents > #tweetID").val();
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


/******************************************************************* ツイート表示 *******************************************************************/
function dispTweets(results) {
    $('#centerContents').empty();
    $('.loader').fadeIn();

    results.forEach(function (tweet) {        
        createTweetElement(tweet);
        count++;
 
    });
    $('.loader').fadeOut();
}


/******************************************************************* tweet一件分のJSONからエレメントを生成してcenterContentsに追加*******************************************************************/
function createTweetElement(tweet) {

    let tweetType;
    let userIcon;
    let tweetDocument = "";
    let countImg;
    let iconColor;
    let reTweetText;

    tweetDocument += '<div class="tweet card" id="tweet">';

    if (tweet["type"] == "retweet") {
        tweetDocument += '<input id="tweetID" type="hidden" value=' + tweet["originTweetID"]["$oid"] + ' />';
        retweetUser = tweet["userID"];
        // tweet = getOriginTweet(tweet);
        tweet = tweet["originTweet"];
        if (tweet["retweetUser"].indexOf(session["userID"]) == -1) {
            tweetType = '<div class="retweet-user">' + retweetUser + 'さんがリツイートしました</div>';
        } else {
            tweetType = '<div class="retweet-user">リツイート済み</div>';
        }
        tweet["type"] = "retweet";
    } else {
        tweetDocument += '<input id="tweetID" type="hidden" value=' + tweet["_id"]["$oid"] + ' />';
        tweetType = "";
    }

    if (typeof tweet["userImg"] !== "undefined") {
        userIcon = tweet["userImg"];
    } else {
        userIcon = defaultIcon;
    }

    tweetDocument += `
    <div class="tweetTop card-header">
        ${tweetType}
        <div class="tweetTop-left" style="display:inline-block; vertical-align:middle;">
        <img src="${userIcon}" width="50px" height="50px" />
        </div>
        <div class="tweetTop-right" style="display:inline-block; vertical-align:middle; position:relative; left:10%;">
        <div class="tweet-user">
            <a href=/profile?user=${tweet["userID"]}>
            ${tweet["userID"]}
            </a>
        </div>
        <div class="time">
            ${tweet["time"]}
        </div>
        </div>
    </div>
    <div class="tweetMain card-body">${tweet["text"]}</div>
    <div class="imagePlaces" style=float:left>
    `;

    //画像表示
    countImg = tweet["img"].length;
    for (var i = 0; i < countImg; i++) {
        tweetDocument += `<img src=" ${tweet["img"][i]}"width="200" height="150" />`;
    }

    tweetDocument += `
    </div>
    <div class="tweetBottom d-inline">`;

    //リプライ
    tweetDocument += '<button class="reply" id=reply' + count + ' type=button><span class="oi oi-action-undo" style="color:blue;"></span> </button>';
   
    //リツイート
    iconColor = "";
    reTweetText = "";

    if (tweet["retweetUser"].indexOf(session["userID"]) == -1) {
        iconColor = "gray";
        reTweetText = "リツイート";
    } else {
        iconColor = "green";
        reTweetText = "リツイートを取り消す";
    }

    tweetDocument += `
    <div class="accordion">
        <button class=reTweet type=button><span class="oi oi-loop" style="color: ${iconColor} ;"></span> </button>

        <div class="inner">
        <button class=normalReTweet type=button> ${reTweetText}</button>
        <a href=javascript:open2()>🖊コメントつけてリツイート</a>
        </div>
    </div>
    `;

    //ファボ
    if (tweet["favoUser"].indexOf(session["userID"]) == -1) {
        iconColor = "gray";
    } else {
        iconColor = "red";
    }


    tweetDocument += `<button class=favo type=button><span class="oi oi-heart" style="color:${iconColor};"></span> </button>`;


    tweetDocument += '</div>';
    tweetDocument += '</div>';

    $('#centerContents').append(tweetDocument);        


}

/******************************************************************* 新しいツイートの表示 *******************************************************************/

$(function () { // 遅延処理
    $(document).on("click", ".alert-link", function () {
        $.ajax({
            type: 'POST',
            url: '/api/reloadTweets', // url: は読み込むURLを表す
            dataType: 'json', // 読み込むデータの種類を記入
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                userID: userID
            },
            cache: false
        }).done(function (results) {
            dispTweets(results);
            replyWindow();
            count = 1;

            $("#alert").remove();
            tweetCount = results.length;
        }).fail(function (err) {
            // 通信失敗時の処理
            alert('ファイルの取得に失敗しました。');
        });
    });
});

/******************************************************************* アコーディオンの閉じたり開いたり *******************************************************************/
$(function () {
    $("#centerContents").on("click", ".reTweet", function () {
        //クリックされた.accordion2の中のp要素に隣接する.accordion2の中の.innerを開いたり閉じたりする。
        $(this).next('.inner').slideToggle();
    });
});

/******************************************************************* リプライボタン押したら・・・ *******************************************************************/
$(function () {
    $("#centerContents").on("click", ".reply", function () {
        var tweetid = $(this).parents().siblings("#tweetID").val();
        replyButton = this;
        // console.log(replyButton);
        $.ajax({
            type: 'POST',
            url: '/api/getTweet',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                tweetID: tweetid,
            },
            cache: false
        }).done(function (results) {
            var selectTweet = results["tweet"]
            document.getElementById('parentTweet').innerHTML = '<div>' + selectTweet["userID"] + '</div>' +
                '<div>' + selectTweet["time"] + '</div>' +
                '<div>' + selectTweet["text"] + '</div>';
            // reply(replyButton);
        });
    });
});

/******************************************************************* リプライ用のウインドウ（仮） *******************************************************************/

function replyWindow (){
        const modalArea = document.getElementById('modalArea1');
        const closeModal = document.getElementById('closeModal1');
        const modalBg = document.getElementById('modalBg1');
        const sendButton = document.getElementById('replySend');
        toggle = [closeModal, modalBg, sendButton];
        for(let i=1;i<count;i++){
            toggle.push(document.getElementById('reply' + i));
        }
        for (let i = 0, len = toggle.length; i < len; i++){
            toggle[i].addEventListener('click', function (){
                modalArea.classList.toggle('is-show1');
            }, false);
        }
}

/******************************************************************* ツイート時の画像表示 *******************************************************************/
function loadImage(obj) {
    document.getElementById('preview').innerHTML = '<p class="pre">PREVIEW</p>';
    for (i = 0; i < 4; i++) {
        var fileReader = new FileReader();
        fileReader.readAsDataURL(obj.files[i]);
        fileReader.onload = (function (e) {
            document.getElementById('preview').innerHTML += '<img src="' + e.target.result + '">';
        });
    }
}

