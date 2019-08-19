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

        $width  = 400;
        $height = 400;

        $image =  $_FILES["image"]["tmp_name"];
        $image_name = basename($_FILES['image']['name']);

        list($orig_width, $orig_height, $type) = getimagesize($image);

        

        switch ($type) {
            case IMAGETYPE_JPEG:
              $orig_image = imagecreatefromjpeg($image);
              break;
            case IMAGETYPE_PNG:
              $orig_image = imagecretefrompng($image);
              break;
            case IMAGETYPE_GIF:
              $orig_image = imagecreatefromgif($image);
              break;
        }

        $canvas = imagecreatetruecolor($new_width, $new_height);
        imagecopyresampled($canvas, $orig_image, 0,0,0,0, $new_width, $new_height, $orig_width, $orig_height);

        switch ($type) {
            case IMAGETYPE_JPEG:
              imagejpeg($canvas, "image/resize_$image_name", 85);
              break;
            case IMAGETYPE_PNG:
              imagepng($canvas, "image/resize_$image_name", 85);
              break;
            case IMAGETYPE_GIF:
              imagegif($canvas, "image/resize_$image_name", 85);
              break;
          }

        imagedestroy($orig_image);
        imagedestroy($canvas);

    ?>

    <img src="image/resize_<?php echo $image_name ?>">
    <?php
        $image_info = getimagesize("image/resize_$image_name");
        echo '<p>横幅：' . $image_info["0"] . ' 高さ：' . $image_info["1"]."</p>";
    ?>

    <a href="form.php">戻る</a>

</body>
</html>
