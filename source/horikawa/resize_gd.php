<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title></title>
<meta charset="utf-8">
<meta name="description" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="">
<link rel="shortcut icon" href="">
</head>
<body>

    <p>リサイズ画像</p>
    <?php

        require_once "./resize_gd.php";

        $file = $_FILES["image"]["tmp_name"];
        $file_name = basename($_FILES["image"]["name"]);


        

    ?>

    <img src="image/resize_<?php echo $file_name ?>">
    <?php
        $image_info = getimagesize("image/resize_$file_name");
        echo '<p>後　　横幅：' . $image_info["0"] . ' 高さ：' . $image_info["1"]."</p>";
    ?>

    <p>
        <a href="form.php">戻る</a>
    </p>

</body>
</html>