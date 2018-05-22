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

    private function getUri()
    {
        $uri = 0;
        if (!empty($_SERVER['REQUEST_URI']))
        {
            $req_ur = $_SERVER['REQUEST_URI'];
            $pos = strpos($req_ur, '.') + 4;
            $req_ur = substr($req_ur, $pos);
            $uri = trim($req_ur, '/');
        }
        return $uri;
    }
    public function run()
    {


        $uri =  $this->getUri();
        foreach ($this->routes as $pattern => $path)
        {
            //echo "pattern = $pattern, uri = $uri <br>";
            if (preg_match("~^$pattern$~", $uri))
            {
                $exp = explode('/', $path);
                $conName = array_shift($exp).'Controler';
                $conName = ucfirst($conName);
                echo $conName;
                $actionName = array_shift($exp);
                $actionName = 'action'.ucfirst($actionName);
                echo "<br>";
                echo  $actionName;
            }
        }
    }
}