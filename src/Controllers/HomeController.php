<?php

namespace App\Controllers;

use App\Models\Career;
use App\Models\University;
use App\Tool\Tools;
use Kreait\Firebase\Messaging\CloudMessage;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\UserApp;
use App\Models\User;
use App\Models\Novedades;




class HomeController extends Controller
{

    public function index(Request $request,Response $response)
    {

      return $this->view->render($response,'home.twig');
    }

    public function homeadmin(Request $request,Response $response){
        return $this->view->render($response,'paneladmin.twig');
    }

    public function create(Request $request,Response $response){
        return $this->view->render($response,'agregarusuarios.twig');
    }

    public function list(Request $request,Response $response){
        $user_app = UserApp::all();
        return $this->view->render($response,'listausuarios.twig',['users' => $user_app] );
    }

    public function createnovedad(Request $request,Response $response){
        return $this->view->render($response,'agregarnovedad.twig');
    }

    public function listnovedad(Request $request,Response $response){
        $list_novedad = Novedades::all();
        return $this->view->render($response,'listanovedad.twig',['novedades' => $list_novedad] );
    }


    public function editarusuarios(Request $request,Response $response){
        $router = $request->getAttribute('route');
        $user = UserApp::find($router->getArgument('id'));
        return $this->view->render($response, 'editarusuarios.twig', ['user' => $user]);
    }
    public function editarnovedad(Request $request,Response $response){
        $router = $request->getAttribute('route');
        $novedades = Novedades::find($router->getArgument('id'));
        return $this->view->render($response, 'agregarnovedad.twig', ['novedad' => $novedades]);
    }

    public function editarusuariosadmin(Request $request,Response $response){
        $router = $request->getAttribute('route');
        $ediuseradmin = User::find($router->getArgument('id'));
        return $this->view->render($response, 'editarusuariosadmin.twig', ['useradmin' => $ediuseradmin]);
    }

    public function createadmin(Request $request,Response $response){
        return $this->view->render($response,'agregausuariosadmin.twig');
    }

    public function listadmin(Request $request,Response $response){
        $useradmin = User::all();
        return $this->view->render($response,'listausuariosadmin.twig',['useradmin' => $useradmin] );
    }

    public function updateBDcarreras(Request $request,Response $response)
    {
      return $this->view->render($response,'databasecarreras.twig');
    }

    public function updateBDuniversidades(Request $request,Response $response)
    {
      return $this->view->render($response,'databaseuniversidad.twig');
    }

    public function universityAll(Request $request, Response $response)
    {
        $universidades = University::all();
        return $this->view->render($response, 'universidad.twig', ['universidades' => $universidades]);
    }

    public function careeraAll(Request $request, Response $response)
    {
        $carreras = Career::all();
        return $this->view->render($response, 'carrera.twig', ['carreras' => $carreras]);
    }

    public function sendNotification(Request $request, Response $response)
    {
        $this->firebase->getMessaging()
            ->send([
                ""
            ]);

    }

}
