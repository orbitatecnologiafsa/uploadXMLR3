<?php


namespace App\Repositorio\Util;


class HelperUtil{



    public static function removerMascara($cnpj)
    {
         return str_replace('/', '', str_replace('.', '', str_replace('-', '', $cnpj)));
    }

    public static function pastasNomeGenerate()
    {
        date_default_timezone_set('America/Sao_Paulo');
        $intMes = date('m'); //05
        $ano = date('Y');
        if ($intMes == 1) {
            $intAno = intval(date('Y'));
            $ano = strval($intAno - 1);
            $array = [
                "mes1" => $ano . '10',
                "mes2" => $ano . '11',
                "mes3" => $ano . '12',
            ];
        } else if ($intMes == 2) {
            $intAno = intval(date('Y'));
            $ano = strval($intAno - 1);
            $array = [
                "mes1" => $ano . '11',
                "mes2" => $ano . '12',
            ];
            $ano = date('Y');
            $array["mes3"] = $ano . '01';
        } else if ($intMes == 3) {
            $intAno = intval(date('Y'));
            $ano = strval($intAno - 1);
            $array = [
                "mes1" => $ano . '12',
            ];
            $ano = date('Y');
            $array["mes2"] = $ano . '01';
            $array["mes3"] = $ano . '02';
        } else {

            $mes1 = HelperUtil::validarMes(strval($intMes - 1));
            $mes2 = HelperUtil::validarMes(strval($intMes - 2));
            $mes3 = HelperUtil::validarMes(strval($intMes - 3));
            $ano = date('Y');

            $array = [
                "mes1" => $ano . $mes1,
                "mes2" => $ano . $mes2,
                "mes3" => $ano . $mes3,
            ];
        }


        return $array;
    }

    public static function validarMes($mes)
    {

        if (intval($mes) <= 9) {
            return ('0' .  strval($mes));
        }
        return $mes;
    }
}
