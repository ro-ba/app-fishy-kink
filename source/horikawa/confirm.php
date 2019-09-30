
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
    <label>画像</label>
    <?php
        if (is_uploaded_file ($_FILES['image']['tmp_name']) ) {
            if (! file_exists ('image')) {
                mkdir('image');
            }
            $image_name = basename($_FILES['image']['name']);
            $image = 'image/' . $image_name;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $image )) {
                echo $image, 'のアップロードに成功しました。';
                echo '<p><img src="', $image, '"</p>';

                $image_info = getimagesize('image/'. $image_name);
                echo '<p>横幅：' . $image_info["0"] . ' 高さ：' . $image_info["1"]."</p>";
            } else {
                echo 'アップロードに失敗しました。';
            }
        } else {
            echo 'ファイルを選択してください。';
        }

    ?>


    <p>
        <a href="test.php">戻る</a>
    </p>

</body>
</html>
