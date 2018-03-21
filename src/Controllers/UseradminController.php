<?php

namespace App\Controllers;

use App\Models\User;
use Respect\Validation\Validator as v;
use Slim\Http\Request;
use Slim\Http\Response;

class UseradminController extends Controller
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
       User::create([
            "name" => $request->getParam("name"),
            "email" => $request->getParam("email"),
            "password" => md5($request->getParam("password")),
            "rol_id" => $request->getParam("rol_id"),

        ]);
        // @TODO refactorizar
        $this->flash->addMessage("info", "Usuario Registrado");

        return $response->withRedirect($this->router->pathFor("usuarioadmin.list"));
    }

    public function show(Request $request,Response $response)
    {
        $router = $request->getAttribute('route');
        $user = User::find($router->getArgument('id'));
        return $this->view->render($response, 'usuario.editarusuarios', ['user' => $user]);

    }


    public function update(Request $request,Response $response)
    {
        $router = $request->getAttribute('route');
        $user = User::find($router->getArgument('id'));
        $user->name = $request->getParam("name");
        $user->email = $request->getParam("email");
        $user->password = md5($request->getParam("password"));
        $user->rol_id = $request->getParam("rol_id");
        $user->save();
        $this->flash->addMessage("info", "usuario actualizado.");

        return $response->withRedirect($this->router->pathFor('usuarioadmin.list'));

    }

    public function delete(Request $request, Response $response)
    {
        $router = $request->getAttribute('route');
        $user = User::find($router->getArgument('id'));
        if ($user->delete()) {
            $this->flash->addMessage('info', "Se Elimino correctamente");
            return $response->withRedirect($this->router->pathFor('usuarioadmin.list'));
        }
        $this->flash->addMessage('Error', "No sé Elimino correctamente");
        return $response->withRedirect($this->router->pathFor('usuarioadmin.list'));
    }

}
