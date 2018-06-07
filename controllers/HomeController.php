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
    public function actionIndex()
    {
       $photoList = array();
       $home = new Home();
       $photoList = $home->getPhotoList();
//       echo '<pre>';
//       print_r($photoList);
//       echo '</pre>';
        require_once(ROOT.'/views/home/index.php');
       return true;//$photoList;
    }

    public function actionView($index)
    {
       // echo "One photo, $index";

        $home = new Home();
        $photoList = $home->getPhotoById($index);
//        echo '<pre>';
//        print_r($photoList);
//        echo '</pre>';
        return true;//$photoList;
            }
}