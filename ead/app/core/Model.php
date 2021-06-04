<?php

namespace app\core;

abstract class Model{
    protected $db;
    
    public function __construct() {
		 $opcoes = array(
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::MYSQL_ATTR_INIT_COMMAND =>"Set NAMES utf8"
        );
        
        $this->db = new \PDO("mysql:dbname=".BANCO.";host=".SERVIDOR,USUARIO,SENHA, $opcoes);
    }
   
    function edit($conn,$dados, $campo, $tabela =null){
      print_r($campo);
      exit();
       if(!empty($dados)){
        $tabela = ($tabela) ? $tabela: $this->tabela;
        $parametro = null;
        
            foreach($dados as $chave=>$valor){
                $parametro .="$chave=:$chave, ";
            }
     
            $condicao = $campo ." = " . $dados[$campo];
            $parametro = rtrim($parametro, ', ');
            $sql = "UPDATE {$tabela} SET {$parametro} WHERE {$condicao} ";
           
            $stmt = $conn->prepare($sql);
            foreach($dados as $chave=>$valor){
                $stmt->bindValue(":$chave", $valor);
            }
           
            $stmt->execute();
            return $stmt->rowCount() ;
             
     }
    }
   
}

