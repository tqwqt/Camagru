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
        if ($userLogin === false)
        {
           header('Location: /main');
        }
        require_once(ROOT.'/views/cabinet/cabinet.php');
    }
    public function actionSetNS()
    {
        if (!isset($_SESSION))
            session_start();
        $status = $_SESSION['userNS'];
        $id = $_SESSION['userId'];
        var_dump($_SESSION);
        if ($status === 1)
            $status = 0;
        else if ($status === 0)
            $status = 1;
        $db = DbCamagru::getConnection();
        $query = 'UPDATE user SET notifications = :status WHERE id = :id';

        $res = $db->prepare($query);
        $res->bindParam(':id', $id, PDO::PARAM_INT);
        $res->bindParam(':status', $status, PDO::PARAM_INT);
        if ($res->execute())
            $_SESSION['userNS'] = $status;
    }

}