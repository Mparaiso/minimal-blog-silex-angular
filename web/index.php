<?php



$filename = __DIR__ . preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
if (php_sapi_name() === 'cli-server' && is_file($filename)) {
    return FALSE;
}

$autoload = require __DIR__ . "/../vendor/autoload.php";


$debug = getenv("NETTUTS_LARAVEL_BACKBONE_ENV") == "development" ? TRUE : FALSE;
$app = new App(array("debug" => $debug));


$app->run();
