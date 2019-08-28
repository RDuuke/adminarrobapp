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
use App\Validation\Validator;
use App\Middleware\ValidationErrorsMiddleware;
use Respect\Validation\Validator as v;
use App\Auth\Auth;

$app = new App([
    'settings' => [
        'determineRouteBeforeAppMiddleware' => true,
        'displayErrorDetails' => true,
        'addContentLengthHeader' => false,
    'db' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'dbarrobapp',
            'username' => 'arroba',
            'password' => 'MXQ53105pn',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]
    ]
]);

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

$container['view'] = function ($container) {

    $view = new Twig(__DIR__ . "/../views",[
        'cache' => false
    ]);


    $view->addExtension(new TwigExtension(
        $container->router,
        $container->request->getUri()
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

$container['flash'] = function ($container) {
    return new Messages;
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


v::with("App\\Validation\\Rules\\");

require_once dirname(__DIR__) . "/src/routes.php";
