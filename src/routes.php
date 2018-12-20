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
      $this->get('/usuarios/editarusuarios/{id}','UserController:show')->setName('usuario.editarusuarios');

      //base de datos.
      $this->get('/database/carreras','HomeController:updateBDcarreras')->setName('database.carreras');
      $this->post('/database/carreras','UploadArchives:updateBDcarreras')->setName('database.carreras');
      $this->post('/database/universidades', 'UploadArchives:updateBDuniversidades')->setName('database.universidades');
      $this->get('/database/universidades','HomeController:updateBDuniversidades')->setName('database.universidades');

      //usuarios admin
      $this->get('/usuariosadmin/create','HomeController:createadmin')->setName('usuarioadmin.create');
      $this->get('/usuariosadmin/list','HomeController:listadmin')->setName('usuarioadmin.list');
      $this->get('/usuariosadmin/editarusuarios/{id}','HomeController:editarusuariosadmin')->setName('usuario.editarusuariosadmin');

      //novedades
      $this->get('/novedades/createnovedad','HomeController:createnovedad')->setName('usuario.createnovedad');
      $this->post('/novedades/upload','UploadArchives:uploadImages')->setName('images.upload');
      $this->get('/novedades/listnovedad','HomeController:listnovedad')->setName('usuario.listnovedad');
      $this->get('/novedades/editarnovedad/{id}','HomeController:editarnovedad')->setName('novedad.editarnovedad');

      //ofertas
      $this->get('/universidad/all','HomeController:universityAll')->setName('universidad.list');
      $this->post('/universidad', "UniversityController:store")->setName('universidad.store');
      $this->get('/universidad', "UniversityController:create")->setName('universidad.create');
      $this->get('/universidad/{codigo}/edit', "UniversityController:show")->setName('universidad.edit');
      $this->post('/universidad/{codigo}/update', "UniversityController:update")->setName('universidad.update');
      $this->get('/universidad/{codigo}/delete', "UniversityController:delete")->setName('universidad.delete');

      $this->get('/carrera/all','HomeController:careeraAll')->setName('carrera.list');
      $this->get('/carrera','CareerController:create')->setName('carrera.create');
      $this->post('/carrera','CareerController:store')->setName('carrera.store');
      $this->get('/carrera/{codigo}/edit','CareerController:show')->setName('carrera.edit');
      $this->post('/carrera/{codigo}/update','CareerController:update')->setName('carrera.update');
      $this->get('/carrera/{codigo}/delete','CareerController:delete')->setName('carrera.delete');



      //usuarios app
      $this->post('/usuarios/insertar','UserController:insertar')->setName('usuario.insertar');
      $this->post('/usuarios/editar/{id}','UserController:update')->setName('usuario.editar');
      $this->get("/usuarios/delete/{id}", "UserController:delete")->setName("usuario.delete");

      //novedades
      $this->post('/novedades/insertar','NovedadController:insertar')->setName('novedad.insertar');
      $this->post('/novedades/editar/{id}','NovedadController:update')->setName('novedad.editar');
      $this->get('/novedades/delete/{id}','NovedadController:delete')->setName('novedad.delete');

      //usuarios admin
      $this->post('/usuariosadmin/insertar','UseradminController:insertar')->setName('usuarioadmin.insertar');
      $this->post('/usuariosadmin/editar/{id}','UseradminController:update')->setName('usuarioadmin.editar');
      $this->get("/usuariosadmin/delete/{id}", "UseradminController:delete")->setName("usuarioadmin.delete");

      $this->get("/novedades/send", "HomeController:sendNotification");
});
//->add(new App\Middleware\AdminMiddleware($container));
