<?php

namespace App\Controllers;


use App\Models\Basico;
use App\Models\Career;
use App\Models\University;
use Slim\Http\Response;
use Slim\Http\Request;

class CareerController extends Controller
{
    function store(Request $request, Response $response)
    {

    }

    function show(Request $request, Response $response, $args)
    {
        $career = Career::find($args["codigo"]);
        $universities = University::all();
        $basicos = Basico::all();
        return $this->view->render($response, "agregarcarrera.twig", ["carrera" => $career, "basicos" => $basicos, "universities" => $universities]);
    }

    function update(Request $request, Response $response, $args)
    {
        if (Career::updateOrCreate(["codigo_snies" => $args['codigo']], $request->getParams()) instanceof Career == 1) {
            $this->flash->addMessage("info", "Carrera actualizada correctamente");
            return $response->withRedirect($this->router->pathFor("carrera.list"));
        }
        $this->flash->addMessage("error", "Error al actualizar la carrera");
        return $response->withRedirect($this->router->pathFor("carrera.edit"));
    }

    function delete(Request $request, Response $response, $args)
    {
        if (Career::destroy($args['codigo'])) {
            $this->flash->addMessage("info", "Carrera eliminada correctamente");
        }
        $this->flash->addMessage("error", "Error al eliminar la carrera");
        return $response->withRedirect($this->router->pathFor("carrera.list"));
    }

    function create(Request $request, Response $response)
    {
        $basicos = Basico::all();
        return $this->view->render($response, "agregarcarrera.twig", ["basicos" => $basicos ]);
    }

}