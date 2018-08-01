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
        require ROOT.'/config/database.php';
        try {
            $pdo =  new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        }catch (PDOException $e)
        {
            $e->getMessage();
        }
        return false;
    }
}