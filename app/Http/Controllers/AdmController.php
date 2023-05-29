<?php

namespace App\Http\Controllers;

use App\Repositorio\Adm\AdmRepositorio;
use App\Repositorio\Adm\LoginRepositorio;
use App\Repositorio\Upload\UploadRepositorio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdmController extends Controller
{

    protected $repositorio;
    protected $uploadRepositorio;

    public function __construct()
    {
        $this->repositorio = new AdmRepositorio();
        $this->uploadRepositorio = new UploadRepositorio();
    }

    public function getCliente()
    {
        return view('adm.upload.busca-cliente', ['cliente' => []]);
    }
    //busca o cliente pelo nome ou cnpj
    public function getClienteByCampo(Request $req)
    {

        if ($req->input('cliente') == null) {
            return redirect()->to('adm/busca')->with('msg-error', 'Informe os valores!');
        }
        $cliente = $this->repositorio->getClienteByCampo($req->all());
        if (count($cliente) > 0) {
            return view('adm.upload.busca-cliente', ['cliente' => $cliente]);
        } else {

            return redirect()->to('adm/busca')->with('msg-error', 'Cliente não encontrado!');
        }
    }

    public function dowloadFiles(Request $req)
    {
    }
    public function getFiles($busca)
    {
        $cliente = $this->repositorio->getClienteByCampoFirst(['cliente' => $busca]);
        $buscaPastas = $this->uploadRepositorio->getPasta($busca);
        if ($cliente) {
            if (!empty($buscaPastas)) {
                return view('adm.upload.upload', ['cliente' => $cliente, 'pastas' => (object) $buscaPastas]);
            }
            return redirect()->to('adm/busca')->with('msg-error', 'Cliente não possui pastas salvas!');
        } else {
            return redirect()->to('adm/busca')->with('msg-error', 'Cliente não encontrado!');
        }
    }

    public function getPasta(Request $req,$busca)
    {

        $pasta = $req->input('busca_pasta');


        return $this->uploadRepositorio->download($pasta,$busca);

        // if($resposta){

        //   return  redirect()->to("/adm/busca-files/$busca")->with('msg-success','Arquivo pronto feito o download');
        // }else{
        //    return redirect()->to("/adm/busca-files/$busca")->with('msg-error','Falha ao fazer download');
        // }
    }
}