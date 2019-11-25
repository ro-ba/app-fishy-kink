function createTweetElement(tweet)
{
    tweetDocument = "";

    tweetDocument += '<div class="tweet card" id="tweet">';

    if (tweet["type"] == "retweet")
    {
        tweetDocument += '<input id="tweetID" type="hidden" value=' + tweet["originTweetID"]["$oid"] + ' />';
        retweetUser = tweet["userID"];
        tweet = getOriginTweet(tweet);
        if (tweet["retweetUser"].indexOf(session["userID"]) == -1)
        {
            tweetType = '<div class="retweet-user">' + retweetUser + 'さんがリツイートしました</div>';
        } else
        {
            tweetType = '<div class="retweet-user">リツイート済み</div>';
        }
        tweet["type"] = "retweet";
    } else
    {
        tweetDocument += '<input id="tweetID" type="hidden" value=' + tweet["_id"]["$oid"] + ' />';
        tweetType = "";
    }

    if (typeof tweet["userImg"] !== "undefined")
    {
        userIcon = tweet["userImg"];
    } else
    {
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
    for (var i = 0; i < countImg; i++)
    {
        tweetDocument += `<img src=" ${tweet["img"][i]}"width="200" height="150" />`;
    }

    tweetDocument += `
    </div>
    <div class="tweetBottom d-inline">`;

    //リプライ
    tweetDocument += '<button class="reply" id="reply" type=button><span class="oi oi-action-undo" style="color:blue;"></span> </button>';

    //リツイート
    iconColor = "";
    reTweetText = "";

    if (tweet["retweetUser"].indexOf(session["userID"]) == -1)
    {
        iconColor = "gray";
        reTweetText = "リツイート";
    } else
    {
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
    if (tweet["favoUser"].indexOf(session["userID"]) == -1)
    {
        iconColor = "gray";
    } else
    {
        iconColor = "red";
    }


    tweetDocument += `<button class=favo type=button><span class="oi oi-heart" style="color:${iconColor};"></span> </button>`;


    tweetDocument += '</div>';
    tweetDocument += '</div>';

    $('#centerContents').append(tweetDocument);

}