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
    console.log(results);
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

    console.log(user);

    userDocument += `
        <ul class ="list_none">
            <li>
                <a onclick="location.href='/profile?user=${user['userID']}'">
                    <img src='${user["userImg"]}'/>
                </a>
                ${user["userName"]}    
                <button class="word_btn" type="button" onclick="location.href='/profile?user=${user['userID']}'">
                    <span>@</span>${user['userID']}
                </button>

                <div class="profilePro">
                    ${user['profile']}
                </div>
                
                
            </li>
        </ul>
    `;

    // userDocument = `
    // `;


    return userDocument;


}


/******************************************************************* フォローしているかどうか *******************************************************************/