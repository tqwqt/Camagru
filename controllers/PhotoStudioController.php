<?php
/**
 * Created by PhpStorm.
 * User: vhavryle
 * Date: 7/19/18
 * Time: 10:35 AM
 */

class PhotoStudioController
{

    public function actionPs()
    {
        $userLogin = User::checkLogged();
        require_once(ROOT.'/views/photoStudio/photoStudio.php');
    }

}