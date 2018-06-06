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
    <div class="item">
        <div class="photo_list" id="p1" onclick="showFullImg(id)">
            <img  id="nata" src="../../resources/users_photo/natalie.jpg">
        </div>
        <div class="like_div">
            <!--<link rel="shortcut icon" href="/Camagru/resources/fzone.ico" type="image/png">-->
            <img class="like_img" src="../../resources/friendzone.png" id="like_id" onclick="likeImg(id)">
            <a href="">Comments </a>
        </div>
    </div>

    <div class="item"> Element - 2</div>
    <div class="item"> Element - 3</div>
    <div class="item"> Element - 4</div>
    <div class="item"> Element - 5</div>
    <div class="item"> Element - 6</div>

    </div>
<?php require ROOT.'/footNhead/footer.php';?>
<script src="../../js/scripts.js"></script>
</body>
</html>

