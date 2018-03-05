<?php


$app->get("/", 'HomeController:index')->setName('login');
$app->get("/logout", 'AuthController:signout')->setName('logout');




$app->group("/admin", function (){
  $this->post('/signin','AuthController:signin')->setName('signin');
  $this->get('','HomeController:homeadmin')->setName('home');
  $this->get('/usuarios/create','HomeController:create')->setName('usuario.create');
  $this->get('/usuarios/list','HomeController:list')->setName('usuario.list');
  $this->get('/novedades/createnovedad','HomeController:createnovedad')->setName('usuario.createnovedad');
  $this->get('/novedades/listnovedad','HomeController:listnovedad')->setName('usuario.listnovedad');
  $this->get('/ofertas/createoferta','HomeController:createoferta')->setName('usuario.createoferta');
  $this->get('/ofertas/listaferta','HomeController:listaferta')->setName('usuario.listaferta');


});
//->add(new App\Middleware\AdminMiddleware($container));

