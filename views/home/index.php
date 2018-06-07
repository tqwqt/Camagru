<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Home</title>
	<link rel="stylesheet" href="../../css/styles.css"> <!--	href="../../css/styles.css"> -->
</head>

<body>
<?php require ROOT.'/footNhead/header.php';?>
    <div class="cont"  >
        <?php foreach ($photoList as $item):?>
        <div class="item">
            <div class="photo_list" id=<?php echo 'p' . $item['id'];?> onclick="showFullImg(id)">
                <img  id="nata" src="../../<?php echo $item['url'];?>">
            </div>
            <div class="like_div">
                <!--<link rel="shortcut icon" href="/Camagru/resources/fzone.ico" type="image/png">-->
                <img class="like_img" src="../../resources/friendzone.png" id="like_id" onclick="likeImg(id)">
                <p>23</p>
                <a href="">Comments </a>
            </div>
        </div>
        <?php endforeach;?>

    </div>
<?php require ROOT.'/footNhead/footer.php';?>
<script src="../../js/scripts.js"></script>
</body>
</html>

