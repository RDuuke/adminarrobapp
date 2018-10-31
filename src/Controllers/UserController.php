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
            "name" => $request->getParam("name"),
            "email" => $request->getParam("email"),
            "encrypted_password" => base64_encode($request->getParam("encrypted_password")),
            "avatar" => $request->getParam("avatar"),
            "estado" => $request->getParam("estado"),
            "terminos_condiciones" => $request->getParam("terminos_condiciones")
        ]);
        // @TODO refactorizar
        $this->flash->addMessage("info", "Usuario Registrado");

        return $response->withRedirect($this->router->pathFor("usuario.list"));
    }

    public function show(Request $request,Response $response)
    {
        $router = $request->getAttribute('route');
        $user = UserApp::find($router->getArgument('id'));
        return $this->view->render($response, 'usuario.editarusuarios', ['user' => $user]);

    }


    public function update(Request $request,Response $response)
    {
        $router = $request->getAttribute('route');
        $user = UserApp::find($router->getArgument('id'));
        $user->nombre = $request->getParam("nombre");
        $user->email = $request->getParam("email");
        //$user->password = md5($request->getParam("password"));
        //$user->avatar = $request->getParam("avatar");
        //$user->estado = $request->getParam("estado");
        $user->save();
        $this->flash->addMessage("info", "usuario actualizado.");

        return $response->withRedirect($this->router->pathFor('usuario.list'));

    }

    public function delete(Request $request, Response $response)
    {
        $router = $request->getAttribute('route');
        $user = UserApp::find($router->getArgument('id'));
        if ($user->delete()) {
            $this->flash->addMessage('info', "Se Elimino correctamente");
            return $response->withRedirect($this->router->pathFor('usuario.list'));
        }
        $this->flash->addMessage('Error', "No sé Elimino correctamente");
        return $response->withRedirect($this->router->pathFor('usuario.list'));
    }

}
