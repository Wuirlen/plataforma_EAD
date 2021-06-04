<?php

namespace app\models;
use app\core\Model;

class LoginModel extends Model{

    public function logar($matricula, $senha){
        $sql = "SELECT * FROM aluno where matricula = :matricula 
        AND senha = :senha";
       
        $qry = $this->db->prepare($sql); 
      
        $qry->bindValue(":matricula", $matricula);
     
        $qry->bindValue(":senha", $senha);
        $qry->execute();
        
        return $qry->fetch(\PDO::FETCH_OBJ);
    }
    
  
    public function retornaIdAluno(){
        $id_aluno = isset($_SESSION[SESSION_LOGIN]) ? 
        $_SESSION[SESSION_LOGIN]->id_aluno : NULL;

        return $id_aluno;
    }
}