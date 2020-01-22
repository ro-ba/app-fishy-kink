var result;
var tweetCount;
var count = 1;
var target;
var tweetImage;
var deleteTweetID;

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
function init()
{
    replyWindow();
    commentRetweetWindow();
    tweetWindow();
    count = 1;
};

/******************************************************************* 1秒ごとにツイートの数を取得し数に変動があった場合にアラート表示 *******************************************************************/
function startTweetAlert()
{ // 遅延処理
    setInterval((function update()
    { //1000ミリ秒ごとに実行
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

        }).done(function (results)
        {
            var trueTweetCount;
            results.forEach(function (tweet)
            {
                if (results["showFlg"])
                {
                    trueTweetCount++;
                }
                count++;
            });

            if (tweetCount != trueTweetCount)
            {

                // アラートの追加
                document.getElementById('alertContents').innerHTML = '<div id="alert" class="alert alert-info" role="alert">' +
                    '<a href="" class="alert-link">新しいツイートがあります　ここをクリックしてください</a>' +
                    '</div>';
            }
        }).fail(function (err)
        {
            // 通信失敗時の処理
            alert('ファイルの取得に失敗しました。');
        });
        return update;
    }()), 10000);
};

/******************************************************************* ファボ *******************************************************************/
$(function ()
{
    $(".centerContents").on('click', ".favo", function ()
    {
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
        }).done(function (results)
        {
            if (results["message"] == "add")
            {
                $(push_button).css("color", "red");
                $(push_button).children().css("color", "red");
            } else if (results["message"] == "delete")
            {
                $(push_button).css("color", "gray");
                $(push_button).children().css("color", "gray");
            } else
            {
                alert("お気に入りに追加できませんでした");
            }
            //数字のカウントアップ/ダウン
            $({ count: Number($(push_button).siblings(".favorite-count").text()) }).animate({ count: Number(results["count"]) }, {
                duration: 1000,
                easing: 'linear',
                progress: function ()
                {
                    $(push_button).siblings(".favorite-count").text(Math.ceil(this.count));
                }
            });
        });
    });
});

/******************************************************************* リツイート *******************************************************************/
$(function ()
{
    $(".centerContents").on('click', ".normalReTweet", function ()
    {
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
        }).done(function (results)
        {
            //アコーディオンを閉じる処理
            $(push_button).parents(".inner").slideToggle();
            if (results["message"] == "add")
            {
                $(push_button).parents().prevAll(".reTweet").children().css("color", "green");
                $(push_button).text("リツイートを取り消す");
            } else if (results["message"] == "delete")
            {
                $(push_button).parents().prevAll(".reTweet").children().css("color", "gray");
                $(push_button).text("リツイート");
            } else
            {
                alert("リツイートできませんでした。");
            }
            //数字のカウントアップ/ダウン
            $({ count: Number($(push_button).parent().siblings(".retweet-count").text()) }).animate({ count: Number(results["count"]) }, {
                duration: 1000,
                easing: 'linear',
                progress: function ()
                {
                    $(push_button).parent().siblings(".retweet-count").text(Math.ceil(this.count));
                }
            });
        });
    });
});

/******************************************************************* ツイート表示 *******************************************************************/
function dispTweets(results, searchType = "")
{

    if (searchType)
    {
        doc = $(`.centerContents .${searchType}`);
    } else
    {
        doc = $('.centerContents');
    }
    $(doc).empty();
    $('.loader').fadeIn();
    console.log(results);
    results.forEach(function (tweet)
    {
        $(doc).append(createTweetElement(tweet));
        if (results["showFlg"])
        {
            tweetCount++;
        }
        count++;
    });
    $('.loader').fadeOut();
    startTweetAlert();
    init();
}

// /******************************************************************* tweet一件分のJSONからエレメントを生成*******************************************************************/
// function createTweetElement(tweet) {

//     let tweetType;
//     let userIcon;
//     let tweetDocument = "";
//     let countImg;
//     let iconColor;
//     let reTweetText;

//     if (tweet["showFlg"] == false) {
//         return tweetDocument;
//     }

//     tweetDocument += '<div class="tweet card" id="tweet">';

//     if (tweet["type"] == "retweet") {
//         tweetDocument += '<input id="tweetID" type="hidden" value=' + tweet["originTweetID"]["$oid"] + ' />';
//         retweetUserName = tweet["userName"];
//         // retweetUserName = tweet["userID"];
//         retweetUserID = tweet["userID"];
//         // tweet = getOriginTweet(tweet);

