<?php
function __autoload($class_name)
{
    $paths = array(
        '/models/',
        '/components/'
    );
    foreach ($paths as $path)
    {
        $path = ROOT . $path . $class_name . '.php';
        if (is_file($path))
        {
            include_once $path;
        }

    }

}