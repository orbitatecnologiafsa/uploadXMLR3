<?php

namespace App\Repositorio\ClienteApi;

use App\Models\UltimoUpdate;
use App\Repositorio\Adm\AdmRepositorio;
use App\Repositorio\Upload\UploadRepositorio;
use App\Repositorio\Util\HelperUtil;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class UploadXmlRepositorio
{
    public function cadastroXML($nome_pasta, $arquivosXML, $cnpj_cliente)
    {

        $repositorio = new AdmRepositorio();
        $cliente = $repositorio->getClienteByCampoFirst(['cliente' => $cnpj_cliente]);
        $update =  new UltimoUpdate();
        //return response()->json(['message' => is_null($arquivosXML)]);
        try {
            $diretorioDestino = public_path('storage' . '/' . $cnpj_cliente);
            $nomePasta = $nome_pasta;
            $validarPasta = (array) HelperUtil::pastasNomeGenerate();



            $validar = false;
            foreach ($validarPasta as $key => $value) {

                if ($value == $nome_pasta) {

                    // Verifica se o diretório de destino existe
                    if (!File::exists($diretorioDestino)) {
                        File::makeDirectory($diretorioDestino, 0755, true);
                        // Remove a pasta existente e todos os seus conteúdos
                        // File::deleteDirectory($diretorioDestino);

                    }
                    if (!File::exists($diretorioDestino . '/' . $nomePasta)) {
                        File::makeDirectory($diretorioDestino . '/' . $nomePasta, 0755, true);
                    }
                    $validar = true;
                }
            }
            if ($validar) {
                $caminhoDestino = $diretorioDestino . '/' . $nomePasta;
                $arquivos = $arquivosXML;


                // Itera sobre os arquivos e salva cada um em uma pasta dentro do diretório de destino

                //return response()->json(['message' => "nome arquivo". $arquivos->getClientOriginalName()]);
                $arquivos->move($caminhoDestino, $arquivos->getClientOriginalName());

                //date_default_timezone_set('America/Sao_Paulo');
                $busca = $update->where('documento', $cnpj_cliente)->get()->first();
                if ($busca) {
                    $up = date('Y-m-d H:i:s');
                    $update->where('id', $busca->id)->update(['updated_at' => $up]);
                    return response()->json(['message' => 'Arquivos recebidos e salvos com sucesso']);
                } else {
                    $update->create(['nome_cliente' => $cliente->nome, 'documento' => $cliente->documento]);
                    return response()->json(['message' => 'Arquivos recebidos e salvos com sucesso']);
                }
            }
            return response()->json(['message' => 'Arquivos não  recebidos']);
        } catch (Exception $e) {
            return response()->json(['message' => 'erro ao receber Arquivos recebidos e salvos com sucesso', "error" => $e->getMessage()]);
        }
        //$diretorioDestino = '/caminho/da/pasta/destino';

        // Caminho completo da pasta de destino para o arquivo
    }
    public function deletarXML()
    {
    }
}
