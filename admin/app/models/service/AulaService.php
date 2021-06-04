<?php
namespace app\models\service;

use app\models\validacao\AulaValidacao;

class AulaService{
    public static function salvar($aula, $campo, $tabela){

        $validacao = AulaValidacao::salvar($aula);
       
        return Service::salvar($aula, $campo, $validacao->listaErros(), $tabela);
    }
}