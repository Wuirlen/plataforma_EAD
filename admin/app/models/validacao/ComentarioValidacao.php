<?php
namespace app\models\validacao;

use app\core\Validacao;

class ComentarioValidacao{
    public static function salvar($comentario){
        $validacao = new Validacao();
    
        //Setando os Campos 
        $validacao -> setData("id_aluno",$comentario->id_aluno);
        $validacao -> setData("id_comentario",$comentario->id_comentario);
        $validacao -> setData("id_aula",$comentario->id_aula);
        $validacao -> setData("data_comentario",$comentario->data_comentario);
        $validacao -> setData("hora_comentario",$comentario->hora_comentario);
        //fazendo validação

        $validacao->getData("id_aluno")->isVazio(); 
        $validacao->getData("id_comentario")->isVazio();  
        $validacao->getData("id_aula")->isVazio();  
        $validacao->getData("data_comentario")->isVazio();  
        $validacao->getData("hora_comentario")->isVazio();     
    return $validacao;
    
    }
}