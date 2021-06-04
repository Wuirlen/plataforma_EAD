<?php
namespace app\models\service;

use app\models\validacao\CursoValidacao;
use app\util\UtilService;

class CursoService{
    public static function salvar($curso, $campo, $tabela){
        global $config_upload;
        $validacao = CursoValidacao::salvar($curso);
       
        if($validacao->qtdeErro()<= 0){
       if(!empty($_FILES["arquivo"]["name"])){

        $curso->imagem_curso = UtilService::upload("arquivo",$config_upload);
        
        if(!$curso->imagem_curso){
            return false;
        }
        }
       
        if(!empty($_FILES["assinatura"]["name"])){
         
         $curso->imagem_assinatura = UtilService::upload("assinatura",$config_upload);
   
         if(!$curso->imagem_assinatura){
             return false;
         }
         }
    }
    return Service::salvar($curso, $campo, $validacao->listaErros(), $tabela);
    }
}