
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>home</title>
<meta charset="utf-8">
<meta name="description" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="">
<link rel="shortcut icon" href="">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="font/css/open-iconic-bootstrap.css">
</head>
<body>
    <div id="menu row d-inline col-md-12"> 
        <button type="button" class="link_button btn page-link text-dark d-inline-block" onclick="location.href='/home'">home</button>
        <button type="button" class="link_button btn page-link text-dark d-inline-block"  onclick="location.href='/notify'">通知</button>
        <button type="button" class="link_button btn page-link text-dark d-inline-block"  onclick="location.href='/DM'">メッセージ</button>
        <button type="button" class="link_button btn page-link text-dark d-inline-block"  onclick="location.href='/story'">ストーリー</button>
        <input type="image" class="link_button btn page-link text-dark d-inline-block" onclick="location.href='/myPage'"
        src="{{ $userIcon }}" height="40" width="40" class="img-thumbnail"
        style="width: auto; padding:0; margin:0; background:none; border:0; font-size:0; line-height:0; overflow:visible; cursor:pointer;"
        >
        </button>
        <button type="button" class="btn btn-default"> <font color="red"> <span class="oi oi-magnifying-glass"></span> 検索 </font></button>

        <form method='get' action="/search" class="form-inline d-inline" >
            <!-- <div class="form-group"> -->
                <input class="form-control" type=text name="searchString">
                <input class="form-control" type=submit value="検索">
            <!-- </div> -->
        </form>
        <button type="button" class="link_button btn page-link text-dark d-inline-block" target=”_blank” onclick='open1()' onclick="location.href='/tweet'">ツイート</button>
        
        <script type="text/javascript">
            function open1() {
            window.open("/tweet", "hoge", 'width=200, height=200');
        }
        </script>
        
        <button type="button" class="link_button btn page-link text-dark d-inline-block" onclick="location.href='/logout'">ログアウト</button>
    </div>
    
    <div class="row">
        <div id="leftContents" class="col-sm-3"></div>
        <div id="centerContents" class="col-sm-6">
            <div class="tweet card">
            @foreach ($tweets as $tweet)
                <div class="tweetTop card-header">
                @if ($tweet["type"] == "retweet")
                    <div class="retweet-user">{{ $tweet["userID"] }}さんがリツイートしました</div>

                @endif
                <div class="tweet-user"> {{ $tweet["userID"] }} </div>
                <div class="time"> {{ $tweet["time"] }}</div>
                        <!-- <div class="date">{{ explode(" ",$tweet["time"])[0] }}</div> 　
                        <div class="time">{{ explode(" ",$tweet["time"])[1] }}</div> -->
                </div>
                <div class="tweetMain card-body">
                    {{ $tweet["text"] }}
                    
                </div>

                <?php
                        $data = connect_mongo();
                        $tweetImg   = $data["tweetDB"] -> findOne(array("userID" => session("userID")));
                        
                        print_r($tweetImg["img"]);

                ?>

                <div style="float:left"> 
                <!-- <img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxMTEhUSExIVFhUXFRUVFRUVFRUXFRcVFRUWFhUVFRUYHSggGBolGxUVITEhJSkrLi4uGB8zODMtNygtLisBCgoKDg0OFxAQFy0dFx0tLSstLS0tLS0tLS0tLS0tLS0tLS0tLSstLS0tLS0tLTctLS0tLS0rLS0rLSstKy0tK//AABEIAKgBLAMBIgACEQEDEQH/xAAbAAACAwEBAQAAAAAAAAAAAAADBAIFBgABB
                            //EADoQAAEDAwIEAwcDAwQBBQAAAAEAAhEDITEEQQUSUWFxgZEGEyKhscHwMtHxFELhByNScsIVJENigv/EABgBAQEBAQEAAAAAAAAAAAAAAAABAgME/8QAHREBAQEBAAIDAQAAAAAAAAAAAAERAiExEhNBA//aAAwDAQACEQMRAD8AFU0JlRGnIVs94KWrFZMI+7UjplKbpqLJEK0oCsKTwkvdXTLG2WiJ1NQlnVZUKwQwrEo/vUF70IgyhvEIiVXqhuevCogKj3mKlTeZXFqJp6RcYCoYoEkq
                            1pvEQg6fg1RGr8OeBlZvSuNcBNaUOeYAMddlHhXBj+uqYEWHjglWjtS0CBgdLedlL01zzqTOGz+qpHW30RxoKLbkud4n9kidUTkpyiZvPqprf1wdtGjs2PzuisDOn7IRgpDUuc03NlPkvwi6LOiVq2SOn1rozPf+U9T1YdZwzva37halYvGAVHWVXrHFWetpFvcHBVZXKiA0Co6urC8bWCHqhIVQEagIoeCFR6yoW4QaGucmo0HvgFCnUBMqoFQlNUJU1Wk09QQisfBVA3UEJ/T15Sh7U1VOlVskq
                            7l1FxU1cS1YJSRpFWtihOppCxnaNREeZSTKiOKoTDUwxFYFBr1Ok6DdAOrSMqbEzUIhIVNUFRGuVGm1S5XG8L2mx04V1lxpoT6LjgK70OjBuQrpujYBhTVxjBoHkYUGaNwNwthVa0JXkBKupijZw8nsm9HoOQyrZrAvKjuyLgtLVgCE7omh0vcLD6qtpMHRPcXdy020xgiTGdlZ5Cet1snlG9vnF+ig6oAI/U4WtgeZyV2j04yR3Ep12oawTZTG5cIM0hy7ZMf1PKOyUr8SnJgehSGr14xv49Vz6rt
                            yuhr+v51Rf6lrgLSMGVlWcQE53IPU/wCEyNXvbPn+YWZ7XfC9/ogSCy3h675Cn7pwubfLBwqSlxYWjzlWtPXcwiRbcfQyusjjattBXbUbyuIINp7jxwq/X6MtJHp4LynqwHc0QRY7FaCoxtakHC/wyMbbZW7P1z1htXRIwl21Tgq/rUeqpdfTjC5qqda2ULT6dNFspqhRTAGlp09Sowi02BekoF69EFS0lrKZcosymhyUTZeMZZBc+EVIVIK8q6sTlQc4G6otZqTzFVLTdPhq8qaGEeprChHVHdQ8JU
                            mBqBqavdQeSSiM0qATSSiM0oTlKhC9c1XYSJ0QAF5SiVFrFxapq/E+7URhet1ZO6ri0lNUmQEMSqPXgcgVAVzHIGqdVEAleaaknIAQR09G4S3tPxNrakDYC+2bj6qz0sE5iBIWT1XDHO1J5nN5SOcztf8Awfkt8s1Y6Ku98uxJkk2AHQBD1lQXyY32nxwrPTtaW4+GIAPTqZyur06RF4NxAtjyyrYSsdqNY6+0YvPkq+rUcTa+JyttW02lm4E95/dNUXaVon3dOw6CTvGVn67WvsfP6banN+gmxP55Ao
                            lSlWJg2k3mD6L6FS4po2w+GAEABzQ0n5+aMNbpnwW1Gf8A7byjzKfWfN8+0lJ+3hjyVpp6z2wHTY9L+q1LqbAJHI6d2FjhB7BLjS0cgEGdjbG4xF1qSxNIsaHCRJMevS/qr72b1cU7yAHxy5PxZGPBVZZ7shzcf3DbxHZW+g07Wy8fpcJETsqyJxvTBpJFwb+CzOqoytnSPvaZZkjBNis9WorFnlVGNPCMxsJ73SE+igX5l6uey69LVFCATFGldDpNunAERN5gKq1NW6c1VYALOanW/EhpuvrYCz2p1RLi
                            UxqahKV9wtMWtqKDYwlK9Loj1yV2nZK5a7BUaaa5F6KSPy2U1cAUHIjwhkKo5rVF5UihTdDTNNim58L2lhL6mVRNxlCLYU6ClqFUdQ1EJg1SVV0hdWVIJA9oX5B6ZVXxioecCx+Hpfw+XzVpoKYLu0Ss3xOoS50D9TpPgMAdMrpyxQOKcd922AbtAv3++FiNZ7W1uYnm69I9UX2grGSNys+dG6Jj88FRbVfa+s4QY9MpWvxyo4zMdhiyXbpibHpbFz0zhR/oXdN4/gptBBxB8ZP5/KZ03tC+n+nO5dcpVmi
                            eWiAd/l2XHhb+mPL0TyLCp7UagtgfCOrWgJrg/tLV5gHPtiTE38VV0tDUNogbCQZ62BMKOp0TqZBj7/RNo+oaHiz32/U2AZ/u9FqvZbVB00icH4Zibi/zhfOPZqoTEeJjPe/VbDhVNzKgcALnIE7oNXo3GnVg95mN/wCEHjmlDTzD9LvqmNa0yH7EfMdEbUj3unIP6hcbkKUZUuuvRdQLESmwrKoupKBYmHJUvuoteFiHXqQjEoddllUUHE9UVUBs3Ks+IZVfWsrIzalSYjikoadu6kXq0i/c4HCc0rBCq9
                            IZVtRC4usMCmuqU4TOmpqeopqKqCLoVVqdfTS9RqsQuFENuiGyiy5VDmnYjP00r3TBPsAhVFFUplpU6bZTOtp3QaaIiaIRmsXAJhjJRU9OYa8xNukrJ16sujflxiM+q2p0/wDsvMbdYhYTWAh0X6eW/llbnpms1xKj8cwSJn86olVjHgRbaR17o+vBzuDbOOirauo5RbO46D7hajJhvDOUybzewz+6tqeiDmy6zWj4QMkx9cInCdQatPlAbM7CP5Wp0fBQxo3Jn9Q9YC3IlUmn4axtGkSyD8UmLfHOTtsqvWcOc13/ACbAj5iCdlvKWka9rQLd8eip+K8OdTeHj9PbZLEY+voXA/q5fAfsoVGU+WJvu45PzR+L8RmryCOUW5seP8JRzeazb3uQMHx6rLSy9mjyERZo7iVv+GPmLbwOqwGip8swAT548fGFqOE13/CJPr9D1ystRt6zv9toOQTjITGkoh7C2Rf5evglq1E/07HtyIk/ddw6ufRBS6igWPLXWIU2gQrn2h0wfT983LbHwW
                            cbXWaJV0pyoj6klGZSlQCFNVvEaxCvWU1XcU04hUZHU1SLpJ1bmMK011CyqqdGCtxhahsNSfifkU810hKVKd1mtNDRZCepOQAExRYuVdVnpHqdd6hpmL2u1ArUS9Qpw0rKvr2QCcJU6dNesajOEBaQRjkanWSUqBqwiHa11FlJCoV5VlSZKqFy2FOmiVaJCCSoq11kDTGN/XuvnfEnXJsdt8d/VbviY/8Abg4gHyWC4iQZdECAB1wLnzn0XSMqvVEiLZGdhYWBVTxGgAJz9Vd1XSzNwTnAJsIjw+SBo9Cajr2beev891Yi1/070vM17x+qDHlhZPj+q1ja5e57wQ4xBI5YP8LWCudNWp1KY5WwGubsWyYWzY3S6hoc5jHEjstZrL5pxL2t1btPSpgBjqjS41Gj4ntDi2/S4v1Vl/p4zUP521XF1ItvzTY9luW8G0ry2WsIY3laIFgDP1JS3GOIMoUy2iGzEACM+Cufpr51xjSH37mxgm/WCf2RaVKBytyQQRG8FXQ0ssHNepBJP/2NyPB
                            I06Nx1wfnefzCzWoHpR1OBNvn5YWi4aOWJ2GZEePpdUlFl5BztJBFtx6K60Tv0g/pgZi89fL7rNV9E0ttNc/2nbaSqbhuo9dpjzwUy/VNbp7ESB6qs09YiCCC2Phx5iUGpby1GFjhY5hVWq9nYuwyNgjaXVXjlV1RfKgwVWgWOhwgo1N60nGeH+8bzBo5uoznCyrZDoNiMoixphV3FMKzoYVdxYWQrM61wAWfqV7p/ita8Ktp0JMq2srHQu5kzVpGUThOmTVeldZrcXFKin6NIKTAFF7+i5OhhroUilGPUjUVDD4hU+puU5Xq2VcXXQTYiG6HzI9Apok2hZCdQVgHiEtWeGiSbdlqM0Gjpmi7jb83TX/qAAIZ4RMyqevrg8wMC5yB5+mFJ2oYIiZO9vpuus5xi08Ne8vA5jI6JqhqRI5jzZ6ZPgs9V1ZFwZ6yII7KNDWknP2HyQbesWPpObI/SvmeufcDAAMT9XemVqtDqCLn9gsv7Qth9sOE42JNvHKWEVtaoG2ABzI6kgn91z+IinTaBkknywEr78Ez0vP3SOue0gyHGYAcDHLEk23mVNUarrXVMntc95mfNOaPWhkf7wbHQrNvrUxgPI7uifTxUGa1rf8A4WH/ALcx+6So3VLjIItWE/8AaEhX1Di6ecO8HT69Ss2OKtIg6aj5NIPqCvKeoonLajP+ruYejrq6Y1TOJmbyCPyybquuSN4NjtH+SsiHiwbVc68AcoBvsTsFdaRxhoNj/MKaRdUiLCJIIINxFrfRP0aUuAJ+0nPr+yrdEBgmQBjvkhNnUta2ebAwcwMSNs57oqy4nrjVqNpNgBga4m0CW4Iwf2TXDGubLn1GdeUWEjYWhZnhtM85qvfEyCD5/DCsanEC4EAWzfEdVUarTa7fmG8RbvYR3yjaf2pAgEE7SAdvBY064kRYmIv4Ra8omkdzH4gZbEQcACBI3QfTaOua8T+eniqDjGkPvOcRe5hVL9Y4ND2mIFxeY2tuPpdG0vGzEPaTPcz2EdUwP6dI8ZHwlOaKs15MfcnzBS3GBAKzmDAa6mS5EoUE6aQLkctDVakPcK01kavSEpXSa8CyO/USZWGzJ1Km1yRp5T7CIXNtJj1N7kmXXRwFFB1NRKcyPqEINWsR6HJmi5L08pyjRUHj6sKpr68lxv2Hj26W3THHNT7sRnE5Ef5WZ1OttLSTkX2noF34njXPqn9TrcAYFs3JHU7+KDR1Bd8UxtcZ7yqYPv59/GxTfvxHKN/GB5rTJirqJMA2nMZNsTjCaoagAC/jHzKqnuHXe6k18IrQGoXwJMTPl+Qqviupa8FthAsT1yQh1eKBrO8ET44Wb4nrrq0SrVQCfAntJH7pZtUOlp8R08FzavNfeB6pPUggybdFhUX087rwUivP6hee/wDt90QVrZtA3+Sh7v0UKVWL+KJS1GBn+IVD+gp8oLzt+WTlCrL2m1
                            iPz0VSNQTbZN6eoGgHeYt16/VRWl01QAXH/ImdgP3sPNEJk3AMxAE+IA7qm4fzFsm3Wcx2P2Rn6g2jAJ+aqLZjrSTABk3tMmLTfCi3VN9RiCBIuLpBrp+EiwnMT+ZXlWuAIEQYvvIP0lBa6fWOmAAZzb4fHKbGoduQTkwIi+Cd1nKOrAHWCZicKw02tB3FsA9D3nCo0VDVNLTJmepHTPbwQGHl+KIkiIIv64VHp9dJi++T03HREfqhOSD2O/cbbeKC9paoggtZEdzI6X+6udPrBVa4E36flvJZjQvc4ZntHyBCsKdcU4kRJme33GR5IhfVMDXQMi7om/29ECoZVpxeHczhy3b8JIMmM/EM+BWafrfwLn1WoMWQif1PdVOo16Qqa++VkbrnRW1ivatIIMws42aovunmOBCpw9PaerZSxRKtNK1aZ2TZcjUqYKCpYCCrPSVoaXHYeXhK81FIJXVPDaZBvIm35la5m1LcUfFq5Jc42EzJdPq1Z6vbe5wAPD98priT+ZxnYjF4tuTKqy6SSTi
                            /bew6r0OQtI99sdB1RPfwbWjr9ko18E4HXwQPfb7Xt5rKrB1cmALk/LxTTGR5A7b4juqqi+BN7wc7Iup1piB8u4QC1L4mbjb881V6o3Fo/N07UIP5j8ukal/NBOld0bWVjq2NIgjFpSmkpx
                            dMVnbBBUVtE4GyUIIlaBxsSdhCo6lQz5qUDEr1jSurambAAIIqlQWdBsEE2nrhNaJjnP5hYd8fmVSms50Dpj88loNEORoaD3Pj0n8wrA8Xz1Db28F6x/wkx
                            1A7z9rINEgmR2APbwTdJ0AgWtmB0/wVQs3U5t4ntJuPko06sS6LfuMIBdF2mLHzEjClTrt6EQbxjEY+4QFdUAu22Da4g5kI2ndJsdt//E/ZKsMdxuQT4XEe
                            KLRa4tPJHMDYGB9TcKhtpIGQIveJA8ft4KQeczcZbyn1lKtMHByRE2BM28MpmjWwC34Qbdp6KC/4K48v6cZOBjPZecZqNtBxtc38cIejqHlEAEb59DEpLiD
                            w3mDs2Jx1gwcd0Gn4VqxWpEGGuAIs1p2uADhY3iNUgkOEOB6BttpC0/sfUa9xbu5sN+H4T2PQ4ys/7a0DSqkEAYxELPcFFWqpclQc6VILI+vVqaW9zJVkTK
                            G6msa6knade0mp0sQCIKCbGp2iEvQCamFACuqri4sARAiSbEdhG5Ktn3VF7U17A9BFtzawC6ce2e/TLvPxFuABvFu97FVjxyyfEAY6Rb7dk7X1RHMO94gnH
                            X5KpeC4kuMEmACdh1XVzQ5rR/cck7SDKHta2BPW+66q/I3Bzi8qT4i2/wDjHmoonPt0MeqgDn5d0Lm/PDK5jvz0QSZi/VSFPEeZ8161wP50RqQtPS37oPaR
                            yOsfJSB3XnZRaZMeqCGtdDI6qirm6uda+VUVG3KUKwuhGLVwaoD6Ch8UnA+qt2VSBa02P55Jbh1EeNr/AF/ZHYMSbCN/zuqDUcRB8e26nqiYaZi2fD+Pmhe
                            +JPLcDmkTtgI9c8wbYWm4zcbgbfugFUYJDSYxHzv4X+iGA7sDImcdQRfsi1Hgklwvt4qEwQTm5EjLYvPggbp03EDbJ5oB+E5B8UJj+UBsEEgAOwQfyyCK3K
                            LAjaNm7yOy5tQlsXLRMbmN5PVUNOfkum3SIM2O2bBOacE3YTfI+xHXKTp0Ty/8mxBbInsROya4bUM/Diwk5Hn8vNRFvSomLEAG5t9dwk9eWlpzbIBzfbcKN
                            TWubN79tj64Q20TN+a9wRftN/1b2RVr7NnleHXAmSCO/wAMHsr3/Uzg3vKLdQxwaDAqWMEgWJjfv5Kl4M6LSHcsEXgjra04X0XhFZtamab/AImuBEEDyslm
                            xHwRtOEWnRacvaOxn1sFd+1PCjQrvpw3qCHE2OM5VJyrlWo+quqQvRqJXLlitxNlRQqtXLlIr2k+EyHyvFyKnSbcLNe1UiTaxg9upHWFy5df5sdsdrCSYBA
                            tJ9AfoQktOwTN7Gb7xv8AdcuXRgNrQZJOLm1usT1yoOMgbE38tly5BFm5E4wfEfuuYfp81y5UcXXA/OsK0pacwL9/NcuSAjtH1JQq1IMHcrlyVFTqHJJxXL
                            lFeNbKLSoXC9XILYMgfCI2M5t38VKhTAbbJmcbmZH5uuXIJVACSRdu8b7/AGXjHYa8WmJiLA3BPhlerlQPXUzfaOmLmBB+aCW80AG/9s7kC4nuFy5QFo1QQ6Wn
                            mAM39ZHa6X07QCcjuLm/2XLkRYaN+TIPLcDqAfi8olH5S27SMSSNx0PQrlyKm6m6zwe/NAjO47orGkgcr
                            ryHR+097rlyDQ8J08czx+oCHAbzcW8lrOG1/dNMu3m46mQZ+XovVyID7e6D+p07atMEkdhEbmSvlzdN1C5cuffimv/Z"
                            width="200" height="100" /> -->

                        </div>
                    <!-- </div> -->
                    <!-- <image src="images/イニエスタ.jpg"/> -->

                <div class="tweetBottom d-inline">
                    <div class="reply d-inline-block">
                        <image src="images/reply.jpg"/>
                    </div>
                    <div class="retweet d-inline-block">
                        <image src="images/retweet.png"/>
                    </div>
                    <div class="fab d-inline-block">
                        <image src="images/fabo.jpg"/>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
        <div id="rightContents" class="col-sm-3"></div>
</body>
<img class="" height="100" width="100" 
        src="images/twitter.jpg"
        />
</html>
</html>
