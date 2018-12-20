<?php
if (!ini_get('display_errors')) {
    ini_set('display_errors', '1');
}
ini_set('memory_limit', '-1');
date_default_timezone_set("America/Bogota");
ini_set('max_execution_time', 1800); //3 minutes

session_start();
define("DS", DIRECTORY_SEPARATOR);
define("BASE_DIR",  dirname(__DIR__) . DS);
define("DIR_IMG", dirname(__DIR__) . DS .  DS . 'webserviceapp' . DS);
define("UPLOAD_ARCHIVES", dirname(__DIR__) . DS . "temp" .  DS . "archives" . DS);
require_once dirname(__DIR__) . DS . "bootstrap" . DS . "app.php";

$app->run();