//         tweet = tweet["originTweet"];
//         if (tweet["retweetUser"].indexOf(session["userID"]) == -1) {
//             console.log("リツイート者：" + retweetUserName);
//             tweetType = `<div class="retweet-user"><a href="/profile?user=${retweetUserID}">${retweetUserName}</a>さんがリツイートしました</div>`;
//         } else {
//             tweetType = '<div class="retweet-user">リツイート済み</div>';
//         }
//         tweet["type"] = "retweet";
//     } else {
//         tweetDocument += '<input id="tweetID" type="hidden" value=' + tweet["_id"]["$oid"] + ' />';
//         tweetType = "";
//     }

//     if (typeof tweet["userImg"] !== "undefined") {
//         userIcon = tweet["userImg"];
//     } else {
//         userIcon = defaultIcon;
//     }

//     tweetDocument += `
//     <div class="tweetTop card-header">
//         ${tweetType}
//         <div class="tweetTop-left" style="display:inline-block; vertical-align:middle;">
//         <img class="userIcon" src="${userIcon}" width="50px" height="50px" />
//         </div>
//         <div class="tweetTop-right" style="display:inline-block; vertical-align:middle; position:relative; left:10%;">
//         <div class="tweet-user">
//             <a href=/profile?user=${tweet["userID"]}>
//                 ${tweet["userName"]}@${tweet["userID"]}
//             </a>
//         </div>
//         <div class="time">
//             ${tweet["time"]}
//         </div>
//         </div>
//     </div>
//     <div class="tweetMain card-body">${tweet["text"]}</div>
//     <div class="imagePlaces" style=float:left>
//     `;

//     //画像表示
//     countImg = tweet["img"].length;
//     for (var i = 0; i < countImg; i++) {
//         tweetDocument += `<img src=" ${tweet["img"][i]}"id="image" width="200" height="150" />`;
//     }

//     tweetDocument += `
//     </div>
//     <div class="tweetBottom d-inline">`;

//     //リプライ
//     tweetDocument += '<button class="reply" id=reply' + count + ' type=button style="margin:3% 2% 1% 20%;border:none;"><span class="oi oi-action-undo" style="color:blue;"></span> </button>';

//     //リツイート
//     iconColor = "";
//     reTweetText = "";

//     if (tweet["retweetUser"].indexOf(session["userID"]) == -1) {
//         iconColor = "gray";
//         reTweetText = "リツイート";
//     } else {
//         iconColor = "green";
//         reTweetText = "リツイートを取り消す";
//     }

//     tweetDocument += `
//     <div class="accordion">
//         <button class=reTweet type=button style="margin:3% 2% 1% 20%;border:none;"><span class="oi oi-loop" style="color: ${iconColor} ;"></span> </button>
//         ${tweet["retweetUser"].length}



//         <div class="inner">
//         <button class=normalReTweet type=button> ${reTweetText}</button>
//         <button class=quoteReTweet id=quoteReTweet` + count + `>🖊コメントつけてリツイート</button>
//         </div>
//     </div>
//     `;

//     //ファボ
//     if (tweet["favoUser"].indexOf(session["userID"]) == -1) {
//         iconColor = "gray";
//     } else {
//         iconColor = "red";
//     }
//     tweetDocument +=
//         `<button class=favo type=button style="margin:3% 2% 1% 20%;border:none;"><span class="oi oi-heart" style="color:${iconColor};"></span> </button>
//         ${tweet["favoUser"].length}
//         `;
//     tweetDocument += '</div>';
//     tweetDocument += '</div>';

//     return tweetDocument;

// }

/******************************************************************* 新しいツイートの表示 *******************************************************************/

$(function ()
{ // 遅延処理
    $(document).on("click", ".alert-link", function ()
    {
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
        }).done(function (results)
        {
            dispTweets(results);
            replyWindow();
            count = 1;

            $("#alert").remove();
            tweetCount = results.length;
        }).fail(function (err)
        {
            // 通信失敗時の処理
            alert('ファイルの取得に失敗しました。');
        });
    });
});

/******************************************************************* アコーディオンの閉じたり開いたり *******************************************************************/
$(function ()
{
    $(".centerContents").on("click", ".reTweet", function ()
    {
        //クリックされた.accordion2の中のp要素に隣接する.accordion2の中の.innerを開いたり閉じたりする。
        $(this).nextAll('.inner').slideToggle();
    });
});

