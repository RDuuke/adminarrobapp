<?php

namespace App\Controllers;


use App\Models\University;
use App\Tool\Tools;
use Slim\Http\Request;
use Slim\Http\Response;

class UniversityController extends Controller
{
    function show(Request $request, Response $response, $args)
    {
        $university = University::find($args["codigo"]);
        return $this->view->render($response, "agregaruniversidad.twig", ["universidad" => $university]);
    }

    function delete(Request $request, Response $response, $args)
    {
        if (University::destroy($args['codigo'])) {
            $this->flash->addMessage("info", "Universidad eliminada correctamente");
        }
        $this->flash->addMessage("error", "Error al eliminar la universidad");
        return $response->withRedirect($this->router->pathFor("universidad.list"));
    }

    function create(Request $request, Response $response)
    {
        return $this->view->render($response, "agregaruniversidad.twig");
    }

    function store(Request $request, Response $response)
    {
        if (University::create($request->getParams()) instanceof University == 1) {
            $this->flash->addMessage("info", "Universidad creada correctamente");
            return $response->withRedirect($this->router->pathFor("universidad.list"));
        }
        $this->flash->addMessage("error", "Error al crear la universidad");
        return $response->withRedirect($this->router->pathFor("universidad.create"));
    }

    function update(Request $request, Response $response, $args)
    {
        if (University::updateOrCreate(["codigo" => $args['codigo']], $request->getParams()) instanceof University == 1) {
            $this->flash->addMessage("info", "Universidad actualizada correctamente");
            return $response->withRedirect($this->router->pathFor("universidad.list"));
        }
        $this->flash->addMessage("error", "Error al actualizar la universidad");
        return $response->withRedirect($this->router->pathFor("universidad.edit", ["codigo" => $args["codigo"]]));
    }
}