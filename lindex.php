<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

define('ROOT', dirname(__FILE__));
require_once(ROOT . '/components/Router.php');
//echo "\n\nroot=".ROOT.PHP_EOL;
$router = new Router();
$router->run();
echo 'hello';
//echo "<pre>";
//print_r(get_defined_vars());
//echo "</pre>";
