<?php

namespace App\Repositorio\Upload;

use Illuminate\Support\Facades\File;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use ZipArchive;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class UploadRepositorio
{
    public function getPasta($pastaCliente)
    {

        $storagePath = public_path("storage/$pastaCliente");
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
        $response = [];
        $zipFileUrl = '';
        $caminhoZip = ($this->getNameZips('storage/' . $cnpj . '/' . $pasta, $pasta, true, true));
        $nomeZip = ($this->getNameZips('storage/' . $cnpj . '/' . $pasta, $pasta, false, true));
        $caminhoDownload = public_path("storage/$cnpj/$pasta");
        // if (!File::exists(public_path('downloads'))) {
        //     File::makeDirectory('downloads', 0755);
        // }


        if (!File::exists(public_path("storage/$cnpj"))) {
            File::makeDirectory("storage/$cnpj", 0755);
        }

        if (!File::exists(public_path("storage/$cnpj/$pasta"))) {
            File::makeDirectory("storage/$cnpj/$pasta", 0755);
        }


        if (File::exists($caminhoZip)) {
            File::copy($caminhoZip, $caminhoDownload . "/$nomeZip");
            $zipFileUrl = asset("storage/$cnpj/$pasta/$nomeZip");
            $response = [
                'url' => $zipFileUrl,
                'success' => true
            ];
            return $response;
            //return new BinaryFileResponse($dir,200,$headers);
        }else{
            $response = [
                'url' => $zipFileUrl,
                'success' => false
            ];
            return $response;
        }
        // Verifica se o arquivo zip existe
        // if (file_exists($caminhoZip)) {
        //     // Gera o URL para o arquivo zip usando a função asset()
        //     $zipFileUrl = asset("downloads/$cnpj/$cnpj-$pasta.zip");

        //     // // Cria o link de download
        //     $downloadLink = '<a href="' . $zipFileUrl . '">Baixar arquivo ZIP</a>';

        //     // // Retorna o link de download
        //     // return $downloadLink;
        //     $response = $zipFileUrl;

        //     // Exclui o arquivo após o download
        //     //  File::delete($zipFilePath);

        //     // Retorna a resposta de download
        //     return $response;
        // }

        // Se o arquivo zip não existir, retorne uma mensagem de erro

    }

    public function getNameZips($dir = '', $parte = '', $patch = false, $name = false)
    {

        $storagePath = public_path($dir);


        $dirInfo = '';
        $nameZip = '';
        // Caminho para o diretório de armazenamento
        if (File::exists($storagePath)) {
            $directories = File::files($storagePath);
            $pastas = [];
            foreach ($directories as $directory) {

                if (pathinfo($directory->getExtension() === 'zip')) {
                    if (str_contains($directory->getFilename(), $parte)) {
                        $dirInfo = $directory->getRealPath();
                        $nameZip = ($directory->getFilename());
                    }

                    $pastas[] = substr($directory->getFilename(), 0, 6);
                }
            }
            if ($patch == true) {

                return $dirInfo;
            }
            if ($name == true) {

                return $nameZip;
            }
            return $pastas;
        }
        return [];
    }
}
