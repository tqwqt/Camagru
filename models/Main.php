<?php

include ROOT.'/components/DbCamagru.php';

class Main
{

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