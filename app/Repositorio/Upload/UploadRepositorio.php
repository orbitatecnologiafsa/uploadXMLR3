<?php

namespace App\Repositorio\Upload;

use Illuminate\Support\Facades\File;
use GuzzleHttp\Client;
use ZipArchive;

class UploadRepositorio
{
    public function getPasta($pastaCliente)
    {

        $storagePath = storage_path("app/xmls/$pastaCliente");
       // Caminho para o diretório de armazenamento
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

    public function download($pasta, $cnpj)
    {
        if(!File::exists(public_path('downloads'))){
            File::makeDirectory('downloads',0755);
        }

        if(!File::exists(public_path("downloads/$cnpj"))){
            File::makeDirectory("downloads/$cnpj",0755);
        }

        $directory = storage_path("app/xmls/$cnpj/$pasta"); // Insira o caminho para o diretório que contém os arquivos que deseja compactar
        $zipFile = public_path("downloads/$cnpj/$pasta.zip"); // Caminho para salvar o arquivo RAR

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
        $zipFilePath = public_path("downloads/$cnpj/$pasta.zip");; // Caminho completo para o arquivo zip dentro da pasta "public"
        $zipFileName = "$pasta.zip"; // Nome do arquivo zip

        // Verifica se o arquivo zip existe
        if (file_exists($zipFilePath)) {
            // Gera o URL para o arquivo zip usando a função asset()
            $zipFileUrl = asset("downloads/$cnpj/$pasta.zip");

            // // Cria o link de download
             $downloadLink = '<a href="' . $zipFileUrl . '">Baixar arquivo ZIP</a>';

            // // Retorna o link de download
            // return $downloadLink;
            $response = $zipFileUrl;

            // Exclui o arquivo após o download
          //  File::delete($zipFilePath);

            // Retorna a resposta de download
            return $response;

        }

        // Se o arquivo zip não existir, retorne uma mensagem de erro
        return 'Arquivo zip não encontrado.';
    }
}
