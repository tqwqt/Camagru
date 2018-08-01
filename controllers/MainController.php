<?php
/**
 * Created by PhpStorm.
 * User: vhavryle
 * Date: 6/8/18
 * Time: 2:34 PM
 */
include_once ROOT. '/models/Main.php';

class MainController
{
    public function actionRegister()
   {
       $login = '';
       $email = '';
       $password = '';
       $repass = '';
        if (isset($_POST['submitReg']))
        {
            $login = $_POST['login'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $repeat = $_POST['repeat_password'];
            $main = new Main();
            $loginValidate = User::validateLogin($login);
            $passwordValidate = User::validatePassword($password, $repeat);
            if ($loginValidate !== true)
                $errors[] = $loginValidate;
            if ($passwordValidate !== true)
                $errors[] = $passwordValidate;
            if (User::isLoginExist($login) === true)
                $errors[] = 'This login is already taken!';
            if (Main::isEmailExist($email) !== false)
                $errors[] = 'This email is already taken!';
            if (isset($errors) || $main->register($login, $password, $email) == false )
            {

            }
            else
            {
                header('Refresh: 1; URL=http://localhost:8101/main/login');
            }
        }
        require_once(ROOT . '/views/main/main.php');
        return true;
    }
    public function actionConfirm()
    {
        require_once(ROOT . '/views/main/confirm.php');
    }
    public function actionLogin()
    {
        $login = '';
        $password = '';
        if (isset($_POST['btnlogin']))
        {
            $login = $_POST['login'];
            $password = $_POST['password'];
            $check = User::checkPassworLogin($login, $password);
            if($check === false)
            {
                $errors[] = "Wrong data!";
            }
            if ($check === 'unconfirmed')
            {
                $errors[] = 'Please confirm your account by email';
            }
            if (!isset($errors))
            {
                User::signIn($check);
                header('Location:/cabinet');
                return true;
            }
        }

        require_once(ROOT . '/views/main/login.php');
        return true;//$photoList;
    }
    public function actionLogout()
    {
        session_start();
        unset($_SESSION['userLogin']);
        unset($_SESSION['userId']);
        header('Location:/main');
    }

    public function actionForgotPassword(){

        if (isset($_POST["fEmail"]) && isset($_POST["btnlogin"]))
        {
            $main = new Main();
            if ($main->resetPassword($_POST['fEmail']))
                header('Location:/main');
            else
            {
                $msg = 'No such email or user is not confirmed!';
            }
            unset($_POST['fEmail']);
            unset($_POST['btnlogin']);
        }
        require_once(ROOT . '/views/main/forgot.php');
    }
    public function actionRestore()
    {
        if (isset($_GET['email']) && isset($_GET['token']))
        {
            if (isset($_POST['password']))
            {
                $m = new Main();
                $res = $m->changePassword($_GET['email'], $_POST['password'], -1, $_GET['token']);
                if ($res === true)
                {
                    $ok = true;
                    $m->confirmPassChange($_GET['email']);
                }
                else
                {
                    $ok = false;
                    $errors[] = $res;
                }
            }
            require_once(ROOT . '/views/main/restore.php');
        }
        else
            header('Location: /main');

    }

}