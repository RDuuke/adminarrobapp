<?php
require_once dirname(__DIR__) . DS . "vendor" . DS ."autoload.php";

use Slim\App;
use Illuminate\Database\Capsule\Manager;
use Slim\Flash\Messages;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;
use App\Controllers\AuthController;
use App\Controllers\UserController;
use App\Controllers\UseradminController;
use App\Controllers\NovedadController;
use App\Controllers\HomeController;
use App\Controllers\UniversityController;
use App\Controllers\CareerController;
use App\Validation\Validator;
use App\Middleware\ValidationErrorsMiddleware;
use Respect\Validation\Validator as v;
use App\Auth\Auth;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

$config = include_once BASE_DIR . "confing" .DS. "config.php";
$app = new App($config);

$container = $app->getContainer();

$capsule = new Manager;

$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function ($container) use ($capsule) {
    return $capsule;
};

$container['auth'] = function ($container) {
    return new Auth($container);
};
$container['flash'] = function ($container) {
    return new Messages();
};
$container['firebase'] = function (){
  $serviceAccount = ServiceAccount::fromJsonFile(__DIR__ . "/../temp/firebase/google-services.json");
  return (new Factory())
      ->withServiceAccount($serviceAccount)
      ->withDatabaseUri("https://apptatto.firebaseio.com")
      ->create();
};

$container['view'] = function ($container) {

    $view = new Twig(__DIR__ . "/../views",[
        'cache' => false
    ]);


    $view->addExtension(new TwigExtension(
        $container->router,
        $container->request->getUri()
    ));
    $view->addExtension(new Knlv\Slim\Views\TwigMessages(
        new Slim\Flash\Messages()
    ));

    $view->getEnvironment()->addGlobal('auth', [
        'check' => $container->auth->check(),
        'user' => $container->auth->user()
    ]);
    $g = $container->request->getUri();            ;
    $view->getEnvironment()->addGlobal('request',  $g->getPath());

    $view->getEnvironment()->addGlobal('flash', $container->flash);


    return $view;
};

$container['validation'] = function ($container) {
    return new Validator;
};

$container['HomeController'] = function($container) {
    return new HomeController($container);
};

$container['AuthController'] = function($container) {
    return new AuthController($container);
};

$container['UserController'] = function($container) {
    return new UserController($container);
};

$container['NovedadController'] = function($container) {
    return new NovedadController($container);
};

$container['UseradminController'] = function($container) {
    return new UseradminController($container);
};

$container['UploadArchives'] = function ($container) {
    return new \App\Controllers\UploadArchives($container);
};

$container['UniversityController'] = function ($container) {
    return new UniversityController($container);
};
$container['CareerController'] = function ($container) {
    return new CareerController($container);
};

v::with("App\\Validation\\Rules\\");

require_once dirname(__DIR__) . "/src/routes.php";
