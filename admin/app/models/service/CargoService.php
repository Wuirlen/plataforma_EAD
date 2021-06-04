<?php
namespace app\models\service;
use app\util\UtilService;
use app\models\validacao\CargoValidacao;

class CargoService{
    public static function salvar($cargo, $campo, $tabela){

        global $config_upload;
        $validacao = CargoValidacao::salvar($cargo);
        return Service::salvarCargo($cargo, $campo, $validacao->listaErros(), $tabela); ;
        
    }
}