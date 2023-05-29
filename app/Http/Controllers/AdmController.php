<?php

namespace App\Http\Controllers;

use App\Repositorio\Adm\AdmRepositorio;
use App\Repositorio\Adm\LoginRepositorio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdmController extends Controller
{

    protected $repositorio;

    public function __construct()
    {
        $this->repositorio = new AdmRepositorio();
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
        if ($cliente) {
            return view('adm.upload.upload', ['cliente' => $cliente]);
        } else {
            return redirect()->to('adm/busca')->with('msg-error', 'Cliente não encontrado!');
        }
    }
}
