<?php
namespace app\models\service;
use app\core\Flash;
use app\models\dao\Dao;

class Service{       

    public static function lista($tabela){
        $dao = new Dao();
        return $dao->lista($tabela);
    }  
    public static function lista_aula_assistida($tabela,$id_aluno,$id){
        $dao = new Dao();
        return $dao->lista_aula_assistida($tabela,$id_aluno,$id);
    }  
    public static function lista_aula_assistida_modulo($tabela){
        $dao = new Dao();
        return $dao->lista_aula_assistida_modulo($tabela);
    } 
    public static function contador($tabela){
        $dao = new Dao();
        return $dao->contador($tabela);
    }
    public static function contador_02($tabela){
        $dao = new Dao();
        return $dao->contador_desempenho_curso($tabela);
    }  
    public static function contador_aluno_curso($tabela,$id){
       
        $dao = new Dao();
        return $dao->contador_aluno_curso($tabela,$id);
    }  
    public static function rank(){
       
        $dao = new Dao();
        return $dao->rank_();
    }  
    public static function contadormodulo($tabela){
        $dao = new Dao();
        return $dao->contadormodulo($tabela);
    }  
    public static function inner_join($tabela){
        $dao = new Dao();
        return $dao->inner_join($tabela);
    }  
    public static function inner_join_desempenho_curso($tabela,$id){
        $dao = new Dao();
        return $dao->inner_join_desempenho_curso($tabela,$id);
    } 
    public static function inner_join_aluno($tabela){
        $dao = new Dao();
        return $dao->inner_join_aluno($tabela);
    }
    public static function inner_joinwhere($tabela){
        $dao = new Dao();
        return $dao->inner_joinwhere($tabela);
    }  
    public static function inner_joinwhere_modulo($tabela,$id){
        $dao = new Dao();
        return $dao->inner_joinwhere_modulo($tabela,$id);
    } 
    public static  function get($tabela, $campo, $valor,$eh_lista = false){
        $dao = new Dao();
    
        return  $dao->get($tabela, $campo, $valor, $eh_lista);
    }  
    public static  function getcheckbox($tabela, $campo, $valor,$eh_lista = false){
        $dao = new Dao();
    
        return  $dao->getcheckbox($tabela, $campo, $valor, $eh_lista);
    }  
    public static  function getcargocurso($tabela, $campo, $valor,$eh_lista = false){
        $dao = new Dao();
    
        return  $dao->getcargocurso($tabela, $campo, $valor, $eh_lista);
    }
    public static  function getEntre($tabela, $campo, $valor1, $valor2){
        $dao = new Dao();
        return  $dao->getEntre($tabela, $campo, $valor1, $valor2);
    } 
    public static  function getGeral($tabela, $campo,$operador, $valor,$eh_lista=false){
        $dao = new Dao();
        return  $dao->getGeral($tabela, $campo, $operador, $valor,$eh_lista);
    }    
    
    public static  function getLike($tabela, $campo, $valor,$eh_lista=false, $posicao=null){
        $dao = new Dao();
        return  $dao->getLike($tabela, $campo, $valor,$eh_lista, $posicao);
    } 
    
    public static  function getTotal($tabela, $campAgregacao, $campo=null,  $valor=null){
        $dao = new Dao();
        $valor =  $dao->getTotal($tabela,  $campAgregacao, $campo,  $valor)->total;
        return $valor ? $valor: 0;
    }
    
    public static  function getSoma($tabela, $campAgregacao, $campo=null,  $valor=null){
        $dao = new Dao();
        $valor =  $dao->getSoma($tabela, $campAgregacao, $campo,  $valor)->soma;
        return $valor ? $valor: 0;      
    }
    
    public static  function getMinimo($tabela, $campAgregacao, $campo=null,  $valor=null){
        $dao = new Dao();
        return  $dao->getMinimo($tabela,  $campAgregacao, $campo,  $valor)->min;
    }
    
    public static  function getMaximo($tabela, $campAgregacao, $campo=null,  $valor=null){
        $dao = new Dao();
        return  $dao->getMaximo($tabela,  $campAgregacao, $campo,  $valor)->max;
    }
    public static  function getMedia($tabela, $campAgregacao, $campo=null,  $valor=null){
        $dao = new Dao();
        return  $dao->getMedia($tabela,  $campAgregacao, $campo,  $valor)->media;
    }
    
