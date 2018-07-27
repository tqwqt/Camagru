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
           // $pos = strpos($req_ur, '.') + 4;
            //$req_ur = substr($req_ur, $pos);
            $uri = trim($req_ur, '/');
        }
        return $uri;
    }
    public function run()
    {


        $uri =  $this->getUri();
        foreach ($this->routes as $pattern => $path)
        {
//            echo "pattern = $pattern, uri = $uri <br>";
            if (preg_match("~^$pattern$~", $uri))//pattern = routes key, example 'home/([0-9]+)'
            {
                //получаем внутрений путь
                $internalRoute = preg_replace("~$pattern~", $path, $uri);

                //определтиь котроллер, экшн, параментры

                $exp = explode('/', $internalRoute);
//                echo '<pre>';
//                var_dump($exp);
//                echo  '</pre>';
                $conName = array_shift($exp).'Controller';
                $conName = ucfirst($conName);
                //echo 'conname='.$conName;
                $actionName = array_shift($exp);
                $actionName = 'action'.ucfirst($actionName);
                if (stripos($actionName, '?') !== false)//обрезает то, что после "?"
                {
                    $actionName = stristr($actionName, '?', true);
                }
//                echo "<br>";
//                echo  $actionName;
//                echo "<br>";
//                echo '<pre>';
//                var_dump($exp);
//                echo  '</pre>';
                //создание контролера и вызов метода
                $contrFile = ROOT.'/controllers/'.$conName.'.php';
                if (file_exists($contrFile))
                {
                    include_once($contrFile);
                }
                $contrObj = new $conName;
                $res = call_user_func_array(array($contrObj, $actionName), $exp);

//                var_dump($uri);
//                var_dump($pattern);
                //var_dump($actionName);
                if ($res != null)
                    break;
                return;
            }
        }

        //$arr = ['str', 1, 'sl'];
    }
}

/*?>*/