/******************************************************************* ツイート用のウインドウ *******************************************************************/
function tweetWindow()
{
    const modalArea = document.getElementById('tweetArea');
    const openModal = document.getElementById('tweet');
    const closeModal = document.getElementById('closeTweet');
    const modalBg = document.getElementById('tweetBg');
    const sendButton = document.getElementById('newTweet');
    const toggle = [openModal, closeModal, modalBg, sendButton];

    for (let i = 0, len = toggle.length; i < len; i++)
    {
        toggle[i].addEventListener('click', function ()
        {    // イベント処理(クリック時)
            //tweetのpreview-imageを初期化
            $(".preview-image").html('<p class="pre">PREVIEW</p>');
            modalArea.classList.toggle('tweet-show');            // modalAreaのクラスの値を切り替える 
        }, false);
    }
}

/******************************************************************* リプライ用のウインドウ *******************************************************************/
function replyWindow()
{
    const modalArea = document.getElementById('replyArea');
    const closeModal = document.getElementById('closeReply');
    const modalBg = document.getElementById('replyBg');
    const sendButton = document.getElementById('replySend');
    var toggle = [];
    toggle.push(closeModal);
    toggle.push(modalBg);
    toggle.push(sendButton);
    for (let i = 1; i < count; i++)
    {
        toggle.push(document.getElementById('reply' + i));
    }
    for (let i = 0, len = toggle.length; i < len; i++)
    {
        toggle[i].addEventListener('click', function ()
        {
            modalArea.classList.toggle('reply-show');
        }, false);
    }
}

/******************************************************************* 引用リツイート用のウインドウ *******************************************************************/
function commentRetweetWindow()
{
    const modalArea = document.getElementById('quoteReTweetArea');
    const closeModal = document.getElementById('closeQuoteReTweet');
    const modalBg = document.getElementById('quoteReTweetBg');
    const sendButton = document.getElementById('quoteReTweetSend');
    var toggle = [];
    toggle.push(closeModal);
    toggle.push(modalBg);
    toggle.push(sendButton);
    console.log(modalBg);
    for (let i = 1; i < count; i++)
    {
        toggle.push(document.getElementById('quoteReTweet' + i));
    }
    for (let i = 0, len = toggle.length; i < len; i++)
    {
        console.log(toggle[i]);
        toggle[i].addEventListener('click', function ()
        {
            modalArea.classList.toggle('quoteReTweet-show');
        }, false);
    }
}

/******************************************************************* ツイートボタン押したら・・・ *******************************************************************/

function resetTweet()
{

    $("#tweetText").val("");
    $("#tweetFile").val("");
    $("#tweet-image").html("");
}


/******************************************************************* リプライボタン押したら・・・ *******************************************************************/
$(function ()
{
    $(".centerContents").on("click", ".reply", function ()
    {
        $("#replyText").val("");
        $("#replyFile").val("");
        $("#reply-image").html("");
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

        }).done(function (results)
        {

            var selectTweet = results["tweet"]
            console.log(selectTweet);
            parentImgCnt = selectTweet["img"].length;
            img = "";
            for (var i = 0; i < parentImgCnt; i++)
            {
                img += `<img src=" ${selectTweet["img"][i]}"id="tweetImage" width="50" height="50" />`;
            }
            userImg = `<img src=" ${selectTweet["userImg"]}" class="userImg" width="50" height="50" />`;
            document.getElementById('reply-parent').innerHTML = '<div><input id="target1" name="target1" type="hidden" value=' + selectTweet["_id"]["$oid"] + ' /><div>' +
                '<div class="reply-main">' +
                  '<div class="reply-content">' +
                    
                    '<ul class="reply-info">' +
                        '<li><div class="reply-usericon">' + userImg + '</div></li>' +
                        '<li><div class="reply-userid">' + selectTweet["userID"] + '</div></li>' +
                        '<li><div class="reply-time">'   + selectTweet["time"]   + '</div></li>' +
                    '</ul>' +
                    
                    '<div class="reply-text">'   + selectTweet["text"]   + '</div>' +
                    img;
                  '</div>'
                '</div>'
        });
    });
});