    public static function salvar($objeto, $campo, array $erros, $tabela){
        $resultado = false;
        if(!$erros){
            $dao = new Dao();
                       
            if($objeto->$campo){
           
                $resultado =  $dao->editar(objToArray($objeto),$campo, $tabela); 
                               
                if($resultado){
                    Flash::setMsg("Registro Alterado com sucesso",1);
                }else{
                    Flash::setMsg("Nenhum Registro foi alterado", -1) ;
                }
            }else{
               
                 $resultado =  $dao->inserir(objToArray($objeto), $tabela);
                     
                if($resultado){
                    
                    Flash::setMsg("Registro inserido com sucesso",1);
                }else{
                    Flash::setMsg("Não foi Possível Inserir os dados", -1) ;
                }
            }
            Flash::limpaForm();
            return $resultado;
        }else{
          
            Flash::limpaErro();
            Flash::setErro($erros);
        }
        return false;
    }
    public static function salvarAluno($objeto, $campo, array $erros, $tabela){
       
        $resultado = false;
        if(!$erros){
            $dao = new Dao();
            if($objeto->$campo){
               $valor = Service::lista($tabela);
               for($i = 0; $i < count($valor); $i++){
                    if($valor[$i]->cpf == $objeto->cpf  && $valor[$i]->id_aluno != $objeto->id_aluno){
                    $resultado = 1;
                    break;
                    }else if($valor[$i]->email == $objeto->email  && $valor[$i]->id_aluno != $objeto->id_aluno){
                        $resultado = 2;
                        break;
                    }else{$resultado = 0;}   
                }    
                    if($resultado !=1 && $resultado!=2 ){
                       
                        $resultado =  $dao->editar(objToArray($objeto),$campo, $tabela);
                        Flash::setMsg("Registro Alterado com sucesso",1);
                        Flash::limpaForm();
                        return true;
                    }else{
                        if($resultado == 1){
                            Flash::setMsg("Já existe este CPF Cadastrado", -1);
                            Flash::limpaForm();
                        }
                        if($resultado == 2){
                            Flash::setMsg("Já existe este Email Cadastrado", -1);
                        }
                    }  
            }else{
                    $resultado =  $dao->inserirAluno(objToArray($objeto), $tabela);
                    if($resultado !=1 && $resultado!=2 ){
                        Flash::setMsg("Registro inserido com sucesso",1);
                    }else{
                        if($resultado == 1){
                            Flash::setMsg("Já existe este CPF Cadastrado", -1);
                            Flash::limpaForm();
                        }
                        if($resultado == 2){
                            Flash::setMsg("Já existe este Email Cadastrado", -1);
                        }
                }
            }
        }else{
            Flash::limpaErro();
            Flash::setErro($erros);
        }
        return false;
    }
   
    public static function salvarCargo($objeto, $campo, array $erros, $tabela){
    
        $resultado = false;
        if(!$erros){
            
            $dao = new Dao();
                       
            if($objeto->$campo){
               
                $resultado =  $dao->editar(objToArray($objeto),$campo, $tabela); 
                               
                if($resultado){
                    Flash::setMsg("Registro Alterado com sucesso",1);
                }else{
                    Flash::setMsg("Nenhum Registro foi alterado", -1) ;
                }
            }else{
                
                 $resultado =  $dao->inserirCargo(objToArray($objeto), $tabela);
                     
                if($resultado){
                    Flash::setMsg("Registro inserido com sucesso",1);
                }else{
                    Flash::setMsg("Já existe um cargo com esse nome", -1);
                }
            }
            Flash::limpaForm();
            return $resultado;
        }else{
            Flash::limpaErro();
            Flash::setErro($erros);
        }
        return false;
    }

