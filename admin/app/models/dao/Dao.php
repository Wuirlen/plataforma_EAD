<?php
namespace app\models\dao;
use app\core\Model;

class Dao extends Model{    
    public function lista($tabela){
        return  $this->all($this->db, $tabela);
    } 
    public function lista_aula_assistida($tabela,$id_aluno,$id){
        return  $this->all_aula_assistida($this->db,$tabela,$id_aluno,$id);
    } 
    public function lista_aula_assistida_modulo($tabela){
        return  $this->all_aula_assistida_modulo($this->db,$tabela);
    }       
    
    public function inner_join($tabela){
        return  $this->all_join($this->db, $tabela);
    } 
    public function inner_join_desempenho_curso($tabela,$id){
        return  $this->all_join_desempenho_curso($this->db, $tabela,$id);
    } 
    public function inner_join_aluno($tabela){
        return  $this->all_join_aluno($this->db, $tabela);
    }  
    public function contador($tabela){
        return  $this->contaValoresRepetidos($this->db, $tabela);
    } 
    public function contador_desempenho_curso($tabela){
        return  $this->contaValoresRepetidos_desempenho_curso($this->db, $tabela);
    } 
    public function contador_aluno_curso($tabela,$id){
        return  $this->conta_aluno_curso($this->db, $tabela,$id);
    } 
    public function rank_(){
        return  $this->rank($this->db);
    } 
    public function contadormodulo($tabela){
        return  $this->all_joinModulo($this->db, $tabela);
    }  
    public function inner_joinwhere($tabela){
        return  $this->all_joinwhere($this->db, $tabela);
    }  
    public function inner_joinwhere_modulo($tabela,$id){
        return  $this->all_joinwhere_modulo($this->db, $tabela,$id);
    }  
    public function get($tabela, $campo, $valor, $eh_lista =false){
        return  $this->find($this->db,$campo, $valor, $tabela, $eh_lista);
    }   
    public function getcheckbox($tabela, $campo, $valor, $eh_lista =false){
        return  $this->findcheckbox($this->db,$campo, $valor, $tabela, $eh_lista);
    }    
    public function getcargocurso($tabela, $campo, $valor, $eh_lista =false){
        return  $this->findcargocurso($this->db,$campo, $valor, $tabela, $eh_lista);
    } 
    public function getGeral($tabela, $campo, $operador, $valor, $eh_lista){
        return  $this->findGeral($this->db,$campo,$operador, $valor, $tabela, $eh_lista);
    }    
    
    public function getEntre($tabela, $campo, $valor1, $valor2){
        return  $this->findEntre($this->db,$campo, $valor1, $valor2, $tabela);
    } 
    
    public function getLike($tabela, $campo, $valor, $eh_lista, $posicao){
        return  $this->findlike($this->db,$campo, $valor, $tabela, $eh_lista, $posicao);
    }
    
    public function getTotal($tabela, $campoAgregacao, $campo, $valor){
        return  $this->findAgrega($this->db, 'total', $campoAgregacao, $tabela,$campo, $valor);
    }
    
    public function getSoma($tabela, $campoAgregacao, $campo, $valor){
        return  $this->findAgrega($this->db, 'soma', $campoAgregacao, $tabela,$campo, $valor);
    }
    
    public function getMaximo($tabela, $campoAgregacao, $campo, $valor){
        return  $this->findAgrega($this->db, 'max', $campoAgregacao, $tabela,$campo, $valor);
    }
    
    public function getMinimo($tabela, $campoAgregacao, $campo, $valor){
        return  $this->findAgrega($this->db, 'min', $campoAgregacao, $tabela,$campo, $valor);
    }
    
    public function getMedia($tabela, $campoAgregacao, $campo, $valor){
        return  $this->findAgrega($this->db, 'media', $campoAgregacao, $tabela,$campo, $valor);
    }
    public function inserir( $valores, $tabela){
     
        return $this->add($this->db,  $valores, $tabela);
    }
    public function inserirAluno( $valores, $tabela){
     
        return $this->addAluno($this->db,  $valores, $tabela);
    }
    public function inserirCargo( $valores, $tabela){
     
        return $this->addCargo($this->db,  $valores, $tabela);
    }

    public function editar( $valores, $campo, $tabela){

        return $this->edit($this->db, $valores,$campo, $tabela);
        
    }
    
    public function excluir($tabela, $campo, $valor){
        return $this->del($this->db, $campo ,$valor , $tabela);
    }
}

