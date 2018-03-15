<?php


$app->get("/", 'HomeController:index')->setName('login');
$app->get("/logout", 'AuthController:signout')->setName('logout');
$app->get("/test", 'NovedadController:getAll');




$app->group("/admin", function (){
  $this->post('/signin','AuthController:signin')->setName('signin');
  $this->get('','HomeController:homeadmin')->setName('home');
  //usuarios app
  $this->get('/usuarios/create','HomeController:create')->setName('usuario.create');
  $this->get('/usuarios/list','HomeController:list')->setName('usuario.list');

  //usuarios admin
  $this->get('/usuariosadmin/create','HomeController:createadmin')->setName('usuarioadmin.create');
  $this->get('/usuariosadmin/list','HomeController:listadmin')->setName('usuarioadmin.list');

  //novedades
  $this->get('/novedades/createnovedad','HomeController:createnovedad')->setName('usuario.createnovedad');
  $this->get('/novedades/listnovedad','HomeController:listnovedad')->setName('usuario.listnovedad');
  $this->get('/novedades/editarnovedad/{id}','HomeController:editarnovedad')->setName('novedad.editarnovedad');

  //ofertas
  $this->get('/ofertas/createoferta','HomeController:createoferta')->setName('usuario.createoferta');
  $this->get('/ofertas/listaferta','HomeController:listaferta')->setName('usuario.listaferta');
  $this->get('/usuarios/editarusuarios/{id}','HomeController:editarusuarios')->setName('usuario.editarusuarios');

  //rutas servidor db

  $this->post('/usuarios/insertar','UserController:insertar')->setName('usuario.insertar');
  $this->post('/usuarios/editar/{id}','UserController:update')->setName('usuario.editar');
  $this->get("/usuarios/delete/{id}", "UserController:delete")->setName("usuario.delete");

  $this->post('/novedades/insertar','NovedadController:insertar')->setName('novedad.insertar');
  $this->post('/novedades/editar/{id}','NovedadController:update')->setName('novedad.editar');
  $this->get('/novedades/delete/{id}','NovedadController:delete')->setName('novedad.delete');

  $this->post('/usuariosadmin/insertar','UseradminController:insertar')->setName('usuarioadmin.insertar');



  

});
//->add(new App\Middleware\AdminMiddleware($container));

