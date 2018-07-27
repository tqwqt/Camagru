<?php

include ROOT.'/components/DbCamagru.php';

class Main
{

    public function resetPassword($email)
    {
        $token = $this->random_str(20);
        $userData = $this->isEmailExist($email);
        if ($userData)
        {
            $encoding = "utf-8";
            $mail_subject = "Password restore";
            $from_name = "Camagru";
            $from_mail = "camacama@gmail.com";
            // Set preferences for Subject field
            $subject_preferences = array(
                "input-charset" => $encoding,
                "output-charset" => $encoding,
                "line-length" => 76,
                "line-break-chars" => "\r\n"
            );
            // Set mail header
            $header = "Content-type: text/html; charset=" . $encoding . " \r\n";
            $header .= "From: " . $from_name . " <" . $from_mail . "> \r\n";
            $header .= "MIME-Version: 1.0 \r\n";
            $header .= "Content-Transfer-Encoding: 8bit \r\n";
            $header .= "Date: " . date("r (T)") . " \r\n";
            $header .= iconv_mime_encode("Subject", $mail_subject, $subject_preferences);
            $mail_message = ' <!doctype html> <html>
                <p>Holla, '.$login.'</p>
                <p>This email means that someone pressed "Forgot password" button, using your email. If it wasn`t you, ignore this.</p>
                <p>You can change your password with this <a href="http://localhost:8101/main/restore?email=' . $email . '&token=' . $token . '">link</a></p>
                <p>Best regards! Camagru.</p>
                </html>';
            // Send mail
            if (mail($email, $mail_subject, $mail_message, $header))
            {
                $db = DbCamagru::getConnection();
                $query = 'UPDATE user SET token = :token WHERE email = :email';

                $res = $db->prepare($query);
                $res->bindParam(':email', $email, PDO::PARAM_STR);
                $res->bindParam(':token', $token, PDO::PARAM_STR);
                $res->execute();
                return true;
            }
        }
        return false;

    }

    public function changePassword($email, $newPass, $oldPassw, $token)
    {
        $db = DbCamagru::getConnection();
        if ($oldPassw != -1 && isset($email, $newPass))
        {
            $query = 'SELECT * FROM user WHERE email = :email';

            $res = $db->prepare($query);
            $res->bindParam(':email', $email, PDO::PARAM_STR);
            $res->execute();
            $dbhash = $res->fetch(2);

            if (password_verify($oldPassw, $dbhash['password']) === true)
            {
                $oldPassw = 1;
            }
            else
                return 'Wrong old password';
        }
        if (isset($email, $newPass) && $this->checkTokenByEmail($email, $token) === true)
        {
            $len = strlen($newPass);
            if ($len <= 7 || $len > 20)
            {
                return 'Your password must be longer than 8 and less than 21 letters!';
            }
            $newPass = password_hash($newPass, PASSWORD_DEFAULT);
            $query = 'UPDATE user SET password = :newPass WHERE email = :email';
            $res = $db->prepare($query);

            $res->bindParam(':email', $email, PDO::PARAM_STR);
            $res->bindParam(':newPass', $newPass, PDO::PARAM_STR);
            if ($res->execute())
                return true;
        }
        return "Something went wrong!";
    }
    public static function isEmailExist($email)
    {
        $db = DbCamagru::getConnection();
        $query = 'SELECT * FROM user WHERE verified = 1 AND email = :email';

        $res = $db->prepare($query);
        $res->bindParam(':email', $email, PDO::PARAM_STR);
        $res->execute();
        return $res->fetch(2);
    }
    public function register($login, $password, $email)
    {
        $token = $this->random_str(15);
        $db = DbCamagru::getConnection();
        $query = 'INSERT INTO user (login, email, password, token) VALUES (:login, :email, :password, :token)';

        $password = password_hash($password, PASSWORD_DEFAULT);
        $res = $db->prepare($query);
        $res->bindParam(':login', $login, PDO::PARAM_STR);
        $res->bindParam(':email', $email, PDO::PARAM_STR);
        $res->bindParam(':password', $password, PDO::PARAM_STR);
        $res->bindParam(':token', $token, PDO::PARAM_STR);

        /*****************************************/
        $encoding = "utf-8";
        $mail_subject = "Verification";
        $from_name = "Camagru";
        $from_mail = "camacama@gmail.com";
        // Set preferences for Subject field
        $subject_preferences = array(
            "input-charset" => $encoding,
            "output-charset" => $encoding,
            "line-length" => 76,
            "line-break-chars" => "\r\n"
        );
        // Set mail header
        $header = "Content-type: text/html; charset=" . $encoding . " \r\n";
        $header .= "From: " . $from_name . " <" . $from_mail . "> \r\n";
        $header .= "MIME-Version: 1.0 \r\n";
        $header .= "Content-Transfer-Encoding: 8bit \r\n";
        $header .= "Date: " . date("r (T)") . " \r\n";
        $header .= iconv_mime_encode("Subject", $mail_subject, $subject_preferences);
        $mail_message = ' <!doctype html> <html>
                <p>Holla, '.$login.'</p>
                <p>Thanks for register.</p>
                <p>Activate your account with this <a href="http://localhost:8101/main/confirm?login=' . $login . '&token=' . $token . '">link</a></p>
                <p>Best regards! Camagru.</p>
                </html>';
        // Send mail
        mail($email, $mail_subject, $mail_message, $header);
        return $res->execute();
    }

    public function checkToken($login, $token)
    {
        if (!isset($login) || !isset($token))
            return false;
        $db = DbCamagru::getConnection();
        $query = '  SELECT token FROM user WHERE login = :login ';

        $res = $db->prepare($query);
        $res->bindParam(':login', $login, PDO::PARAM_STR);
        $res->execute();
        $dbtoken = $res->fetch(2);
        if ($dbtoken['token'] === 'registered')
        {
            return 'registered';
        }
        if (isset($token) && isset($dbtoken['token']) && $token === $dbtoken['token'])
        {
            return true;
        }
        return false;
    }
    public function checkTokenByEmail($email, $token)
    {
        if (!isset($email) || !isset($token))
            return false;
        $db = DbCamagru::getConnection();
        $query = '  SELECT token FROM user WHERE email = :email ';

        $res = $db->prepare($query);
        $res->bindParam(':email', $email, PDO::PARAM_STR);
        $res->execute();
        $dbtoken = $res->fetch(2);
        if ($dbtoken['token'] === 'registered')
        {
            return 'registered';
        }
        if (isset($token) && isset($dbtoken['token']) && $token === $dbtoken['token'])
        {
            return true;
        }
        return false;
    }
    public  function confirmUser($login)
    {
        if (!isset($login))
            return false;
        $db = DbCamagru::getConnection();
        $query = 'UPDATE user SET token = \'registered\' , verified = 1 WHERE login = :login';

        $res = $db->prepare($query);
        $res->bindParam(':login', $login, PDO::PARAM_STR);
        $res->execute();
        return true;
    }
    public  function confirmPassChange($email)
    {
        if (!isset($email))
            return false;
        $db = DbCamagru::getConnection();
        $query = 'UPDATE user SET token = \'registered\'  WHERE email = :email';

        $res = $db->prepare($query);
        $res->bindParam(':email', $email, PDO::PARAM_STR);
        $res->execute();
        return true;
    }
    private function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
    {
        $str = '';
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $str .= $keyspace[random_int(0, $max)];
        }
        return $str;
    }

}