<?php

class User
{
    public static function validateLogin($login)
    {
        $len = strlen($login);
        if ($len <= 5 || $len > 15)
        {
            return 'Your login must be longer than 5 and less than 16 letters!';
        }
        if (preg_match('/^\w{5,15}$/', $login) !== 1)
        {
            return 'Allowed characters: a-z A-Z 0-9 and \'_\'';
        }
        return true;
    }
    public static function validatePassword($password, $repeat)
    {
        $len = strlen($password);
        if ($len <= 7 || $len > 20)
        {
            return 'Your password must be longer than 8 and less than 21 letters!';
        }
        if ($password !== $repeat)
        {
            return 'Passwords do not match!';
        }
        return true;
    }
    public static function isLoginExist($login)
    {
        $db = DbCamagru::getConnection();
        $query = 'SELECT * FROM user WHERE login = :login';

        $res = $db->prepare($query);
        $res->bindParam(':login', $login, PDO::PARAM_STR);
        $res->execute();
        $dblogin = $res->fetch(2);
        if ($login === $dblogin['login'])
        {
            return true;
        }
        return false;
    }
    public static function checkPassworLogin($login, $passowrd)
    {
        $db = DbCamagru::getConnection();
        $query = 'SELECT * FROM user WHERE login = :login';

        $res = $db->prepare($query);
        $res->bindParam(':login', $login, PDO::PARAM_STR);
        $res->execute();
        $dbhash = $res->fetch(2);

        if ($dbhash !== false && $dbhash['verified'] !== '1')
        {
            return 'unconfirmed';
        }
        if (password_verify($passowrd, $dbhash['password']) === true)
        {
            return $dbhash;
        }
        return false;
    }
    public static function signIn($userinfo)
    {
        session_start();
        $_SESSION['userLogin'] = $userinfo['login'];
        $_SESSION['userId'] = $userinfo['id'];
        $_SESSION['userEmail'] = $userinfo['email'];
        $_SESSION['userNS'] = $userinfo['notifications'];
    }
    public static function checkLogged()
    {
        if (!isset($_SESSION))
            session_start();
        if (isset($_SESSION['userLogin'])) {
        return $_SESSION['userLogin'];
        }
//        #88f5dd
        return false;
    }
    public static function islikedPhoto($myId, $photoId)
    {
        $db = DbCamagru::getConnection();
        $query = 'SELECT * FROM user_liked_photo WHERE user_id = :myId AND photo_id = :photoId';

        $res = $db->prepare($query);
        $res->bindParam(':myId', $myId, PDO::PARAM_INT);
        $res->bindParam(':photoId', $photoId, PDO::PARAM_INT);
        $res->execute();
        return $res->fetch(2);
    }

    public static function checkNotificationsStatus()
    {
        $db = DbCamagru::getConnection();

        if (!isset($_SESSION, $_SESSION['userId']))
            session_start();
        $uid = $_SESSION['userId'];
        $query = 'SELECT * FROM user WHERE id = :uid';
        $res = $db->prepare($query);
        $res->bindParam(':uid', $uid, PDO::PARAM_INT);
        $res->execute();
        $res =  $res->fetch(2);
        if ($res['notifications'] === '1')
            return true;
        else
            return false;

    }
}