<!-- ツイート --> 
<section id="tweetArea" class="tweetArea">
  <div id="tweetBg" class="tweetBg"></div>
  <div class="tweetWrapper">
    <div class="tweetContents">
    <div id="tweets">
      <form id="tweet-form">
      @csrf
          <div id="wrap">
              <div class="myTweet">
                  <img class="myIcon" src="{{ Session::get('userIcon') }}" alt="myIcon" />
                  <textarea id="tweetText" class="tweetText" cols="50" rows="7" maxlength="200" name="tweetText" onkeyup="tweetCheck();" placeholder="いまどうしてる？"></textarea>
              </div>
              <div class="content">
                    <ul class="tw">
                      <label>
                          <li><img src="/images/imgicon.jpg" width="60" height="60" alt="ファイル選択"></li>
                          <input type="file" id="tweetFile" name="tweetImage[]" accept="image/*" onchange="loadImage(this , 'tweet');" multiple/>

                      </label>
                      <div class="t-submit">
                          <li><button type=button id = newTweet class="newTweet link_button btn page-link text-dark d-inline-block" disabled=true> tweet </button></li>
                      </div>
                    </ul>
              </div>
              <div id="tweet-image"></div>
          </div>
          </form>
        </div>
    <div id="closeTweet" class="closeTweet">
      ×
    </div>
    <div id="tweetFileAlert"><div> 
  </div>
</section>

<!-- リプライ -->
<div id="replyContents">
  <section id="replyArea" class="replyArea">
    <div id="replyBg" class="replyBg"></div>
    <div class="replyWrapper">
    <form id="reply-form">
      <div id="reply-parent"></div>
      @csrf
        <div class="myTweet">
          <textarea id="replyText" class="replyText" cols="50" rows="7" maxlength="200" name="replyText" onkeyup="replyCheck();" placeholder="りぷらい"></textarea>
        </div>

        <div class="contentReply">
          <ul class="tw">
            <label>
              <li><img src="/images/imgicon.jpg" width="60" height="60" alt="ファイル選択"></li>
              <input type="file" id="replyFile" name="replyImage[]" accept="image/*" onchange="loadImage(this , 'reply');" multiple/>

            </label>
            <li><button type=button id="replySend" class="link_button btn page-link text-dark d-inline-block" disabled=true>送信</button></li>
          </ul>
        </div>
        <div id="reply-image"></div>
    </form>
      <div id="closeReply" class="closeReply">
        × 
      </div>
        <div id="replyFileAlert"></div>
  </div>
  </section>
</div>

<!-- 引用リツイート -->
<div id="quoteReTweetContents">
  <section id="quoteReTweetArea" class="quoteReTweetArea">
    <div id="quoteReTweetBg" class="quoteReTweetBg"></div>
    <div class="quoteReTweetWrapper">
    <form id="quoteReTweet-form">
      @csrf
        <div class="myTweet">
          <textarea id="quoteReTweetText" class="quoteReTweetText" cols="50" rows="7" maxlength="200" name="quoteReTweetText" onkeyup="quoteReTweetCheck();" placeholder="🖊コメントつけてリツイート"></textarea>
        </div>
        <div class="contentReply">
          <!-- <ul class="tw"> -->
            <label>
              <li><img src="/images/imgicon.jpg" width="60" height="60" alt="ファイル選択"></li>
              <input type="file" id="quoteReTweetFile" name="quoteReTweetImage[]" accept="image/*" onchange="loadImage(this , 'quoteReTweet');" multiple/>

            </label>
            <div id="parentTweet2"></div>
            <li><button type=button id="quoteReTweetSend" class="link_button btn page-link text-dark d-inline-block" disabled=true>送信</button></li>
          <!-- </ul> -->
        </div>
        <div id="quoteReTweet-image"></div>
    </form>
      <div id="closeQuoteReTweet" class="closeQuoteReTweet">
        × 
      </div>
        <div id="quoteReTweetFileAlert"></div>
  </div>
  </section>
</div>

<!-- ツイート削除用モーダル -->
<div class="modal js-modal">
    <div class="modal__bg js-modal-close"></div>
    <div class="modal__content">
      <div>
        <p>本当にいいですか？</p>
        <tr></tr>
        <input name='check' type='checkbox'/>
        <tr></tr>
        <button type="button" class='tweetDelete' >削除</button>
        <a class="js-modal-close" href="">閉じる</a>
      </div>
    </div>
</div>