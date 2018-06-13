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

    <form method="get">
    <div id="main_about">
        <?php
        if (!isset($_GET) || !isset($_GET['token']) || !isset($_GET['login']))
        {
            echo '<p>Something went wrong! Please, try again.</p>';
            die();
        }
        $token = $_GET['token'];
        $login = $_GET['login'];
        $main = new Main();
        $tokenRes = $main->checkToken($login, $token);
        if ($tokenRes === true && $main->confirmUser($login) === true)
        {

            echo '<p>Registration success!</p>';
        }
        elseif ($tokenRes === 'registered')
        {
            echo '<p>You already confirm your account!</p>';
        }
        else
        {
            echo '<p>Something went wrong! Please, try again.</p>';
        }
        header('Refresh: 5; URL=http://localhost:8101/main');
        ?>

    </div>
    </form>
</div>
<?php require ROOT.'/footNhead/footer.php';?>
<script src="../../js/main.js"></script>
</body>
</html>