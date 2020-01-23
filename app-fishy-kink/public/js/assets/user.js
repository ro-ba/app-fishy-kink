var follow = [];

function dispUsers(results, searchType = "")
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
    // console.log(results);
    results.forEach(function (user)
    {
        $(doc).append(createUserElement(user));

    });

    $('.loader').fadeOut();
}

/******************************************************************* user一人分のJSONからエレメントを生成*******************************************************************/
function createUserElement(user)
{

    let userDocument = "";
    let userID = user["userID"];

    if (user["userID"] == 'hera3')
    {
        follow.push(user["follow"]);
    }


    userDocument += `
        <ul class ="list-group">
            <li class="list-group-item">
                <input id="userID" type="hidden" value="${user['userID']}" />
                <a class='userID' onclick="location.href='/profile?user=${user['userID']}'">
                    <img class='userIcon' src='${user["userImg"]}'/>
                </a>

                ${user["userName"]}    
                <button class="word_btn" type="button" onclick="location.href='/profile?user=${user['userID']}'">
                    <span>@</span>${user['userID']}
                </button>`;

    userDocument += `<div class="follow-btn-group float-right">`;
    if (user["follower"].indexOf(session["userID"]) == -1)
    {
        userDocument += `<button type="button" class="Follow-button noFollow">フォローしていません</button>`;
    }
    else
    {
        userDocument += `<button type="button" class="Follow-button nowFollow">フォロー中</button>`;
    }
    userDocument += `<img class="mini-loader" src="${mini_loader}" width="32" height="32"/>
                </div>`

    userDocument += `

                <div class="profile">
                    ${user['profile']}
                </div>
                
            </li>
        </ul>
    `;

    // userDocument = `
    // `;

    return userDocument;


}
//ボタンを押したらフォローする　または　フォローを外す
$(function ()
{
    $(".Follow-button").click(function ()
    {
        var userID = $(this).parent().siblings("#userID").val();
        console.log(userID);
        follow(userID, $(this));
    });
});