    public static function salvarcargocurso($objeto, $campo, array $erros, $tabela){

        $resultado = false;
        if(!$erros){
            
            $dao = new Dao();
                       
            if($objeto->$campo){
               
                $resultado =  $dao->editar(objToArray($objeto),$campo, $tabela); 
                               
                if($resultado){
                    Flash::setMsg("Registro Alterado com sucesso",1);
                }else{
                    Flash::setMsg("Nenhum Registro foi alterado", -1) ;
                }
            }else{
                
                 $resultado =  $dao->inserir(objToArray($objeto), $tabela);
                     
                if($resultado){
                    
                    Flash::setMsg("Registro inserido com sucesso",1);
                }else{
                    Flash::setMsg("Não foi Possível Inserir os dados pois já existe esse(s) curso(s) registrado(s) neste(s) Cargo(s)!", -1) ;
                }
            }
            Flash::limpaForm();
            return $resultado;
        }else{
            Flash::limpaErro();
            Flash::setErro($erros);
        }
        return false;
    }

    public static function salvarcargocursoEdit($objeto, $campo, array $erros, $tabela){

        $resultado = false;
        if(!$erros){
            
            $dao = new Dao();
                       
            if($objeto->$campo){
               
                $resultado =  $dao->editar(objToArray($objeto),$campo, $tabela); 
                               
                if($resultado){
                    Flash::setMsg("Registro Alterado com sucesso",1);
                }else{
                    Flash::setMsg("Nenhum Registro foi alterado", -1) ;
                }
            }else{
                
                 $resultado =  $dao->inserir(objToArray($objeto), $tabela);
                     
                if($resultado){
                    
                    Flash::setMsg("Registro inserido com sucesso",1);
                }else{
                    Flash::setMsg("Não foi Possível Inserir os dados pois já existe esse(s) curso(s) registrado(s) neste(s) Cargo(s)!", -1) ;
                }
            }
            Flash::limpaForm();
            return $resultado;
        }else{
            Flash::limpaErro();
            Flash::setErro($erros);
        }
        return false;
    }
    public static function logar($campo, $valor, $senha, $tabela){
        $dao = new Dao();
        Flash::limpaForm();
        Flash::limpaMsg();
        $resultado = $dao->get($tabela, $campo, $valor,false);
        
        if($resultado){
            if($resultado->senha_usuario == $senha){
                $_SESSION[SESSION_LOGIN] = $resultado;
                return true;
            }
        }
        Flash::setMsg("Login ou senha não encontrados",-1);
        unset($_SESSION[SESSION_LOGIN]);
        return false;
    }
    
    public static function inserir($dados, $tabela){
        $dao = new Dao();
        return  $dao->inserir($dados, $tabela);
    }
    
    public static function editar($dados, $campo, $tabela){
        $dao = new Dao();
        return  $dao->editar($dados, $campo, $tabela);
    }
    
    public static function excluir($tabela, $campo, $valor){
       
        $dao = new Dao();
        $excluir = $dao->excluir($tabela, $campo, $valor);
        if($excluir){
            Flash::setMsg("Registro Exluído com Sucesso !");
           
        }else{
            Flash::setMsg("Não foi possível excluir o registro",-1);
        }        
        return  $excluir;
    }

    public static function excluircargo($tabela, $campo, $valor){
        
      $dados["lista"] = Service::getcargocurso("cargo_curso","id_cargo",$valor,true);
      if($dados["lista"][0]->id_cargo == $valor){
        Flash::setMsg("Exclusão Inválida , existem cursos cadastrados para este cargo!",-1);
    }else{
        $dao = new Dao();
        $excluir = $dao->excluir($tabela, $campo, $valor);
        if($excluir){
            Flash::setMsg("Registro Exluído com Sucesso !");
            
        }else{
            Flash::setMsg("Não foi possível excluir o registro",-1);
        }
    }
       return  $excluir;

   }

   public static function excluircurso($tabela, $campo, $valor){
    
    $dados["lista"] = Service::getcargocurso("cargo_curso","id_curso",$valor,true);
   
    if($dados["lista"][0]->id_cargo == $valor){
      Flash::setMsg("Exclusão Inválida , este curso está cadastrado num cargo!",-1);
  }else{
      $dao = new Dao();
      $excluir = $dao->excluir($tabela, $campo, $valor);
      if($excluir){
          Flash::setMsg("Registro Exluído com Sucesso !");
      }else{
          Flash::setMsg("Não foi possível excluir o registro",-1);
      }
  }
     return  $excluir;

 }
  
    
   
}

