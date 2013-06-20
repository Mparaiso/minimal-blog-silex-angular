<?php

$filename = __DIR__.preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
if (php_sapi_name() === 'cli-server' && is_file($filename)) {
    return false;
}

$autoload = require __DIR__."/../vendor/autoload.php";

$app = new App(array("debug"=>true));


$app->run();
