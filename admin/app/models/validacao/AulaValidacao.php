<?php
namespace app\models\validacao;

use app\core\Validacao;

class AulaValidacao{
    public static function salvar($aula){
        $validacao = new Validacao();
    
        //Setando os Campos
       // $validacao -> setData("id_modulo",$aula->id_modulo); 
        $validacao -> setData("id_curso",$aula->id_curso); 
        $validacao -> setData("titulo_aula",$aula->titulo_aula);
        $validacao -> setData("duracao_aula",$aula->duracao_aula);
        $validacao -> setData("embed_youtube",$aula->embed_youtube);
        //$validacao -> setData("path_aula",$aula->path_aula);
        //$validacao -> setData("cpf",$aluno->cpf);
        //fazendo validação
       // $validacao->getData("id_modulo")->isVazio();
        $validacao->getData("id_curso")->isVazio();
        $validacao->getData("titulo_aula")->isVazio();
        $validacao->getData("duracao_aula")->isVazio();
        $validacao->getData("embed_youtube")->isVazio();
       // $validacao->getData("path_aula")->isVazio();
    
    return $validacao;
    
    }
}