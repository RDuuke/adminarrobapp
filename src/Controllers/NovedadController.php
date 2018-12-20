<?php

namespace App\Controllers;

use App\Models\Novedades;
use Respect\Validation\Rules\No;
use Respect\Validation\Validator as v;
use Slim\Http\Request;
use Slim\Http\Response;

class NovedadController extends Controller
{


    public function insertar(Request $request,Response $response)
    {

        Novedades::create([
            "titulo" => $request->getParam("titulo"),
            "miniatura" => 'http://200.13.254.146/webserviceapp/img_novedades/'.$request->getParam("miniatura"),
            "imagen" => 'http://200.13.254.146/webserviceapp/img_novedades/'.$request->getParam("imagen"),
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

    public function update(Request $request,Response $response, $args)
    {

        $novedad = Novedades::updateOrCreate(['id_novedad' => $args['id']],
            [
            "titulo" => $request->getParam("titulo"),
            "miniatura" => $request->getParam("miniatura"),
            "imagen" => $request->getParam("imagen"),
            "contenido" =>$request->getParam("contenido"),
            "resumen" => $request->getParam("resumen"),
            "link" => $request->getParam("link"),
            "tipo_novedad" => $request->getParam("tipo_novedad")
        ]);
        if ($novedad instanceof Novedades == 1) {
            $this->flash->addMessage("info", "Novedad actualizado.");
            return $response->withRedirect($this->router->pathFor('usuario.listnovedad'));
        }
        $this->flash->addMessage("error", "Error al actualizar la novedad");
        return $response->withRedirect($this->router->pathFor('usuario.createnovedad'));

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
