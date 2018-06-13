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

        if ($dbhash !== false && $dbhash['token'] !== 'registered')
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
    }
    public static function checkLogged()
    {
        session_start();
        if (isset($_SESSION['userLogin']))
        {
            return $_SESSION['userLogin'];
        }
        header('Location: /main');
        return false;
    }
}