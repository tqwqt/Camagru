<?php
/**
 * Created by PhpStorm.
 * User: vhavryle
 * Date: 7/20/18
 * Time: 4:24 PM
 */

class PhotoStudio
{


    public static function addPhotoToDB($src, $userId)
    {
        $db = DbCamagru::getConnection();
        $query = 'INSERT INTO photo (user_id, url) VALUES (:userId, :src)';

        $res = $db->prepare($query);
        $res->bindParam(':userId', $userId, PDO::PARAM_INT);
        $res->bindParam(':src', $src, PDO::PARAM_STR);
        if ($res->execute()) {
           return true;
        }
        return false;
    }
}