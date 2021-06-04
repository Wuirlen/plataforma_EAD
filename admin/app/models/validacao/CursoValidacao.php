<?php
namespace app\models\validacao;

use app\core\Validacao;

class CursoValidacao{
    public static function salvar($curso){
        $validacao = new Validacao();
    
        //Setando os Campos 
       // $validacao -> setData("id_curso",$curso->id_curso);
        $validacao -> setData("nome_curso",$curso->nome_curso);
        //$validacao -> setData("imagem_curso", $curso->imagem_curso);
        $validacao -> setData("duracao_curso", $curso->duracao_curso);
        $validacao -> setData("slug_curso", $curso->slug_curso);
       // $validacao -> setData("descricao_curso", $curso->descricao_curso);
      //  $validacao -> setData("embed", $curso->embed);
       // $validacao -> setData("ativo_curso", $curso->ativo_curso);

       
        //fazendo validação
       // $validacao->getData("id_curso")->isVazio();
        $validacao->getData("nome_curso")->isVazio();
       // $validacao->getData("imagem_curso")->isVazio();
        $validacao->getData("duracao_curso")->isVazio();
        $validacao->getData("slug_curso")->isVazio();
       // $validacao->getData("descricao_curso")->isVazio();
      //  $validacao->getData("embed")->isVazio();
       // $validacao->getData("ativo_curso")->isVazio();
    
    return $validacao;
    
    }
}