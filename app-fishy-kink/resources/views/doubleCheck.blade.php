<!DOCTYPE html>
<HTML>
<HEAD>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <TITLE>Double Check</Title>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/check.css">
    <link rel="shortcut icon" href="">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</HEAD>

<BODY onUnload="opener.location.href='/profile';">
<!-- <BODY> -->
    <!-- <form action='doubleCheck' class='doubleCheck' enctype='multipart/form-data' onsubmit='closeSelf()' method='post'> -->
    <form action='doubleCheck' class='doubleCheck' enctype='multipart/form-data' method='post'>
    @csrf
        <div>
            <p>本当にいいですか？</p>
            <tr></tr>
            <input name='check' type='checkbox'/>
            <input type='submit' value='削除'/>
        </div>
    </form>
</BODY>
</HTML>

<script type="text/javascript">
    function closeSelf(){
        self.close();
        return true;
    }
</script>