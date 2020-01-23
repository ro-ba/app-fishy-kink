function follow(userID, button)
{
    button.siblings(".mini-loader").fadeIn();
    $.ajax({
        type: 'POST',
        url: 'api/follow',
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            userID: userID
        },
        cache: false
    }).done(function (results)
    {
        // followした場合
        if (results["message"] == "follow")
        {
            button.removeClass("noFollow");
            button.addClass("nowFollow");
            //マウスカーソルがFollow-buttonの上にあれば
            if ($(":hover").hasClass("Follow-button"))
            {
                button.html("フォローを外す");
            } else
            {
                button.html("フォロー中");
            }
            // followを外した場合
        } else
        {
            button.removeClass("nowFollow");
            button.addClass("noFollow");
            //マウスカーソルがFollow-buttonの上にあれば
            if ($(":hover").hasClass("Follow-button"))
            {
                button.html("フォローする");
            } else
            {
                button.html("フォローしていません");
            }
        }
        button.siblings(".mini-loader").fadeOut();
    }).fail(function (err)
    {
        alert("失敗しました");
    });
}

$(function ()
{
    // マウスを重ねた時にclassとtextを変更する
    $(".Follow-button").mouseover(function ()
    {
        if ($(this).hasClass("noFollow"))
        {
            $(this).html("フォローする");
        } else
        {
            $(this).html("フォローを外す");
        }
    });
    // マウスを外した時にclassとtextを変更する
    $(".Follow-button").mouseout(function ()
    {
        if ($(this).hasClass("noFollow"))
        {
            $(this).html("フォローしていません");
        } else
        {
            $(this).html("フォロー中");
        }
    });
});