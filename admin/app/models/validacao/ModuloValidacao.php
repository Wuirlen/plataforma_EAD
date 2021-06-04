<?php
namespace app\models\validacao;

use app\core\Validacao;

class ModuloValidacao{
    public static function salvar($modulo){
        $validacao = new Validacao();
        //Setando os Campos
        $validacao -> setData("id_curso",$modulo->id_curso); 
        $validacao -> setData("titulo_modulo",$modulo->titulo_modulo);
        $validacao -> setData("titulo_avaliacao",$modulo->titulo_avaliacao);
        $validacao -> setData("id_modulo", $modulo->id_modulo);
        //$validacao -> setData("cpf",$aluno->cpf);
        //fazendo validação
        $validacao->getData("id_curso")->isVazio();
        $validacao->getData("titulo_modulo")->isVazio();
        $validacao->getData("titulo_avaliacao")->isVazio();
        $validacao->getData("id_modulo")->isVazio();
       
    
    return $validacao;
    
    }
}