<?php
namespace app\models\validacao;

use app\core\Validacao;

class CargoValidacao{
    public static function salvar($cargo){
        $validacao = new Validacao();
    
        //Setando os Campos 
        //$validacao -> setData("id_cargo",$cargo->id_cargo);
        $validacao -> setData("nome_cargo",$cargo->nome_cargo);
        $validacao -> setData("descricao",$cargo->descricao);
        //$validacao -> setData("id_cargo_curso",$cargo->id_cargo_curso);
     
       // $validacao -> setData("foto", $aluno->foto);

        //$validacao -> setData("cpf",$aluno->cpf);
        //fazendo validação
        //$validacao->getData("id_cargo")->isVazio();
        $validacao->getData("nome_cargo")->isVazio();
        $validacao->getData("descricao")->isVazio();
       // $validacao->getData("id_cargo_curso")->isVazio();
     
    
    return $validacao;
    
    }
}