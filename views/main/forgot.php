<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Restore</title>
    <link rel="stylesheet" href="../../css/main.css">
    <!--	href="../../css/styles.css"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<?php require ROOT.'/footNhead/header.php';?>
<div id="main"  >

    <div id="main_about">
        <?php
        if(isset($msg))
            echo '<p>'.$msg.'</p>';
        ?>
        <form id="form_forgot" method="post" name="" action="#">
            <p class="textLogin">Enter email that you used in registration form</p>
            <input   type="email" class="email" name="fEmail" value="" placeholder="email">
            <input class="btn" type="submit" name="btnlogin" value="OK">
        </form>
    </div>
</div>
<?php require ROOT.'/footNhead/footer.php';?>
<script src="../../js/main.js"></script>
</body>
</html>