<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Change password</title>
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
            <p class="textLogin">Enter new password</p><input class="input" name="password" type="password" value="" placeholder="password">
            <input class="btn" type="submit" name="submitChange" value="OK">
            <?php
              if (isset($ok) && $ok === true) {
                  echo '<p class="textLogin">Password been changed successfully! </p>';
                  unset($_POST);
                  unset($_GET);
                  header('Refresh: 3; URL=http://localhost:8101/main');
              }
              ?>
        </form>
    </div>
</div>
<?php require ROOT.'/footNhead/footer.php';?>
<script src="../../js/main.js"></script>
</body>
</html>