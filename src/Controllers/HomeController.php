<?php

namespace App\Controllers;

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

    public function createoferta(Request $request,Response $response){
        return $this->view->render($response,'agregaoferta.twig');
    }

    public function listaferta(Request $request,Response $response){
        return $this->view->render($response,'listaoferta.twig');
    }

    public function editarusuarios(Request $request,Response $response){
        $router = $request->getAttribute('route');
        $user = UserApp::find($router->getArgument('id'));
        return $this->view->render($response, 'editarusuarios.twig', ['user' => $user]);
    }
    public function editarnovedad(Request $request,Response $response){
        $router = $request->getAttribute('route');
        $novedades = Novedades::find($router->getArgument('id'));
        return $this->view->render($response, 'editarnovedad.twig', ['novedad' => $novedades]);
    }

    public function createadmin(Request $request,Response $response){
        return $this->view->render($response,'agregausuariosadmin.twig');
    }

    public function listadmin(Request $request,Response $response){
        $useradmin = User::all();
        return $this->view->render($response,'listausuariosadmin.twig',['useradmin' => $useradmin] );
    }


    
}