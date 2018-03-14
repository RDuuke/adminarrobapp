<?php

namespace App\Controllers;

use App\Models\UserApp;
use Respect\Validation\Validator as v;
use Slim\Http\Request;
use Slim\Http\Response;

class UserController extends Controller
{ 


    public function insertar(Request $request,Response $response)
    {
        /*
        $validation = $this->validation->validate($request, [
            "name" => v::notEmpty()->alpha(),
            "email" => v::notEmpty()->email()->noWhitespace()->emailAvailable(),
            "password" => v::notEmpty()->noWhitespace()
        ]);
        if ($validation->failed()) {
            return $response->withRedirect($this->router->pathFor("user.create"));
        }
        */
       UserApp::create([
            "nombre" => $request->getParam("nombre"),
            "email" => $request->getParam("email"),
            "password" => md5($request->getParam("password")),
            "avatar" => $request->getParam("avatar"),
            "estado" => $request->getParam("estado"),
            "terminos_condiciones" => $request->getParam("terminos_condiciones")
        ]);
        // @TODO refactorizar
        $this->flash->addMessage("info", "Usted ha sido registrado");

        return $response->withRedirect($this->router->pathFor("usuario.list"));
    }

  
    

}