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

//    public function getPhotoById($id)
//    {
//        $id = intval($id);
//        if ($id) {
//          $db =   DbCamagru::getConnection();
//            $result = $db->query('SELECT * FROM photo WHERE id='.$id);
//            $result->setFetchMode(PDO::FETCH_ASSOC);
//
//            $item = $result->fetch();
//            return $item;
//        }
//        return false;
//    }

    public function getPhotoList()
    {

        $db = DbCamagru::getConnection();

        $photoList = array();
        $result = $db->query('SELECT id, description, url, user_id, likes '
            . 'FROM photo '
            . 'ORDER BY id DESC ');
        $i = 0;

        while ($row = $result->fetch()) {
            $photoList[$i]['id'] = $row['id'];
            $photoList[$i]['description'] = $row['description'];
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
        return $res->execute();
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