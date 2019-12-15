function getNotifyCount() {
    $.ajax({
        type: 'POST',
        url: '/api/notifyCount',
        dataType: 'json',
        async: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        cache: false
    }).done(function (result) {
        if (result["count"] != 0) {
            $(".notifyCountBudge").append(`<p class="readCount" data-badge="${result["count"]}"></p>`);
        } else {
            $(".notifyCountBudge").empty();
        }
    });
};

//10秒に一度通知のカウントを更新
setInterval(getNotifyCount, 10000);