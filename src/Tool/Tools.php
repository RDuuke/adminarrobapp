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

}