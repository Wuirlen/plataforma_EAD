<?php
namespace app\models\service;

use app\models\validacao\ComentarioValidacao;

class ComentarioService{
    public static function salvar($comentario, $campo, $tabela){

        $validacao = ComentarioValidacao::salvar($comentario);
       
        return Service::salvar($comentario, $campo, $validacao->listaErros(), $tabela);
    }
}