function dispUsers(results, searchType = "") {
    if (searchType) {
        doc = $(`.centerContents .${searchType}`);
    } else {
        doc = $('.centerContents');
    }
    $(doc).empty();
    $('.loader').fadeIn();
    console.log(results);
    results.forEach(function (tweet) {
        $(doc).append(createUserElement(tweet));
    });
    $('.loader').fadeOut();
}

/******************************************************************* tweet一件分のJSONからエレメントを生成してcenterContentsに追加*******************************************************************/
function createUserElement(tweet) {

    let tweetDocument = "";


    if (getParam["user"]) {
        userID = getParam["user"];
    } else {
        userID = session["userID"];
    }
    tweetDocument = `
        <div class="tabs">
        <input id="follow" onclick="location.href='/following?user=${userID}'" type="button" name="tab_item" >
        <label class="tab_item1" for="follow">フォロー中</label>
        <input id="follower" onclick="location.href='/followers?user=${userID}'"  type="button" name="tab_item" class="checked">
        <label class="tab_item2" for="follower">フォロワー</label>
    `;

    return tweetDocument;


}