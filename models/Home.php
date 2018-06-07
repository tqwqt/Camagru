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

    public function getPhotoById($id)
    {
        $id = intval($id);
        if ($id) {
          $db =   DbCamagru::getConnection();
            $result = $db->query('SELECT * FROM photo WHERE id='.$id);
            $result->setFetchMode(PDO::FETCH_ASSOC);

            $item = $result->fetch();
            return $item;
        }
        return false;
    }

    public function getPhotoList()
    {

        $db = DbCamagru::getConnection();
        $photoList = array();
        $result = $db->query('SELECT id, description, url, user_id '
            . 'FROM photo '
            . 'ORDER BY id DESC '
            . 'LIMIT 10');
        $i = 0;
//        echo '<pre>';
//        print_r($result);
//        echo '</pre>';
        while ($row = $result->fetch()) {
            $photoList[$i]['id'] = $row['id'];
            $photoList[$i]['description'] = $row['description'];
            $photoList[$i]['url'] = $row['url'];
            $photoList[$i]['user_id'] = $row['user_id'];
            $i++;
        }
        return $photoList;

    }
}