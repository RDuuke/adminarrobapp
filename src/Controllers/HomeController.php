<?php

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;


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
        return $this->view->render($response,'listausuarios.twig');
    }
    
    public function createnovedad(Request $request,Response $response){
        return $this->view->render($response,'agregarnovedad.twig');
    }

    public function listnovedad(Request $request,Response $response){
        return $this->view->render($response,'listanovedad.twig');
    }

    public function createoferta(Request $request,Response $response){
        return $this->view->render($response,'agregaoferta.twig');
    }

    public function listaferta(Request $request,Response $response){
        return $this->view->render($response,'listaoferta.twig');
    }


    
}