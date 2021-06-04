<?php
namespace app\models\validacao;

use app\core\Validacao;

class AlunoValidacao{
    public static function salvar($aluno){
        $validacao = new Validacao();
    
        //Setando os Campos 
        $validacao -> setData("id_aluno",$aluno->id_aluno);
        $validacao -> setData("nome_aluno",$aluno->nome_aluno);
        $validacao -> setData("endereco_aluno", $aluno->endereco_aluno);
        $validacao -> setData("cidade_aluno",$aluno->cidade_aluno);
        $validacao -> setData("bairro_aluno",$aluno->bairro_aluno);
        $validacao -> setData("telefone",$aluno->telefone);
        $validacao -> setData("uf", $aluno->uf);
        $validacao -> setData("matricula",$aluno->matricula);
        $validacao -> setData("email",$aluno->email);
        $validacao -> setData("senha",$aluno->senha);
        $validacao -> setData("data_cadastro", $aluno->data_cadastro);
        $validacao -> setData("cpf", $aluno->cpf);
       // $validacao -> setData("foto", $aluno->foto);

        //$validacao -> setData("cpf",$aluno->cpf);
        //fazendo validação
        $validacao->getData("id_aluno")->isVazio();
        $validacao->getData("nome_aluno")->isVazio();
        //$validacao->getData("foto")->isVazio();
        //$validacao->getData("cpf")->isVazio();
        //$validacao->getData("cpf")->isCPF();
        $validacao->getData("telefone")->isVazio();
        $validacao->getData("matricula")->isVazio();
        $validacao->getData("bairro")->isVazio();
        $validacao->getData("cidade")->isVazio();
        $validacao->getData("uf")->isVazio();
        $validacao->getData("email")->isVazio();
        $validacao->getData("email")->isEmail();
        $validacao->getData("senha")->isVazio();
        $validacao->getData("cpf")->isVazio();
    
    return $validacao;
    
    }
}