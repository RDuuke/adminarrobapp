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

        $files = $request->getUploadedFiles();
        $imagen = $files['imagen'];
        $imagen->moveTo(DIR_IMG . "img_novedades" . DS . $imagen->getClientFilename());


        Novedades::create([
            "imagen" => 'http://200.13.254.146/webserviceapp/img_novedades/'.$imagen->getClientFilename(),
            "titulo" => $request->getParam("titulo"),
            "contenido" =>$request->getParam("contenido"),
            "resumen" => $request->getParam("resumen"),
            "link" => $request->getParam("link"),
            "tipo_novedad" => $request->getParam("tipo_novedad")
        ]);
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

    public function update(Request $request,Response $response)
    {
        $router = $request->getAttribute('route');
        $novedad = Novedades::find($router->getArgument('id'));
        $novedad->titulo = $request->getParam("titulo");
        $novedad->resumen = $request->getParam("resumen");
        $novedad->link = $request->getParam("link");
        $novedad->save();
        $this->flash->addMessage("info", "Novedad actualizado.");

        return $response->withRedirect($this->router->pathFor('usuario.listnovedad'));

    }

    public function delete(Request $request, Response $response)
    {
        $router = $request->getAttribute('route');
        $user = Novedades::find($router->getArgument('id'));
        if ($user->delete()) {
            $this->flash->addMessage('info', "Se Elimino correctamente");
            return $response->withRedirect($this->router->pathFor('usuario.listnovedad'));
        }
        $this->flash->addMessage('Error', "No sé Elimino correctamente");
        return $response->withRedirect($this->router->pathFor('usuario.listnovedad'));
    }




}
