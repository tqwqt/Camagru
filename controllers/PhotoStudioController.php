<?php
/**
 * Created by PhpStorm.
 * User: vhavryle
 * Date: 7/19/18
 * Time: 10:35 AM
 */
include_once ROOT. '/models/PhotoStudio.php';
class PhotoStudioController
{

    public function actionPs()
    {
        $userLogin = User::checkLogged();
        if ($userLogin === false)
        {
            header('Location: /main');
        }
        require_once(ROOT.'/views/photoStudio/photoStudio.php');
    }

    public function actionSavePhoto()
    {

        if (User::checkLogged() === false)
        {
            header('Location: /main');
            return false;
        }
        date_default_timezone_set('Europe/Kiev');
        if (!isset($_SESSION))
            session_start();
        //var_dump($_SESSION);
        $loginId = $_SESSION['userLogin'].$_SESSION['userId'];
        $b64str = explode(',', $_POST['img']);
       // echo date('m/d/Y h:i:s a', time()).'end';
        $date =  preg_replace('/\s+/','_', date('m_d_Y H_i_s', time()));
        $name = 'resources/users_photo/ph_'. $date;
        $name = $name.'_'.$loginId.'.png';
        $ifp = fopen($name , "wb" );
        fwrite( $ifp, base64_decode( $b64str[1] ));
        fclose( $ifp );
        if (file_exists($name) === true && PhotoStudio::addPhotoToDB($name, $_SESSION['userId']))
        {
            echo 'OK';
        }
        return true;
    }
}