/******************************************************************* 引用リツイートボタン押したら・・・ *******************************************************************/
$(function ()
{
    $(".centerContents").on("click", ".quoteReTweet", function ()
    {
        $("#quoteReTweetText").val("");
        $("#quoteReTweetFile").val("");
        $("#quoteReTweet-image").html("");
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

        }).done(function (results)
        {
            var selectTweet = results["tweet"]
            parentImgCnt = selectTweet["img"].length;
            img = "";
            for (var i = 0; i < parentImgCnt; i++)
            {
                img += `<img src=" ${selectTweet["img"][i]}"id="tweetImage" width="50" height="50" />`;
            }
            userImg = `<img src=" ${selectTweet["userImg"]}" class="userImg" width="50" height="50" />`;
            document.getElementById('parentTweet2').innerHTML = '<div><input id="target2" name="target2" type="hidden" value=' + selectTweet["_id"]["$oid"] + ' /><div>' +
                '<div class="retweet">' +
                  '<div class="retweet-content">' +
                    
                    '<ul class="retweet-info">' +
                      '<li><div class="retweet-usericon">' + userImg + '</div></li>' +
                      '<li><div class="retweet-userid">' + selectTweet["userID"] + '</div></li>' +
                      '<li><div class="retweet-time">' + selectTweet["time"] + '</div></li>' +
                    '</ul>' +
                    
                    '<div class="retweet-text">' + selectTweet["text"] + '</div>' +
                    img;
                  '</div>'
                '</div>'
        });
    });
});



/******************************************************************* ツイート送信 *******************************************************************/
$(function ()
{
    $('#newTweet').click(function ()
    {
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
        }).done(function ()
        {

            //yamasaki追加　送信成功時に内容を削除
            $("#tweetText").val("");
            $("#tweetFile").val("");

            // アラートの追加
            document.getElementById('alertContents').innerHTML = '<div id="alert" class="alert alert-info" role="alert">' +
                '<a href="" class="alert-link">新しいツイートがあります　ここをクリックしてください</a>' +
                '</div>';
            return ["message"];
        }).fail(function (err)
        {
            // 通信失敗時の処理
            alert('ファイルの取得に失敗しました。');
        });;
    });
});

/******************************************************************* リプライ送信 *******************************************************************/

$(function ()
{
    $('#replySend').click(function ()
    {                                 // リプライの送信ボタンが押されたら
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
        }).done(function (results)
        {

            //yamasaki追加　送信成功時に内容を削除
            $("#replyText").val("");
            $("#replyFile").val("");

            // アラートの追加
            document.getElementById('alertContents').innerHTML = '<div id="alert" class="alert alert-info" role="alert">' +
                '<a href="" class="alert-link">新しいツイートがあります　ここをクリックしてください</a>' +
                '</div>';
        });
    });
});

/******************************************************************* 引用リツイート送信 *******************************************************************/

$(function ()
{
    $('#quoteReTweetSend').click(function ()
    {                                 // リプライの送信ボタンが押されたら
        let fd = new FormData($("#quoteReTweet-form").get(0));
        $.ajax({
            type: 'POST',
            url: '/api/quoteReTweet',
            dataType: 'json',
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: fd,
            cache: false
        }).done(function (results)
        {

            // //yamasaki追加　送信成功時に内容を削除
            // $("#replyText").val("");
            // $("#replyFile").val("");

            // アラートの追加
            document.getElementById('alertContents').innerHTML = '<div id="alert" class="alert alert-info" role="alert">' +
                '<a href="" class="alert-link">新しいツイートがあります　ここをクリックしてください</a>' +
                '</div>';
        }).fail(function (err)
        {
            // 通信失敗時の処理
            alert('ファイルの取得に失敗しました。');
        });;
    });
});

/******************************************************************* ツイート時の画像表示 *******************************************************************/
function loadImage(obj, type)
{


    if (FileCheck(type))
    {
        if (type == 'tweet')
        {
            document.getElementById('tweet-image').innerHTML = '<p>PREVIEW</p>';
            for (i = 0; i < obj.files.length; i++)
            {

                var fileReader = new FileReader();
                fileReader.onload = (function (e)
                {
                    document.getElementById('tweet-image').innerHTML += '<img src="' + e.target.result + '" width="100" height="100 ">';
                });
                fileReader.readAsDataURL(obj.files[i]);
            }
        }

        else if (type == 'reply')
        {
            document.getElementById('reply-image').innerHTML = '<p>PREVIEW</p>';
            for (i = 0; i < obj.files.length; i++)
            {
                var fileReader = new FileReader();
                fileReader.onload = (function (e)
                {
                    document.getElementById('reply-image').innerHTML += '<img src="' + e.target.result + '" width="100" height="100 ">';
                });
                fileReader.readAsDataURL(obj.files[i]);
            }
        }

        else
        {
            document.getElementById('quoteReTweet-image').innerHTML = '<p>PREVIEW</p>';
            for (i = 0; i < obj.files.length; i++)
            {

                var fileReader = new FileReader();
                fileReader.onload = (function (e)
                {
                    document.getElementById('quoteReTweet-image').innerHTML += '<img src="' + e.target.result + '" width="100" height="100 ">';
                });
                fileReader.readAsDataURL(obj.files[i]);
            }
        }
    }
}



