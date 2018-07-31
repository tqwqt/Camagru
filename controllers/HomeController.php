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
    private  $isLogged = false;
    private  $userLogin = NULL;

    public  function actionIndex()
    {
       if (User::checkLogged() !== false)
       {
           $isLogged = true;
           $userLogin = User::checkLogged();
       }
       else
       {
           $isLogged = false;
       }
       $photoList = array();
       $home = new Home();
       $photoList = $home->getPhotoList();
       if (isset($_POST['limId']))
       {

           $toj = $home->getMore($_POST['limId']);
        //   var_dump($toj);
           $photoList = array_merge($photoList, $toj);
       //   var_dump($photoList);
       }
        require_once(ROOT.'/views/home/index.php');
       return true;//$photoList;
    }

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
        else {
            header('Location: /main');
        }
    }

    public function actionShowComments($photoId)
    {
        if (User::checkLogged() === false)
        {
            header('Location: /main');
            return false;
        }
        $photoId = substr($photoId, 5);
        $db = DbCamagru::getConnection();

        $query = 'SELECT comment.id,  comment.text, user.login FROM comment 
                  LEFT JOIN user
                  ON comment.user_id = user.id
                  WHERE comment.photo_id = :photoId';

        $res = $db->prepare($query);
        $res->bindParam(':photoId', $photoId, PDO::PARAM_INT);
        if ($res->execute()) {
            $res = $res->fetchAll(2);
            $res = json_encode($res,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK ,2);
            print_r($res);
        }
        return true;
    }
    public function actionAddComment()
    {
        if (User::checkLogged() === false)
        {
            header('Location: /main');
            return false;
        }
        $home = new Home();
        if ($home->isertComment($_POST['comment'], substr($_POST['photoId'], 5)))
            echo 'OK';
        else
            echo "false";
        return true;

    }

    public function actionRemoveComment()
    {
        if (User::checkLogged() === false)
        {
            header('Location: /main');
            return false;
        }
        $home = new Home();
        if ($home->removeComment($_POST['commentId'] ))
            echo 'OK';
        else
            echo "false";
        return true;
    }

    public function actionDeleteImage()
    {
        if (User::checkLogged() === false)
        {
            header('Location: /main');
            return false;
        }
        if (isset($_POST) && $_POST['photoId'])
        {
            $phId = $_POST['photoId'];
            $home = new Home();
            $home->removePhoto($phId);
        }
        return true;
    }
}