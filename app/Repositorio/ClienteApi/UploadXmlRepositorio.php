<?php

namespace App\Repositorio\ClienteApi;

use App\Repositorio\Util\HelperUtil;
use Exception;
use Illuminate\Support\Facades\File;

class UploadXmlRepositorio
{
    public function cadastroXML($nome_pasta, $arquivosXML, $cnpj_cliente)
    {

        try {
            $diretorioDestino = storage_path('app/xmls/' . $cnpj_cliente);
            $nomePasta = $nome_pasta;
            $validarPasta = HelperUtil::pastasNomeGenerate();
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
                foreach ($arquivos as $arquivo) {
                    $nomeArquivo = $arquivo->getClientOriginalName();
                    $arquivo->move($caminhoDestino, $nomeArquivo);
                }

                // Resposta da API
                return response()->json(['message' => 'Arquivos recebidos e salvos com sucesso', 'qtd' => count($arquivos)]);
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
