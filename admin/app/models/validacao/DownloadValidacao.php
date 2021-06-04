<?php
namespace app\models\validacao;

use app\core\Validacao;

class DownloadValidacao{
    public static function salvar($download){
        $validacao = new Validacao();
    
        //Setando os Campos 
        //$validacao -> setData("id_download",$download->id_download);
        $validacao -> setData("id_curso",$download->id_curso);
        $validacao -> setData("titulo_download",$download->titulo_download);
        $validacao -> setData("id_aula",$download->id_aula);
       
       
        //fazendo validação
       //$validacao->getData("id_download")->isVazio();
       $validacao->getData("id_curso")->isVazio();
       $validacao->getData("titulo_download")->isVazio();
       $validacao->getData("id_aula")->isVazio();
        
        return $validacao;
    
    }
}