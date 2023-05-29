<?php

namespace App\Repositorio\Upload;

use Illuminate\Support\Facades\File;
use ZipArchive;

class UploadRepositorio
{
    public function getPasta($pastaCliente)
    {

        $storagePath = storage_path("app/xmls/$pastaCliente"); // Caminho para o diretório de armazenamento
        if (File::exists($storagePath)) {
            $directories = File::directories($storagePath);
            $pastas = [];
            foreach ($directories as $directory) {
                $pastas[] = substr(basename($directory), -6);
            }
            return $pastas;
        }
        return [];
    }

    public function download($pasta,$cnpj)
    {
        $directory = storage_path("app/xmls/$cnpj/$pasta"); // Insira o caminho para o diretório que contém os arquivos que deseja compactar

        $zipFile = public_path("downloads/$pasta.rar"); // Caminho para salvar o arquivo RAR

        $zip = new ZipArchive();
        $zip->open($zipFile, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($directory),
            \RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $name => $file) {
            if (!$file->isDir()) {
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($directory) + 1);
                $zip->addFile($filePath, $relativePath);
            }
        }

        $zip->close();

        return response()->download($zipFile)->deleteFileAfterSend(true);
    }
}
