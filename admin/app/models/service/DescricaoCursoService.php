<?php
namespace app\models\service;

use app\models\validacao\DescricaoCursoValidacao;
use app\util\UtilService;

class DescricaoCursoService{
    public static function salvar($descricao_curso, $campo, $tabela){
        global $config_upload;
        $validacao = DescricaoCursoValidacao::salvar($descricao_curso);
      return Service::salvar($descricao_curso, $campo, $validacao->listaErros(), $tabela);
    }
}