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

/******************************************************************* user一人分のJSONからエレメントを生成*******************************************************************/
function createUserElement(user) {

    let userDocument = "";
    let userID = user["userID"];

    userDocument = `
    `;

    userDocument = `
    `;


    return userDocument;


}