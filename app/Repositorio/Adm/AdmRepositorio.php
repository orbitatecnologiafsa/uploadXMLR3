<?php

namespace App\Repositorio\Adm;

use App\Models\Clientes;
use App\Repositorio\Util\HelperUtil;

class AdmRepositorio
{
    protected $cliente;

    public function __construct()
    {
        $this->cliente = new Clientes();
    }
    public function getClienteByCampo($campo)
    {
        $dado = (object) $campo;
        $doc = HelperUtil::removerMascara($dado->cliente);
        if ($cliente = $this->cliente->where('documento',$doc)->paginate(9)) {
            return $cliente;
        } else {
            return [];
        }
    }
    public function getClienteByCampoFirst($campo)
    {
        $dado = (object) $campo;
        $doc = HelperUtil::removerMascara($dado->cliente);
        if ($cliente = $this->cliente->where('documento', $doc)->get()->first()) {

            return $cliente;
        } else {
            return [];
        }
    }
}
