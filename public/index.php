<?php
if (!ini_get('display_errors')) {
    ini_set('display_errors', '1');
}
session_start();
define("DS", DIRECTORY_SEPARATOR);
define("BASE_DIR",  dirname(__DIR__) . DS);
define("DIR_IMG", dirname(__DIR__) . DS . '..' . DS . 'webserviceapp' . DS);
require_once dirname(__DIR__) . DS . "bootstrap" . DS . "app.php";

$app->run();