/******************************************************************* 画像の枚数を制限し2秒間アラートを出す（tweet時　＆　reply時） *******************************************************************/
var timerId;

function FileCheck(type)
{
    if (type == 'tweet')
    {
        var fileList = document.getElementById("tweetFile").files;
        if (fileList.length > 4)
        {
            document.getElementById('tweetFileAlert').innerHTML = '<div id="tweetAlert" class="alert alert-danger" role="alert">' +
                '<p>画像ファイルは4枚まででお願いします。\n どうかご了承を・・・</p>' +
                '</div>';
            $("#tweetFile").val("");
            timerId = setTimeout(closeTweetFileAlert, 2000);
            return false;
        }

    }
    else if (type == 'reply')
    {
        var fileList = document.getElementById("replyFile").files;
        if (fileList.length > 4)
        {
            document.getElementById('replyFileAlert').innerHTML = '<div id="replyAlert" class="alert alert-danger" role="alert">' +

                '<p>画像ファイルは4枚まででお願いします。\n どうかご了承を・・・</p>' +
                '</div>';
            $("#replyFile").val("");
            timerId = setTimeout(closeReplyFileAlert, 2000);
            return false;
        }
    }
    else
    {
        var fileList = document.getElementById("quoteReTweetFile").files;
        if (fileList.length > 4)
        {
            document.getElementById('quoteReTweetFileAlert').innerHTML = '<div id="quoteReTweetAlert" class="alert alert-danger" role="alert">' +
                '<p>画像ファイルは4枚まででお願いします。\n どうかご了承を・・・</p>' +
                '</div>';
            $("#quoteReTweetFile").val("");
            timerId = setTimeout(closeQuoteReTweetFileAlert, 2000);
            return false;
        }
    }
    return true;
}

/******************************************************************* タイマーをリセット（FileCheckを強制的に止めてアラートを消す） *******************************************************************/
// タイマーの中止(ツイート)
function closeTweetFileAlert()
{
    clearTimeout(timerId);
    $("#tweetAlert").remove();
}

// タイマーの中止(リプ)
function closeReplyFileAlert()
{
    clearTimeout(timerId);
    $("#replyAlert").remove();
}

// タイマーの中止(引用リツイート)
function closeQuoteReTweetFileAlert()
{
    clearTimeout(timerId);
    $("#quoteReTweetFileAlert").remove();
}


