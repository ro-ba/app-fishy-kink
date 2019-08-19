<?php

  class ResizeImage {

    function resizeImage($file, $file_name, $resize_width, $resize_height) {
      //GDライブラリがインストールされているか
      if (!extension_loaded('gd')) {
        throw new RuntimeException('GDライブラリがインストールされていません。');
      }

      // imageフォルダが無ければ作り、画像をそこに格納
      if (! file_exists ('image')) {
        mkdir('image');
      }

      // 画像情報取得
      list($orig_width, $orig_height, $image_type) = getimagesize($file);

      echo "<p>前　　横幅： $orig_width 高さ: $orig_height</p>";

      // 画像をコピー
      switch ($image_type) {
        // 1:gif, 2:jpeg, 3:png
        case 1: $orig_image = imagecreatefromgif($file);  break;
        case 2: $orig_image = imagecreatefromjpeg($file); break;
        case 3: $orig_image = imagecreatefrompng($file);  break;
        default: throw new RuntimeException("サポートしていない画像形式です: $image_type");
      }

      $x = 0;
      $y = 0;

      fitCover($orig_width, $orig_height, $x, $y);

      //　コピー先となる空の画像作成
      $canvas = imagecreatetruecolor($resize_width, $resize_height);

      // コピー画像を指定サイズで作成
      imagecopyresampled($canvas, $orig_image, 0,0,$x,$y, $resize_width, $resize_height, $orig_width, $orig_height);

      switch ($image_type) {
        // 1:gif, 2:jpeg, 3:png
        case 1: imagegif($canvas,  "image/resize_$file_name");     break;
        case 2: imagejpeg($canvas, "image/resize_$file_name", 85); break;
        case 3: imagepng($canvas,  "image/resize_$file_name");     break;
      }

      // 不要になった画像データ削除
      imagedestroy($canvas);
      imagedestroy($orig_image);
    }

    function fitCover(&$orig_width, &$orig_height, &$x, &$y) {
      if ($orig_width > $orig_height) {
         $x = floor(($orig_width - $orig_height) / 2);
         return $orig_width = $orig_height;
      } else {
         $y = floor(($orig_height - $orig_width) / 2);
         return $orig_height = $orig_width;
      }
    }

    //https://sukohi.blogspot.com/2016/04/phpintervention.html
    //http://note.onichannn.net/archives/3265
  }
?>
