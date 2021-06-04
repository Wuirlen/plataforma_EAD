<?php
namespace app\models\validacao;

use app\core\Validacao;

class UsuarioValidacao{
    public static function salvar($usuario){
        $validacao = new Validacao();
    
        //Setando os Campos 
        $validacao -> setData("nome_usuario",$usuario->nome_usuario);
        $validacao -> setData("login_usuario",$usuario->login_usuario);
        $validacao -> setData("senha_usuario",$usuario->senha_usuario);
        //$validacao -> setData("id_usuario",$usuario->id_usuario);
    
        //fazendo validação

        $validacao->getData("nome_usuario")->isVazio();
        $validacao->getData("login_usuario")->isVazio();
        $validacao->getData("senha_usuario")->isVazio();
       // $validacao->getData("id_usuario")->isVazio();
    
    return $validacao;
    
    }
}