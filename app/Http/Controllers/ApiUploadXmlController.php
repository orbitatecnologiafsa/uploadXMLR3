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

    public function cadastroXML(Request $req)
    {
          return $this->repositorio->cadastroXML($req->header('nome_pasta'),$req->file('arquivo'),$req->header('cnpj_cliente'));
    }

    public function deletarXML()
    {
    }
}
