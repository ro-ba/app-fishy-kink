var result;
var tweetCount;
var count = 1;
var target;
var tweetImage;

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

/******************************************************************* 変数の初期化等 *******************************************************************/
function init(result) {
    replyWindow();
    tweetWindow();
    tweetCount = result.length;
    count = 1;
};

/******************************************************************* 1秒ごとにツイートの数を取得し数に変動があった場合にアラート表示 *******************************************************************/
function startTweetAlert() { // 遅延処理
    setInterval((function update() { //1000ミリ秒ごとに実行
        $.ajax({
            type: 'POST',
            url: '/api/reloadTweets',   // url: は読み込むURLを表す
            dataType: 'json',           // 読み込むデータの種類を記入
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
                    '<a href="" class="alert-link">新しいツイート</a>' +
                    '</div>';
            }
        }).fail(function (err) {
            // 通信失敗時の処理
            alert('ファイルの取得に失敗しました。');
        });
        return update;
    }()), 10000);
};

/******************************************************************* ファボ *******************************************************************/
$(function () {
    $(".centerContents").on('click', ".favo", function () {
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

/******************************************************************* ツイート表示 *******************************************************************/
function dispTweets(results, searchType = "") {
    if (searchType) {
        doc = $(`.centerContents .${searchType}`);
    } else {
        doc = $('.centerContents');
    }
    $(doc).empty();
    $('.loader').fadeIn();
    console.log(results);
    results.forEach(function (tweet) {
        $(doc).append(createTweetElement(tweet));
        count++;
    });
    $('.loader').fadeOut();
    startTweetAlert();
    init(results);
}

/******************************************************************* tweet一件分のJSONからエレメントを生成*******************************************************************/
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
        retweetUserName = tweet["userName"];
        retweetUserID = tweet["userID"];
        // tweet = getOriginTweet(tweet);
        tweet = tweet["originTweet"];
        if (tweet["retweetUser"].indexOf(session["userID"]) == -1) {
            tweetType = `<div class="retweet-user"><a href="/profile?user=${retweetUserID}">${retweetUserName}</a>さんがリツイートしました</div>`;
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
            ${tweet["userName"]}@${tweet["userID"]}
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

    return tweetDocument;


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
    $(".centerContents").on("click", ".reTweet", function () {
        //クリックされた.accordion2の中のp要素に隣接する.accordion2の中の.innerを開いたり閉じたりする。
        $(this).next('.inner').slideToggle();
    });
});

/******************************************************************* リプライボタン押したら・・・ *******************************************************************/
$(function () {
    $(".centerContents").on("click", ".reply", function () {
        var tweetid = $(this).parents().siblings("#tweetID").val();
        target = tweetid;
        replyButton = this;
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
            document.getElementById('parentTweet').innerHTML = '<div><input id="target" name="target" type="hidden" value=' + selectTweet["_id"]["$oid"] + ' /><div>' + 
                '<div>' + selectTweet["userID"] + '</div>' +
                '<div>' + selectTweet["time"] + '</div>' +
                '<div>' + selectTweet["text"] + '</div>';
        });
    });
});
/******************************************************************* リプライ用のウインドウ *******************************************************************/
function replyWindow() {
    const modalArea = document.getElementById('replyArea');
    const closeModal = document.getElementById('closeReply');
    const modalBg = document.getElementById('replyBg');
    const sendButton = document.getElementById('replySend');
    var toggle = [];
    toggle.push(closeModal);
    toggle.push(modalBg);
    toggle.push(sendButton);
    for (let i = 1; i < count; i++) {
        toggle.push(document.getElementById('reply' + i));
    }
    for (let i = 0, len = toggle.length; i < len; i++) {
        toggle[i].addEventListener('click', function () {
            modalArea.classList.toggle('reply-show');
        }, false);
    }
}

/******************************************************************* ツイート用のウインドウ *******************************************************************/
function tweetWindow() {
    const modalArea = document.getElementById('tweetArea');
    const openModal = document.getElementById('tweet');
    const closeModal = document.getElementById('closeTweet');
    const modalBg = document.getElementById('tweetBg');
    const sendButton = document.getElementById('newTweet');
    const toggle = [openModal, closeModal, modalBg, sendButton];

    for (let i = 0, len = toggle.length; i < len; i++) {
        toggle[i].addEventListener('click', function () {    // イベント処理(クリック時)
            //tweetのpreview-imageを初期化
            $(".preview-image").html('<p class="pre">PREVIEW</p>');
            modalArea.classList.toggle('tweet-show');            // modalAreaのクラスの値を切り替える 
        }, false);
    }
}

/**************************** ツイート送信 ********************************* */
$(function () {
    $('#newTweet').click(function () {
        let fd = new FormData($("#tweet-form").get(0));
        $.ajax({
            type: 'POST',
            url: '/api/tweet',
            dataType: 'json',
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: fd,
            cache: false
        }).done(function () {

            //yamasaki追加　送信成功時に内容を削除
            $("#tweetText").val("");
            $("#tweetFile").val("");

            // results["message"].forEach(function(request){
            //     console.log(request);
            // });
            // アラートの追加
            document.getElementById('alertContents').innerHTML = '<div id="alert" class="alert alert-info" role="alert">' +
            '<a href="" class="alert-link">新しいツイート</a>' +
            '</div>';
        }).fail(function (err) {
            // 通信失敗時の処理
            alert('ファイルの取得に失敗しました。');
        });;
    });
});

/******************************************************************* リプライ送信 *******************************************************************/

$(function () {
    $('#replySend').click(function () {                                 // リプライの送信ボタンが押されたら
        let fd = new FormData($("#reply-form").get(0));
        $.ajax({
            type: 'POST',
            url: '/api/reply',
            dataType: 'json',
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: fd,
            cache: false
        }).done(function (results) {

            //yamasaki追加　送信成功時に内容を削除
            $("#replyText").val("");
            $("#replyFile").val("");

            // アラートの追加
            document.getElementById('alertContents').innerHTML = '<div id="alert" class="alert alert-info" role="alert">' +
                '<a href="" class="alert-link">新しいツイート</a>' +
                '</div>';
        });
    });
});

/******************************************************************* ツイート時の画像表示 *******************************************************************/
function loadImage(obj , type){
    
    FileCheck(type);

    $(".preview-image").html('<p class="pre">PREVIEW</p>');
    for (i = 0; i < 4; i++) {
        var fileReader = new FileReader();
        fileReader.readAsDataURL(obj.files[i].name);
        fileReader.onload = (function (e)
        {
            $(".preview-image").append('<img src="' + e.target.result + '">');
        });
    }
    
}

/******************************************************************* nullでのツイート防止 *******************************************************************/
function textCheck()
{
    var textValue = document.getElementById('tweetText').value;
    var tweetButton = document.getElementById('newTweet');
    if (textValue == "" || textValue == null) {
        tweetButton.disabled = true;
    } else {
        tweetButton.disabled = false;
    }
}


/******************************************************************* nullでのリプライ防止 *******************************************************************/
function replyCheck()
{
    var textValue = document.getElementById('replyText').value;
    var tweetButton = document.getElementById('replySend');
    if (textValue == "" || textValue == null) {
        tweetButton.disabled = true;
    } else {
        tweetButton.disabled = false;
    }
}
/******************************************************************* 画像の枚数を制限し2秒間アラートを出す（tweet時　＆　reply時） *******************************************************************/
var timerId;

function FileCheck(type){
    if(type == 'tweet'){
        var fileList = document.getElementById("tweetFile").files;
        if(fileList.length > 4){    
            document.getElementById('tweetFileAlert').innerHTML = '<div id="tweetAlert" class="alert alert-danger" role="alert">' +
            '<p>画像ファイルは4枚まででお願いします。\n どうかご了承を・・・</p>' +
                '</div>';
            $("#tweetFile").val("");
            timerId = setTimeout( closeTweetFileAlert, 2000 );
        }

    }
    else{
        var fileList = document.getElementById("replyFile").files;
        if(fileList.length > 4){    
            document.getElementById('replyFileAlert').innerHTML = '<div id="replyAlert" class="alert alert-danger" role="alert">' +
                '<a href="" class="replyFileAlert">画像ファイルは4枚まででお願いします。\n どうかご了承を・・・</a>' +
                '</div>';
            $("#replyFile").val("");
            timerId = setTimeout( closeReplyFileAlert, 2000 );
            }  
    }
    
}

/******************************************************************* タイマーをリセット（FileCheckを強制的に止めてアラートを消す） *******************************************************************/
 function closeTweetFileAlert() {
    clearTimeout( timerId );
    $("#tweetAlert").remove();
}

 // タイマーの中止
 function closeReplyFileAlert() {
    clearTimeout( timerId );
    $("#replyAlert").remove();
}






