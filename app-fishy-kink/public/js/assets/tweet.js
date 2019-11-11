var result;
var tweetCount;

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
function getOriginTweet(tweet) {
    $.ajax({
        type: 'POST',
        url: '/api/getOriginTweet',
        dataType: 'json',
        async: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            tweetID: tweet["originTweetID"],
        },
        cache: false
    }).done(function (originTweet) {
        tweet = originTweet["tweet"];
    });
    return tweet;
};

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
        tweetCount = results.length;
        console.log("初期のツイートの数　" + result.length);

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
                console.log("本家のツイートの数　" + results.length);
                console.log("保持しているツイートの数　" + tweetCount);
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
    $("#centerContents").on('click', ".fab", function () {
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

    let tweetType;
    let userIcon;
    let tweetDocument;
    let countImg;
    let iconColor;
    let reTweetText;

    results.forEach(function (tweet) {

        tweetDocument = "";

        tweetDocument += '<div class="tweet card">';

        if (tweet["type"] == "retweet") {
            tweetDocument += '<input id="tweetID" type="hidden" value=' + tweet["originTweetID"]["$oid"] + ' />';
            tweetType = '<div class="retweet-user">' + tweet["userID"] + 'さんがリツイートしました</div>';
            tweet = getOriginTweet(tweet);
        } else {
            tweetDocument += '<input id="tweetID" type="hidden" value=' + tweet["_id"]["$oid"] + ' />';
            tweetType = "";
        }

        if (typeof tweet["userImg"] !== "undefined") {
            userIcon = tweet["userImg"];
        } else {
            userIcon = "";
        }

        tweetDocument += `
    <div class="tweetTop card-header">
        ${tweetType}
        <div class="tweetTop-left" style="display:inline-block; vertical-align:middle;">
        <img src="${userIcon}" width="50px" height="50px" />
        </div>
        <div class="tweetTop-right" style="display:inline-block; vertical-align:middle; position:relative; left:10%;">
        <div class="tweet-user">
            <a href=/profile?user=' + ${tweet["userID"]} + '>
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
        tweetDocument += '<button class=reply type=button><span class="oi oi-action-undo" style="color:blue;"></span> </button>';

        //リツイート
        iconColor = "";
        reTweetText = "";

        if (tweet["type"] == "tweet") {
            if (tweet["retweetUser"].indexOf("{{ session('userID') }}") == -1) {
                iconColor = "gray";
                reTweetText = "リツイート";
            } else {
                iconColor = "green";
                reTweetText = "リツイートを取り消す";
            }
        } else {
            //とりあえず
            iconColor = "pink";
            reTweetText = "これはリツイートです";
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
        if (tweet["fabUser"].indexOf("{{ session('userID') }}") == -1) {
            iconColor = "gray";
        } else {
            iconColor = "red";
        }

        tweetDocument += '<button class=fab type=button><span class="oi oi-heart" style="color:${iconColor};"></span> </button>';

        tweetDocument += '</div>';
        tweetDocument += '</div>';

        $('#centerContents').append(tweetDocument);
        $('.loader').fadeOut();
    });
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

            $("#alert").remove();
            tweetCount = results.length;

            console.log("本家のツイートの数　" + results.length);
            console.log("保持しているツイートの数　" + tweetCount);

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

// /******************************************************************* 別タブで表示 *******************************************************************/
// function open1() {
//     var w = (screen.width - 600) / 2;
//     var h = (screen.height - 600) / 2;
//     window.open("/tweet", "hoge", "width=600, height=500" + ",left=" + w + ",top=" + h + ",directions=0 , location=0  , menubar=0 , scrollbars=0 , status=0 , toolbar=0 , resizable=0");
// }

// /******************************************************************* 別タブで表示２（仮） *******************************************************************/
// function open2() {
//     window.open("/tweet", "hoge", "width=600, height=600 , location=no");
// }


