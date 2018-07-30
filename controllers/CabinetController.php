<?php
/**
 * Created by PhpStorm.
 * User: vhavryle
 * Date: 6/13/18
 * Time: 4:50 PM
 */

class CabinetController
{
    public function actionCabinet()
    {
        $userLogin = User::checkLogged();
        if ($userLogin === false)
        {
           header('Location: /main');
        }
        require_once(ROOT.'/views/cabinet/cabinet.php');
    }
    public function actionSetNS()
    {
        if (!isset($_SESSION))
            session_start();
        $status = $_SESSION['userNS'];
        if (!isset($_SESSION['userId']))
        {
            header('Location: /main');
            return false;
        }
        $id = $_SESSION['userId'];
        if ($status === 1)
            $status = 0;
        else
            $status = 1;
        $db = DbCamagru::getConnection();
        $query = 'UPDATE user SET notifications = :status WHERE id = :id';

        $res = $db->prepare($query);
        $res->bindParam(':id', $id, PDO::PARAM_INT);
        $res->bindParam(':status', $status, PDO::PARAM_INT);
        $res->execute();
        if ($res)
        {
            $_SESSION['userNS'] = $status;
        }
        return true;
    }

    public function actionChange()
    {
        if (User::checkLogged())
        {
            if (!isset($_SESSION, $_SESSION['userId']))
                session_start();
            if (isset($_POST, $_POST['submitChange'])) {
                $old  = $_POST['opassword'];
                $new = $_POST['password'];
                $rep = $_POST['rpassword'];
                $err = User::validatePassword($new, $rep);
                if (!$err)
                    $errors[] = $err;
                if (User::checkPassworLogin($_SESSION['userLogin'], $old) === false)
                    $errors[] = 'Wrong old password!';
                if (!isset($errors))
                {
                    $db = DbCamagru::getConnection();
                    $new = password_hash($new, PASSWORD_DEFAULT);
                    $email = $_SESSION['userEmail'];
                    $query = 'UPDATE user SET password = :newPass WHERE email = :email';
                    $res = $db->prepare($query);
                    $res->bindParam(':email', $email, PDO::PARAM_STR);
                    $res->bindParam(':newPass', $new, PDO::PARAM_STR);
                    if ($res->execute())
                    {
                        $ok = true;
                    }
                }
            }
            require_once(ROOT.'/views/cabinet/changePassword.php');
        }
        else
            header('Location: /main');
    }


    public function actionChangeLogin()
    {
        if (User::checkLogged())
        {
            if (!isset($_SESSION, $_SESSION['userId']))
                session_start();
            if (isset($_POST, $_POST['submitChange'])) {

                $login  = $_POST['nlogin'];
                $err = User::validateLogin($login);
                if ($err !== true)
                {
                    $errors[] = $err;
                }
                if (User::isLoginExist($login) === true)
                    $errors[] = 'This login is already taken!';
                if (!isset($errors))
                {
                    $db = DbCamagru::getConnection();
                    $email = $_SESSION['userEmail'];
                    $query = 'UPDATE user SET login = :login WHERE email = :email';
                    $res = $db->prepare($query);
                    $res->bindParam(':email', $email, PDO::PARAM_STR);
                    $res->bindParam(':login', $login, PDO::PARAM_STR);
                    if ($res->execute())
                    {
                        $ok = true;
                        $_SESSION['userLogin'] = $login;
                    }
                }
            }
            require_once(ROOT.'/views/cabinet/changeLogin.php');
        }
        else
            header('Location: /main');
    }

    public function actionChangeEmail()
    {
        if (User::checkLogged())
        {
            if (!isset($_SESSION, $_SESSION['userId']))
                session_start();
            if (isset($_POST, $_POST['submitChange']) && $_POST['submitChange'] == 'OK') {

                $email  = $_POST['nEmail'];
                $err = Main::isEmailExist($email);
                if ($err !== false)
                {
                    $errors[] = 'This email is already taken!';
                }
                if (!isset($errors))
                {
                    $db = DbCamagru::getConnection();
                    $id = $_SESSION['userId'];
                    $query = 'UPDATE user SET email = :email WHERE id = :id';
                    $res = $db->prepare($query);
                    $res->bindParam(':email', $email, PDO::PARAM_STR);
                    $res->bindParam(':id', $id, PDO::PARAM_INT);
                    if ($res->execute())
                    {
                        $ok = true;
                        $_SESSION['userEmail'] = $email;
                    }
                }
            }
            require_once(ROOT.'/views/cabinet/changeEmail.php');
        }
        else
            header('Location: /main');
    }
}