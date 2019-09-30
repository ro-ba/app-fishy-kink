$(function){
    function(){
    $.ajax( {  // ajax の非同期通信として ajaxメソッドを使用
        // 以下Ajax のオプション指定
        type: GET,
        url: home.blade.php
    })
    $.ajaxSetup({
        type: "POST",
        timeout: 5000, // 10sec
    });
    // $.ajax()を呼び出す。
    $.ajax({
        url: "../home.blade.php",
        data: null
    });
    }
};