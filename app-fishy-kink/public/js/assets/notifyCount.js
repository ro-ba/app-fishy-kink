$(function () { // 遅延処理
    setInterval((function update() { //1000ミリ秒ごとに実行
        console.log("hello");
        $.ajax({
            type: 'POST',
            url: '/api/notifyCount', // url: は読み込むURLを表す
            dataType: 'json', // 読み込むデータの種類を記入
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                userID: userID
            },
            cache: false
        }).done(function (results) {
            if (results["message"] != "0") {
                // アラートの追加
                // document.getElementById('readCount').innerHTML = '<p class="readCount">' +
                //     results["message"] +
                //     '</p>';
                $("#readCount").html(`<p class="readCount"> ${results["message"]}</p >`);
            }
        });
        return update;
    }()), 30000);
});