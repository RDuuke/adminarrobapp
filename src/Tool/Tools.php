<?php

namespace App\Tool;


use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Psr\Http\Message\UploadedFileInterface;

class Tools
{
    static function moveUploadFile(UploadedFileInterface $uploadedFile, $upload_archive = UPLOAD_ARCHIVES) : String
    {
        try {

            $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
            $basename = bin2hex(random_bytes(8));
            $filename = sprintf('%s.%0.8s', $basename, $extension);
            $uploadedFile->moveTo(UPLOAD_ARCHIVES . $filename);
            return $filename;
        } catch (\Exception $e){
            echo $e->getMessage();
            die;
        }

    }


    static function clearSheetNullActive(Worksheet $worksheet) : array
    {
        return array_filter(array_map("array_filter",$worksheet->toArray()));
    }

    static function dd($vaalue)
    {
        echo '<pre>';
        print_r($vaalue);
        echo '</pre>';
        die;
    }

    static function geocode($address){

        $context = stream_context_create(
            array(
                "http" => array(
                    "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
                )
            )
        );
        // url encode the address
        $address = urlencode($address);

        $url = "http://nominatim.openstreetmap.org/?format=json&addressdetails=1&q={$address}&format=json&limit=1";

        // get the json response
        $resp_json = file_get_contents($url, false, $context);

        // decode the json
        $resp = json_decode($resp_json, true);

        return array("latitud" => $resp[0]['lat'], "longitud" => $resp[0]['lon']);

    }

}