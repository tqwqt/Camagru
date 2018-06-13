<?php
/**
 * Created by PhpStorm.
 * User: vhavryle
 * Date: 6/13/18
 * Time: 4:50 PM
 */

class CabinetController
{
    public function actionCabinet()
    {
        $userLogin = User::checkLogged();
        require_once(ROOT.'/views/cabinet/cabinet.php');
    }

}