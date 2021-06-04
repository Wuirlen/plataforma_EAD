<?php
namespace app\models\service;
use app\util\UtilService;
use app\models\validacao\DesempenhoCursoValidacao;

class DesempenhoCursoService{
    public static function salvar($cargo_curso, $campo, $tabela){

        global $config_upload;
        $validacao = DesempenhoCursoValidacao::salvar($cargo_curso);  
         
        return Service::salvar($cargo_curso, $campo, $validacao->listaErros(), $tabela); ;
        
    }
    public static function salvarcargocurso($cargo_curso, $campo, $tabela){

        global $config_upload;
        $validacao = DesempenhoCursoValidacao::salvarcargocurso($cargo_curso);  
         
        return Service::salvarcargocurso($cargo_curso, $campo, $validacao->listaErros(), $tabela); ;
        
    }
    public static function salvarcargocursoEdit($cargo_curso, $campo, $tabela){
        
        global $config_upload;
        $validacao = DesempenhoCursoValidacao::salvarcargocursoEdit($cargo_curso);  
         
        return Service::salvarcargocursoEdit($cargo_curso, $campo, $validacao->listaErros(), $tabela); ;
        
    }
}