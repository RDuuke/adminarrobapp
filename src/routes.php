<?php


$app->get("/", 'HomeController:index')->setName('login');
$app->get("/logout", 'AuthController:signout')->setName('logout');



$app->group("/admin", function (){
  $this->post('/signin','AuthController:signin')->setName('signin');
  $this->get('','HomeController:homeadmin')->setName('home');

});
//->add(new App\Middleware\AdminMiddleware($container));

