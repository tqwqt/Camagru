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
<?php require ROOT.'/footNhead/header.php'; ?>

<div id="main"  >

    <div>
        <h2>Hello, <?php
        echo $userLogin;
            ?>!</h2>
    </div>
    <div class="cabiBtns">
        <p>Current email: <?php
            if (!isset($_SESSION))
                session_start();
            echo $_SESSION['userEmail'];
            ?> </p>
    </div>

    <div id="notif">
        <p>Email notifications:</p>
        <label class="switch">
            <input id="chb" class="box" type="checkbox"
            <?php
            if (!isset($_SESSION))
                session_start();
            if ($_SESSION['userNS'] === 1 || $_SESSION['userNS'] === '1')
                echo 'checked';?>
                onchange="setNotifications()"/>
            <div class="switch-btn"></div>
        </label>
    </div>
    <div class="cabiBtns" onclick="changePassword()"><p>Change password</p></div>
    <div class="cabiBtns" onclick="changeLogin()"><p>Change username</p></div>
    <div class="cabiBtns" onclick="changeEmail()"><p>Change email</p></div>


</div>
<?php require ROOT.'/footNhead/footer.php';?>
<script src="../../js/main.js"></script>
<script src="../../js/like.js"></script>
</body>
</html>