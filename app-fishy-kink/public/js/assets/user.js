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
    
    if(user["userID"] == 'hera3'){
            follow.push(user["follow"]);
        }

        
    userDocument += `
        <ul class ="list_none">
            <li>
                <input id="userID" type="hidden" value="${user['userID']}" />
                <a class='userID' onclick="location.href='/profile?user=${user['userID']}'">
                    <img src='${user["userImg"]}'/>
                </a>

                ${user["userName"]}    
                <button class="word_btn" type="button" onclick="location.href='/profile?user=${user['userID']}'">
                    <span>@</span>${user['userID']}
                </button>`;
                console.log(follow);
                console.log(user["userID"]);

                for(let i=0;i<follow.length;i++){
                    if(follow[i] == user["userID"]){ 
                        console.log("55555555555555555555555555");   
                        userDocument += `<button type="button" class="Follow-button noFollow">フォローしていません</button>`;
                    }
                    else{
                        console.log("00000000000000000000000");   
                        userDocument += `<button type="button" class="Follow-button nowFollow">フォロー中</button>`;
                    }
                }

                userDocument += `

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
//ボタンを押したらフォローする　または　フォローを外す
$(function(){
  $(".Follow-button").click(function () {
      var userID = $(this).siblings("#userID").val();
      console.log(userID);
      follow(userID,$(this));
  });
});


/******************************************************************* フォローしているかどうか *******************************************************************/