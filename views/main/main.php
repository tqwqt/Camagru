<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="../../css/main.css">
    <!--	href="../../css/styles.css"> -->
</head>

<body>
<?php require ROOT.'/footNhead/header.php';?>
<div id="main"  >

    <div id="main_about">
        <p>Cmagru - it`s a web-site, that allows you to make photo</p>
        <p>by web-cam or download it.</p>
        <p>Cmagru - it`s a web-site, that allows you to make photo</p>
        <p>by web-cam or download it.</p>
        <p>Cmagru - it`s a web-site, that allows you to make photo</p>
        <p>by web-cam or download it.</p>
        <p>Cmagru - it`s a web-site, that allows you to make photo</p>
        <p>by web-cam or download it.</p>
        <?php if(isset($errors)):?>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li style="color: red">* <?php echo $error; ?></li>
                <?php endforeach;?>
            </ul>
        <?php endif;?>
        <form id="form_main" method="post" name="" action="#">
           Login<br><input  name="login" value="" placeholder="login">
           Password<br><input name="password" type="password" value="" placeholder="password">
           Repeat password<br><input type="password" name="repeat_password" placeholder="repeat password">
           Email<br><input type="email" name="email" placeholder="email">
            <input class="btn" type="submit" name="submitReg" value="OK">
        </form>
    </div>
</div>
<?php require ROOT.'/footNhead/footer.php';?>
<script src="../../js/main.js"></script>
</body>
</html>