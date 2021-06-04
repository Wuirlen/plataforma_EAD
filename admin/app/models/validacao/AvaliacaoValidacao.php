<?php
namespace app\models\validacao;

use app\core\Validacao;

class AvaliacaoValidacao{
    public static function salvar($aula){
        $validacao = new Validacao();
    
        //Setando os Campos
       // $validacao -> setData("id_modulo",$aula->id_modulo); 
     
        $validacao -> setData("titulo_pergunta",$aula->titulo_pergunta);
        $validacao -> setData("questao_a",$aula->questao_a);
        $validacao -> setData("questao_b",$aula->questao_b);
        $validacao -> setData("questao_c",$aula->questao_c);
        $validacao -> setData("questao_d",$aula->questao_d);
        $validacao -> setData("resposta",$aula->resposta);
        //$validacao -> setData("path_aula",$aula->path_aula);
        //$validacao -> setData("cpf",$aluno->cpf);
        //fazendo validação
       // $validacao->getData("id_modulo")->isVazio();
    
        $validacao->getData("titulo_pergunta")->isVazio();
        $validacao->getData("questao_a")->isVazio();
        $validacao->getData("questao_b")->isVazio();
        $validacao->getData("questao_c")->isVazio();
        $validacao->getData("resposta")->isVazio();
       // $validacao->getData("path_aula")->isVazio();
    
    return $validacao;
    
    }
}