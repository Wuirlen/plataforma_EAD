<?php
namespace app\models\service;

use app\models\validacao\AvaliacaoValidacao;

class AvaliacaoService{
    public static function salvar($aula, $campo, $tabela){

        $validacao = AvaliacaoValidacao::salvar($aula);
       
        return Service::salvar($aula, $campo, $validacao->listaErros(), $tabela);
    }
}