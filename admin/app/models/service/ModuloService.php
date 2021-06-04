<?php
namespace app\models\service;

use app\models\validacao\ModuloValidacao;

class ModuloService{
    public static function salvar($modulo, $campo, $tabela){
        $validacao = ModuloValidacao::salvar($modulo);
        return Service::salvar($modulo, $campo, $validacao->listaErros(), $tabela);
    }
}