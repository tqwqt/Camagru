<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="../../css/main.css">
    <!--	href="../../css/styles.css"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<?php require ROOT.'/footNhead/header.php';?>
<div id="main"  >

    <div id="main_about">
<!--        <p>Cmagru - it`s a web-site, that allows you to make photo</p>-->
<!--        <p>by web-cam or download it.</p>-->
<!--        <p>Cmagru - it`s a web-site, that allows you to make photo</p>-->
<!--        <p>by web-cam or download it.</p>-->
<!--        <p>Cmagru - it`s a web-site, that allows you to make photo</p>-->
<!--        <p>by web-cam or download it.</p>-->
<!--        <p>Cmagru - it`s a web-site, that allows you to make photo</p>-->
<!--        <p>by web-cam or download it.</p>-->
        <?php if(isset($errors)):?>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li style="color: red">* <?php echo $error; ?></li>
                <?php endforeach;?>
            </ul>
        <?php endif;?>
        <form id="form_main" method="post" name="" action="#">
            <p class="textLogin">Login</p><input   class="input" name="login" value="" placeholder="login">
            <div class="textLogin" id="forgotPass"><p class="textLogin">Password</p> <a onclick="forgotPass()">Forgot password?</a></div><input class="input" name="password" type="password" value="" placeholder="password">
            <input class="btn" type="submit" name="btnlogin" value="Sign in" onclick="signIn()">
            <input class="btn" type="button" name="btnSignUp" value="Sign up" onclick="signUp()">
        </form>
    </div>
</div>
<?php require ROOT.'/footNhead/footer.php';?>
<script src="../../js/main.js"></script>
</body>
</html>
