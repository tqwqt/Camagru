<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/cabinet.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--	href="../../css/styles.css"> -->
</head>

<body>
<?php require ROOT.'/footNhead/header.php';?>
<div id="main"  >

    <div>
        <p>Hello, <?php
        echo $userLogin;
            ?>!</p>
    </div>
    <div id="notif">
        <p>Email notifications:</p>
        <label class="switch" onclick="setNotifications()">
            <input class="box" type="checkbox"
            <?php
            if (!isset($_SESSION))
                session_start();
            if ($_SESSION['userNS'] === '1')
                echo 'checked';?>
                />
            <div class="switch-btn"></div>
        </label>
    </div>
    <div class="cabiBtns"><p>Change password</p></div>
    <div class="cabiBtns"><p>Change username</p></div>
    <div class="cabiBtns"><p>Change email</p></div>


</div>
<?php require ROOT.'/footNhead/footer.php';?>
<script src="../../js/main.js"></script>
<script src="../../js/like.js"></script>
</body>
</html>