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
        <?php if(isset($errors)):?>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li style="color: red">* <?php echo $error; ?></li>
                <?php endforeach;?>
            </ul>
        <?php endif;?>
        <form id="form_main" method="post" name="" action="#">
            <p class="textLogin">Login</p><input   class="input" name="login" value="" placeholder="login">
            <p class="textLogin">Password</p><input class="input" name="password" type="password" value="" placeholder="password">
            <p class="textLogin">Repeat password</p><input class="input" type="password" name="repeat_password" placeholder="repeat password">
            <p class="textLogin">Email</p><input type="email" class="input" name="email" placeholder="email">
            <input class="btn" type="submit" name="submitReg" value="OK">
        </form>
    </div>
</div>
<?php require ROOT.'/footNhead/footer.php';?>
<script src="../../js/main.js"></script>
</body>
</html>