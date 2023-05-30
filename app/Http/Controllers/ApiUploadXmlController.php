<?php

namespace App\Http\Controllers;

use App\Repositorio\ClienteApi\UploadXmlRepositorio;
use Illuminate\Http\Request;

class ApiUploadXmlController extends Controller
{
    protected $repositorio;

    public function __construct()
    {
        $this->repositorio = new UploadXmlRepositorio();
    }

    public function cadastroXML(Request $req,$nome_pasta = '',$cnpj_cliente = '')
    {
          return $this->repositorio->cadastroXML($nome_pasta,$req->file('arquivo'),$cnpj_cliente);
    }

    public function deletarXML()
    {
    }
}
