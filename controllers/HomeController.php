<?php
/**
 * Created by PhpStorm.
 * User: vhavryle
 * Date: 5/23/18
 * Time: 2:28 PM
 */
include_once ROOT. '/models/Home.php';

class HomeController
{
    private $isLogged = false;

    public function actionIndex()
    {
       if (User::checkLogged() !== false)
       {
           $this->isLogged = true;
       }
       else
       {
           $this->isLogged = false;
       }
       $photoList = array();
       $home = new Home();
       $photoList = $home->getPhotoList();
//       echo '<pre>';
//       print_r($photoList);
//       echo '</pre>';
        require_once(ROOT.'/views/home/index.php');
       return true;//$photoList;
    }

//    public function actionView($index)
//    {
//       // echo "One photo, $index";
//
//        $home = new Home();
//        $photoList = $home->getPhotoById($index);
////        echo '<pre>';
////        print_r($photoList);
////        echo '</pre>';
//        return true;//$photoList;
//    }
    public function actionLike($photoid)
    {

        $photoid = substr($photoid, 5);
        echo "id=$photoid";
        if ($this->isLogged)
        {
            $userId = $_SESSION['userId'];
            $db = DbCamagru::getConnection();
            $query = 'INSERT INTO user_liked_photo (user_id, photo_id) VALUES (:userId, :photoid)';

            $res = $db->prepare($query);
            $res->bindParam(':userId', $userId, PDO::PARAM_INT);
            $res->bindParam(':photoid', $photoid, PDO::PARAM_INT);
            $res->execute();
          }
//        else{
//            header('Location: /');//dell this else
//        }

       $this->actionIndex();
        //$dblogin = $res->fetch(2);
    }
}