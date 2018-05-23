<?php
/**
 * Created by PhpStorm.
 * User: vhavryle
 * Date: 5/23/18
 * Time: 2:28 PM
 */

class HomeController
{
    public function actionIndex()
    {
        echo "Home controller, actionINdex";
        return true;
    }

    public function actionView($index)
    {
        echo "One photo, $index";

        return true;
    }
}