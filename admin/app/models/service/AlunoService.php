<?php
namespace app\models\service;
use app\util\UtilService;
use app\models\validacao\AlunoValidacao;

class AlunoService{
    public static function salvar($aluno, $campo, $tabela){

        global $config_upload;
        $validacao = AlunoValidacao::salvar($aluno);
       
        if($validacao->qtdeErro()<= 0){
        if(!empty($_FILES["arquivo"]["name"])){
        $aluno->foto = UtilService::upload("arquivo",$config_upload);
        if(!$aluno->foto){
            return false;
        }
        }
    }
        return Service::salvarAluno($aluno, $campo, $validacao->listaErros(), $tabela); ;
        
    }
}