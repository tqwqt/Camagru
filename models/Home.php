<?php
/**
 * Created by PhpStorm.
 * User: vhavryle
 * Date: 6/3/18
 * Time: 1:30 PM
 */

include ROOT.'/components/DbCamagru.php';
class Home
{

    public function getPhotoList()
    {

        $db = DbCamagru::getConnection();

        $photoList = array();
        $result = $db->query(
            'SELECT photo.id,  photo.url, photo.likes, photo.user_id, user.login FROM photo 
                  LEFT JOIN user
                  ON photo.user_id = user.id
                  ORDER BY photo.id DESC');
        $i = 0;

        while ($row = $result->fetch()) {
            $photoList[$i]['id'] = $row['id'];
            $photoList[$i]['login'] = $row['login'];
            $photoList[$i]['url'] = $row['url'];
            $photoList[$i]['user_id'] = $row['user_id'];
            $photoList[$i]['likes'] = $row['likes'];
            $i++;
        }

        return $photoList;
    }
    public function getLikesCount($photoId)
    {
        $db = DbCamagru::getConnection();
        $query = 'SELECT * FROM photo WHERE id = :photoId';
//        echo '<pre>';
//        var_dump($photoId);
//        echo '</pre>';
        $res = $db->prepare($query);
        $res->bindParam(':photoId', $photoId, PDO::PARAM_INT);
        $res->execute();
        $res = $res->fetch(2);

        return $res['likes'];
    }

    public function isertComment($text, $photoId)
    {
        $db = DbCamagru::getConnection();
        if (!isset($_SESSION))
            session_start();
        $userId = $_SESSION['userId'];
        $query = 'INSERT INTO comment (user_id, photo_id, text) VALUES (:userId, :photoId, :text)';
        $res = $db->prepare($query);

        $res->bindParam(':userId', $userId, PDO::PARAM_INT);
        $res->bindParam(':photoId', $photoId, PDO::PARAM_INT);
        $res->bindParam(':text', $text, PDO::PARAM_STR);
        if (User::checkNotificationsStatus() === true)
        {
            $this->sendNotification($_SESSION['userLogin'], $text, $_SESSION['userEmail']);
        }
        return $res->execute();
    }


    public function sendNotification($user, $text, $victimEmail)
    {

            $encoding = "utf-8";
            $mail_subject = "Notification";
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
            $mail_message = ' <!doctype html> <html>'.
                '<p>Holla</p>
                <p>User <strong>'.$user.'</strong> left comment under your photo,</p>
                <p>here is what he said: "'.$text.'"'.'
                <p>Best regards! Camagru.</p>
                </html>';
            // Send mail
        mail($victimEmail, $mail_subject, $mail_message, $header);
    }
    public function removeComment($id)
    {
        $db = DbCamagru::getConnection();

        if (!isset($_SESSION))
            session_start();
        $uid = $_SESSION['userId'];

        $query = 'DELETE FROM comment WHERE user_id = :uid AND id = :id';
        $res = $db->prepare($query);
        $res->bindParam(':uid', $uid, PDO::PARAM_INT);
        $res->bindParam(':id', $id, PDO::PARAM_INT);
        return $res->execute();
    }
}