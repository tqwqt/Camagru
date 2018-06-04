<?php
/**
 * Created by PhpStorm.
 * User: vhavryle
 * Date: 6/4/18
 * Time: 1:49 PM
 */

class DbCamagru
{

    public static function getConnection()
    {
        //$dbsettings = ROOT.'/config/database.php';

        require ROOT.'/config/database.php';
        return new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
//        echo '<pre>';
//        echo 'sstart';
//        echo $DB_USER.'<br>';
//        echo $DB_PASSWORD.'<br>';
//        echo $DB_DSN;
//        echo '</pre>';
    }
}