/******************************************************************* tweet一件分のJSONからエレメントを生成*******************************************************************/
function createTweetElement(tweet) {

    let tweetType;
    let userIcon;
    let tweetDocument = "";
    let countImg;
    let iconColor;
    let reTweetText;

    if (tweet["showFlg"] == false) {
        return tweetDocument;
    }


    tweetDocument += '<div class="tweet card" id="tweet">';

    if (tweet["type"] == "retweet") {
        tweetDocument += '<input id="tweetID" type="hidden" value=' + tweet["originTweetID"]["$oid"] + ' />';
        retweetUserName = tweet["userName"];
        // retweetUserName = tweet["userID"];
        retweetUserID = tweet["userID"];
        // tweet = getOriginTweet(tweet);

        tweet = tweet["originTweet"];
        if (tweet["retweetUser"].indexOf(session["userID"]) == -1) {
            console.log("リツイート者：" + retweetUserName);
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
    <div class="tweetTop card-header">`;

        if (session["userID"] == tweet["userID"]) {
            tweetDocument += `
            <ul class="menu" style="position:relative; float:right; right:0; margin: 0 0 0 auto;">
                <li>
                    <a class="oi oi-menu" hreaf="#"></a>
                    <ul>
                        <a class="tweDel" id="tweDel"` + count + `" href="#">ツイート削除</a>
                    </ul>
                </li>
            </ul>`;
        }

        tweetDocument += `
        ${tweetType}
        <div class="tweetTop-left" style="display:inline-block; vertical-align:middle;">
        <img class="userIcon" src="${userIcon}" width="50px" height="50px" />
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
        tweetDocument += `<img src=" ${tweet["img"][i]}"id="image" width="200" height="150" />`;
    }

    tweetDocument += `
    </div>
    <div class="tweetBottom d-inline">`;

    //リプライ
    tweetDocument += '<button class="reply" id=reply' + count + ' type=button style="margin:3% 2% 1% 20%;border:none;"><span class="oi oi-action-undo" style="color:blue;"></span> </button>';

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
        <button class=reTweet type=button style="margin:3% 2% 1% 20%;border:none;"><span class="oi oi-loop" style="color: ${iconColor} ;"></span> </button>
        ${tweet["retweetUser"].length}



        <div class="inner">
        <button class=normalReTweet type=button> ${reTweetText}</button>
        <button class=quoteReTweet id=quoteReTweet` + count + `>🖊コメントつけてリツイート</button>
        </div>
    </div>
    `;

    //ファボ
    if (tweet["favoUser"].indexOf(session["userID"]) == -1) {
        iconColor = "gray";
    } else {
        iconColor = "red";
    }
    tweetDocument +=
        `<button class=favo type=button style="margin:3% 2% 1% 20%;border:none;"><span class="oi oi-heart" style="color:${iconColor};"></span> </button>
        ${tweet["favoUser"].length}
        `;
    tweetDocument += '</div>';
    tweetDocument += '</div>';

    return tweetDocument;

}




/********************************ツイート削除用***********************************/

$(function () {
    $('.tweetDelete').click(function () {  
        // console.log("tweet delete : " + deleteTweetID);
        console.log(deleteTweetID);
        $.ajax({
            type: 'POST',
            url: '/api/deleteTweet',
            dataType: 'json',
            data: {
                tweetID: deleteTweetID,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            cache: false
        }).done(function (result)
        {
            console.log(result["message"]);
            window.location.reload();

        }).fail(function (err)
        {
            // 通信失敗時の処理
            alert('ファイルの取得に失敗しました。');
        });;
    });
});

/*******************モーダルオープン*********************/
$(function(){
    $('.centerContents').on("click", ".tweDel", function () {
         deleteTweetID = $(this).parents().siblings("#tweetID").val();
        
        console.log("modal : " + deleteTweetID);
        $('.js-modal').fadeIn();
            return false;
        });
        $('.js-modal-close').on('click',function(){
            $('.js-modal').fadeOut();
        return false;
        });     
});


/******************************************************************* nullでのツイート防止 *******************************************************************/
function tweetCheck()
{
    var textValue = document.getElementById('tweetText').value;
    var tweetButton = document.getElementById('newTweet');
    if (textValue == "" || textValue == null)
    {
        tweetButton.disabled = true;
    } else
    {
        tweetButton.disabled = false;
    }
}


/******************************************************************* nullでのリプライ防止 *******************************************************************/
function replyCheck()
{
    var textValue = document.getElementById('replyText').value;
    var tweetButton = document.getElementById('replySend');
    if (textValue == "" || textValue == null)
    {
        tweetButton.disabled = true;
    } else
    {
        tweetButton.disabled = false;
    }
}

/******************************************************************* nullでの引用リツイート防止 *******************************************************************/
function quoteReTweetCheck()
{
    var textValue = document.getElementById('quoteReTweetText').value;
    var tweetButton = document.getElementById('quoteReTweetSend');
    if (textValue == "" || textValue == null)
    {
        tweetButton.disabled = true;
    } else
    {
        tweetButton.disabled = false;
    }
}

/*******************削除用モーダル******************** */

function deleteWindow() {
    const modalArea = document.getElementById('modal js-modal');
    const closeModal = document.getElementById('js-modal-close');
    const modalBg = document.getElementById('modal__bg js-modal-close');
    const sendButton = document.getElementById('tweetDelete');
    var toggle = [];
    toggle.push(closeModal);
    toggle.push(modalBg);
    toggle.push(sendButton);
    for (let i = 1; i < count; i++) {
        toggle.push(document.getElementById('tweDel' + i));
    }
    for (let i = 0, len = toggle.length; i < len; i++) {
        toggle[i].addEventListener('click', function () {
            modalArea.classList.toggle('tweDel-show');
        }, false);
    }
}