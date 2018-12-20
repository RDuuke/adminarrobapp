<?php

namespace App\Controllers;

use App\Models\Area;
use App\Models\Basico;
use App\Models\Career;
use App\Models\University;
use App\Tool\Tools;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Respect\Validation\Exceptions\PhpLabelException;
use Slim\Http\Request;
use Slim\Http\Response;

class UploadArchives extends Controller
{
    protected $errors = 0;
    protected $creators = 0;

    function updateBDuniversidades (Request $request, Response $response)
    {
        $uploadFiles = $request->getUploadedFiles();
        $archive = $uploadFiles['archivo'];
        if ($archive->getError() == UPLOAD_ERR_OK) {
            $filename = Tools::moveUploadFile($archive);
            try{
                $reader = IOFactory::createReaderForFile(UPLOAD_ARCHIVES . $filename);
                $reader->setReadDataOnly(true);
                $spreadsheet = $reader->load(UPLOAD_ARCHIVES . $filename);
                $worksheet = $spreadsheet->getActiveSheet();
                $sheet = Tools::clearSheetNullActive($worksheet);
                unset($sheet[0]);
                foreach ($sheet as $k => $v) {

                    $data["codigo"] = $v[0];
                    $data["nombre"] = $v[1];
                    $data["tipo"] = $v[4];
                    $data["sector"] = $v[5];
                    $data["caracter_academico"] = $v[6];
                    $data["departamento"] = $v[7];
                    $data["municipio"] = $v[8];
                    $data["direccion"] = $v[9];
                    $data["direccion_google_maps"] = "";
                    $data["telefono"] = $v[10];
                    $data["estado"] = $v[2] == "ACTIVA" ? 1 : 0;
                    $data["principal_seccional"] = $v[3];
                    $data["web"] = $v[16];
                    $data["logo_universidad"] = "http://200.13.254.146/webserviceapp/img_ies/" . $v[0] . ".png";
                    $university = University::updateOrCreate(["codigo" => $v[0]], $data);
                    if (($university instanceof University) == 1) {
                        $this->creators++;
                    } else {
                        $this->errors++;
                    }
                    unset($data);
                }
                $this->flash->addMessage("creators", $this->creators);
                $this->flash->addMessage("errors", $this->errors);
                $this->flash->addMessage("total", $this->errors+$this->creators);
                return $response->withRedirect(
                    $this->router->pathFor("database.universidades")
                );

            } catch (PhpLabelException $e) {
                echo $e->getMessage();
                die;
            }
        }
    }

    function updateBDcarreras (Request $request, Response $response)
    {
        $uploadFiles = $request->getUploadedFiles();
        $archive = $uploadFiles['archivo'];
        if ($archive->getError() == UPLOAD_ERR_OK) {
            $filename = Tools::moveUploadFile($archive);
            try{
                $reader = IOFactory::createReaderForFile(UPLOAD_ARCHIVES . $filename);
                $reader->setReadDataOnly(true);
                $spreadsheet = $reader->load(UPLOAD_ARCHIVES . $filename);
                $worksheet = $spreadsheet->getActiveSheet();
                $sheet = Tools::clearSheetNullActive($worksheet);
                unset($sheet[0]);
                foreach ($sheet as $k => $v) {
                    $data["codigo_institucion"] = $v[0];
                    $data["codigo_snies"] = $v[5];
                    $data["basico_de_conocimiento"] = $v[7];
                    $data["nombre"] = $v[8];
                    $data["nivel_academico"] = $v[9];
                    $data["nivel_formacion"] = $v[10];
                    $data["metodologia"] = $v[11];
                    $data["numero_periodos_de_duracion"] = $v[12];
                    $data["periodos_de_duracion"] = $v[13];
                    $data["titulo"] = $v[14];
                    $data["departamento_oferta_programa"] = $v[15];
                    $data["municipio_oferta_programa"] = $v[16];
                    $data["costo_matricula"] = empty($v[17]) ? "SIN DEFINIR" : $v[17];
                    $data["tiempo_admisiones_estudiantes"] = $v[18];
                    if ((University::find($v[0]) instanceof University) == 1) {
                        $area = Area::updateOrCreate(["nombre" => $v[6]], ["nombre" => $v[6]]);
                        $basico = Basico::updateorCreate(["area_conocimiento" => $area->id, "nombre" => $v[7]], ["nombre" => $v[7]]);
                        $data["basico_de_conocimiento"] = $basico->id;
                        $career = Career::updateOrCreate(["codigo_snies" => $v[5]], $data);
                        if (($career instanceof Career) == 1) {
                            $this->creators++;
                        } else {
                            $this->errors++;
                        }
                    } else {
                        $this->errors++;
                    }
                    unset($data);
                }
                $this->flash->addMessage("creators", $this->creators);
                $this->flash->addMessage("errors", $this->errors);
                $this->flash->addMessage("info", $this->errors+$this->creators);
                return $response->withRedirect(
                    $this->router->pathFor("database.carreras")
                );

            } catch (PhpLabelException $e) {
                echo $e->getMessage();
                die;
            }
        }
    }

    function uploadImages(Request $request, Response $response)
    {
        $uploadFiles = $request->getUploadedFiles();
        $archive = $uploadFiles['files'];
        $filename = Tools::moveUploadFile($archive, DIR_IMG);
        return $response->withJson($filename, 200);

    }

}