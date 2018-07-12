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
        $home = new Home();

        if (User::checkLogged())
        {
            $userId = $_SESSION['userId'];
            $db = DbCamagru::getConnection();
            if (User::islikedPhoto($userId, $photoid) == false) {

                $query = 'INSERT INTO user_liked_photo (user_id, photo_id) VALUES (:userId, :photoid)';

                $res = $db->prepare($query);
                $res->bindParam(':userId', $userId, PDO::PARAM_INT);
                $res->bindParam(':photoid', $photoid, PDO::PARAM_INT);
                if ($res->execute())
                {
                    $qlikesInc = 'UPDATE photo SET likes = likes + 1 WHERE id = :photoid';
                    $resInc = $db->prepare($qlikesInc);
                    $resInc->bindParam(':photoid', $photoid, PDO::PARAM_INT);
                    $resInc->execute();
                    echo 'liked'.$home->getLikesCount($photoid);

                }
                else
                    echo 'failLike';
            }else
            {
              $query = 'DELETE FROM user_liked_photo WHERE user_id = :userId AND photo_id =  :photoid';
              $res = $db->prepare($query);
              $res->bindParam(':userId', $userId, PDO::PARAM_INT);
              $res->bindParam(':photoid', $photoid, PDO::PARAM_INT);
              if ($res->execute())
              {
                  $qlikesInc = 'UPDATE photo SET likes = likes - 1 WHERE id = :photoid';
                  $resInc = $db->prepare($qlikesInc);
                  $resInc->bindParam(':photoid', $photoid, PDO::PARAM_INT);
                  $resInc->execute();
                  echo 'unliked'.$home->getLikesCount($photoid);
              }
              else
                  echo 'failUnlike';
            }
        }
      // header('Location: /home');
      // $this->actionIndex();

        //$dblogin = $res->fetch(2);
    }
    public function actionShowLikes($photoId)
    {
        $photoId = substr($photoId, 5);
        $home = new Home();
        //var_dump($home->getLikesCount($photoId));
        echo $home->getLikesCount($photoId);
    }
}