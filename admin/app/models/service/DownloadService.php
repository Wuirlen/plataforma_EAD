<?php
namespace app\models\service;
use app\core\Flash;
use app\models\validacao\DownloadValidacao;
use app\models\Dao;
use app\models\dao\Dao as DaoDao;

class DownloadService{
    public static function salvar($download, $campo, $tabela){
            $resultado = false;
            $validacao = DownloadValidacao::salvar($download);
            if($validacao->qtdeErro()<=0){
                $dao = new DaoDao();
                $resultado = $dao->inserir(objToArray($download),"download");
                if($resultado){
                    Flash::setMsg("Registro inserido com sucesso");
                }else{
                    Flash::setMsg("Não foi possível inserir o registro!", -1);
                }
                Flash::limpaForm();
            }else{
                Flash::limpaErro();
                Flash::setErro($validacao->listaErros());
            }
            
            return $resultado;
        
    }
}