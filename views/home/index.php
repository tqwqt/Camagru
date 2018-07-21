<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Home</title>
	<link rel="stylesheet" href="../../css/styles.css"> <!--	href="../../css/styles.css"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<?php require ROOT.'/footNhead/header.php';?>
    <div class="cont"  >
        <?php foreach ($photoList as $item):?>
        <div class="item">
            <div class="photo_list" id=<?php echo 'p' . $item['id'];?> ><!--onclick="showFullImg(id)">-->
                <img  class="photo" src="../../<?php echo $item['url'];?>">
            </div>
            <div class="like_div">
                <!--<link rel="shortcut icon" href="/Camagru/resources/fzone.ico" type="image/png">-->
                <div class="commentPrevBlock" ><img src="../../resources/chat.svg" class="commentImg" id="<?php echo 'comm_'.$item['id'];?>" onclick="showComments(id, login = <?php echo '\''.$this->userLogin.'\''; ?>)"></div>
                <img class="like_img" src="<?php
               // if ($this->isLogged)
              //  {
                    if (isset($_SESSION['userId']))
                    {
                        $userId = $_SESSION['userId'];
                        $tmp = User::islikedPhoto($userId, $item['id']);
                    }
                    if (isset($tmp) && $tmp !== false)
                    {
                        echo '../resources/lkd.svg';
                    }
                    else
                    {
                        echo '../resources/camalike.svg';
                    }
              //  }

                ?>" id="like_<?php echo $item['id'];?>" onclick="likeImg(id, <?php echo $home->getLikesCount($item['id']);?>)">
                <p><?php echo $item['likes'];?></p>
            </div>
            <div class="commentsBlock">
                <textarea class="commentArea" id="<?php echo 'ta'.$item['id'];?>" placeholder="Type comment..." style="display: none"></textarea>
                <button class="commentBtn" id="<?php echo 'btnc_'.$item['id'];?>" style="display: none" onclick="sendComment(id, login = <?php echo '\''.$this->userLogin.'\''; ?>)">Send</button>
            </div>
        </div>
        <?php endforeach;?>

    </div>
<?php require ROOT.'/footNhead/footer.php';?>
<script src="../../js/scripts.js"></script>
<script src="../../js/main.js"></script>
<script src="../../js/like.js"></script>
</body>
</html>

