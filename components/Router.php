<?php
/**
 * Created by PhpStorm.
 * User: vhavryle
 * Date: 5/21/18
 * Time: 6:50 PM
 */

class Router
{
    private $routes;

    public function __construct()
    {
        $routsPath = ROOT.'/config/routes.php';
        $this->routes = include($routsPath);
    }
    public function run()
    {
        if (!empty($_SERVER['REQUEST_URI']))
            $uri = trim($_SERVER['REQUEST_URI'], '/');

        echo $uri;
    }
}