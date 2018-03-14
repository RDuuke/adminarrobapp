<?php

namespace App\Controllers;

use App\Models\Novedades;
use Respect\Validation\Validator as v;
use Slim\Http\Request;
use Slim\Http\Response;

class NovedadController extends Controller
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
        $files = $request->getUploadedFiles();
        $imagen = $files['imagen'];
        Novedades::create([
            "imagen" => $imagen->getClientFilename(),
            "titulo" => $request->getParam("titulo"),
            "contenido" =>$request->getParam("contenido"),
            "resumen" => $request->getParam("resumen"),
            "link" => $request->getParam("link"),
            "tipo_novedad" => $request->getParam("tipo_novedad")
        ]);
        // @TODO refactorizar
        $this->flash->addMessage("info", "Novedad registrada");

        return $response->withRedirect($this->router->pathFor("usuario.listnovedad"));
    }

    public function getAll(Request $request,Response $response)
    {
        $novedades = Novedades::all()->toArray();
        $nResponse =$response->withHeader('Content-type', 'application/json')
                            ->withJson($novedades, 201);
        return $nResponse;
    }
 
    

}