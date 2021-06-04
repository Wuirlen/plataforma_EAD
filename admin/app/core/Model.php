<?php

namespace app\core;

use app\models\service\Service;
use Exception;
abstract class Model{
    protected $db;
    protected $tabela;
    
    public function __construct() {
        $this->db = Conexao::getConexao();
    }
    
    //Serve para fazer consultas utilizando parametros
    function consultar($conn, $sql, $parametro = array(), $isLista=true ){
        $stmt = $conn->prepare($sql);
        if(!$parametro){
            throw new  Exception("É necessário enviar os parâmetros para o método consultar");
        }
        
        try {
            foreach($parametro as $chave=>$valor){
                $stmt->bindValue(":$chave", $valor);
            }
            $stmt->execute();
            if($isLista){
                return $stmt->fetchAll(\PDO::FETCH_OBJ);
            }else{
                return $stmt->fetch(\PDO::FETCH_OBJ);
            }
        }catch (\PDOException $e){
            throw new \Exception($e->getMessage());
        }
    }
    
    //Serve para fazer consultas diversas, sem parâmetros
    function select($conn, $sql, $isLista=true ){
        try {
            $stmt = $conn->query($sql);
            if($isLista){
                return $stmt->fetchAll(\PDO::FETCH_OBJ);
            }else{
                return $stmt->fetch(\PDO::FETCH_OBJ);
            }
        }catch (\PDOException $e){
            throw new \Exception($e->getMessage());
        }
    }
    
    //Retorna uma lista da tabela
    function all($conn, $tabela =null){
        $tabela = ($tabela) ? $tabela: $this->tabela;
        try {
            $sql = "SELECT * FROM ". $tabela;
            $stmt = $conn->query($sql);
            return $stmt->fetchAll(\PDO::FETCH_OBJ);
            
        }catch (\PDOException $e){
            throw new \Exception($e->getMessage());
        }
    }
    function all_aula_assistida($conn, $tabela =null,$id_aluno,$id){
     
        $tabela = ($tabela) ? $tabela: $this->tabela;
        try {
            $sql = "SELECT titulo_aula, data_assistida,id_aluno,aula_assistida.id_curso FROM aula_assistida INNER JOIN aula ON aula.id_aula = aula_assistida.id_aula
            AND aula.id_curso = aula_assistida.id_curso WHERE aula_assistida.id_aluno = {$id_aluno} AND aula_assistida.id_curso = {$id}";
            $stmt = $conn->query($sql);
            return $stmt->fetchAll(\PDO::FETCH_OBJ);
            
        }catch (\PDOException $e){
            throw new \Exception($e->getMessage());
        }
    }
    function all_aula_assistida_modulo($conn, $tabela =null){
        $tabela = ($tabela) ? $tabela: $this->tabela;
        try {
            $sql = "SELECT * FROM aula_assistida";
            $stmt = $conn->query($sql);
            return $stmt->fetchAll(\PDO::FETCH_OBJ);
            
        }catch (\PDOException $e){
            throw new \Exception($e->getMessage());
        }
    }

    function allWhere($conn, $tabela =null, $nome_campo, $campo){
        $tabela = ($tabela) ? $tabela: $this->tabela;
        try {
            $sql = "SELECT ($nome_campo) FROM $tabela WHERE $nome_campo = '$campo'";
            $stmt = $conn->query($sql);
            return $stmt->fetch(\PDO::FETCH_OBJ);
            
        }catch (\PDOException $e){
            throw new \Exception($e->getMessage());
        }
    }
   
  

    // INNER JOIN SEM WHERE
    function all_join($conn, $tabela =null){
        $tabela = ($tabela) ? $tabela: $this->tabela;
        try {
            $sql = "SELECT cargo.id_cargo,nome_cargo,nome_curso, curso.id_curso  FROM cargo_curso INNER JOIN cargo 
            ON cargo_curso.id_cargo = cargo.id_cargo 
            INNER JOIN curso 
            ON cargo_curso.id_curso = curso.id_curso";
            $stmt = $conn->query($sql);
            return $stmt->fetchAll(\PDO::FETCH_OBJ);
            
        }catch (\PDOException $e){
            throw new \Exception($e->getMessage());
        }
    }
    function all_join_desempenho_curso($conn, $tabela=null,$id){
    
        $tabela = ($tabela) ? $tabela: $this->tabela;
        try {
            $sql = "SELECT nome_curso,id_cargo,curso.id_curso,nome_aluno,id_cargo_aluno,id_aluno FROM curso INNER JOIN cargo_curso ON curso.id_curso = cargo_curso.id_curso INNER JOIN aluno
            ON aluno.id_cargo_aluno = cargo_curso.id_cargo  WHERE curso.id_curso = {$id}";
            $stmt = $conn->query($sql);
            return $stmt->fetchAll(\PDO::FETCH_OBJ);
            
        }catch (\PDOException $e){
            throw new \Exception($e->getMessage());
        }
    }
    function all_joinModulo($conn, $tabela =null){
        $tabela = ($tabela) ? $tabela: $this->tabela;
        try {
            $sql = "SELECT modulo.titulo_modulo, curso.nome_curso, modulo.id_modulo FROM modulo JOIN curso ON curso.id_curso = modulo.id_curso            ";
            $stmt = $conn->query($sql);
            return $stmt->fetchAll(\PDO::FETCH_OBJ);
            
        }catch (\PDOException $e){
            throw new \Exception($e->getMessage());
        }
    }
    function all_join_aluno($conn, $tabela =null){
        $tabela = ($tabela) ? $tabela: $this->tabela;
        try {
            $sql = "SELECT aluno.id_aluno,aluno.nome_aluno, aluno.email, aluno.telefone,aluno.matricula, cargo.nome_cargo  FROM aluno INNER JOIN cargo 
            ON cargo.id_cargo = aluno.id_cargo_aluno";
            $stmt = $conn->query($sql);
            return $stmt->fetchAll(\PDO::FETCH_OBJ);
            
        }catch (\PDOException $e){
            throw new \Exception($e->getMessage());
        }
    }
       // INNER JOIN SEM WHERE
       function contaValoresRepetidos($conn, $tabela =null){
        $tabela = ($tabela) ? $tabela: $this->tabela;
        try {
            $sql = "SELECT cargo_curso.id_cargo,cargo_curso.id_curso,cargo_curso.id_cargo_curso, cargo.nome_cargo, COUNT(cargo_curso.id_cargo) AS Qtd FROM cargo_curso 
            INNER JOIN cargo ON cargo_curso.id_cargo = cargo.id_cargo
            GROUP BY cargo_curso.id_cargo
            HAVING COUNT(cargo_curso.id_cargo) > 0 ORDER BY COUNT(cargo_curso.id_cargo) DESC";
            $stmt = $conn->query($sql);
            return $stmt->fetchAll(\PDO::FETCH_OBJ);
        }catch (\PDOException $e){
            throw new \Exception($e->getMessage());
        }
    }
    function contaValoresRepetidos_desempenho_curso($conn, $tabela =null){
        $tabela = ($tabela) ? $tabela: $this->tabela;
        try {
            $sql = "SELECT aula.id_curso,nome_curso,curso.id_curso,COUNT(aula.id_aula) AS qtd FROM aula inner JOIN curso ON aula.id_curso = curso.id_curso 
            GROUP BY curso.nome_curso
            HAVING COUNT(curso.id_curso) > 0 ORDER BY COUNT(curso.id_curso) DESC";
            $stmt = $conn->query($sql);
            return $stmt->fetchAll(\PDO::FETCH_OBJ);
        }catch (\PDOException $e){
            throw new \Exception($e->getMessage());
        }
    }
    function conta_aluno_curso($conn, $tabela =null,$id){
        $tabela = ($tabela) ? $tabela: $this->tabela;
        try {
            $sql = "SELECT COUNT(id_aluno) AS QTD_ALUNO FROM curso INNER JOIN cargo_curso ON curso.id_curso = cargo_curso.id_curso INNER JOIN aluno
            ON aluno.id_cargo_aluno = cargo_curso.id_cargo  WHERE curso.id_curso = {$id}";
            $stmt = $conn->query($sql);
            return $stmt->fetchAll(\PDO::FETCH_OBJ);
        }catch (\PDOException $e){
            throw new \Exception($e->getMessage());
        }
    }
    function rank($conn, $tabela =null){
        $tabela = ($tabela) ? $tabela: $this->tabela;
        try {
            $sql = "SELECT aluno.nome_aluno,COUNT(avaliacao.resposta) AS qtd_acertada, avaliacao.resposta AS resp_av, aluno_avaliacao.resposta AS resp_aluno, aluno_avaliacao.id_aluno 
            from avaliacao INNER JOIN aluno_avaliacao 
            ON avaliacao.titulo_pergunta = aluno_avaliacao.titulo_questao 
            AND avaliacao.resposta = aluno_avaliacao.resposta INNER JOIN aluno ON aluno.id_aluno = aluno_avaliacao.id_aluno GROUP BY aluno_avaliacao.id_aluno 
            ORDER BY qtd_acertada DESC";
            $stmt = $conn->query($sql);
            return $stmt->fetchAll(\PDO::FETCH_OBJ);
        }catch (\PDOException $e){
            throw new \Exception($e->getMessage());
        }
    }
    function contaValoresRepetidosModulo($conn, $tabela =null){
        $tabela = ($tabela) ? $tabela: $this->tabela;
        try {
            $sql = "SELECT modulo.titulo_modulo, curso.nome_curso,modulo.id_modulo, COUNT(aula.id_aula) AS qtd FROM aula JOIN modulo 
            ON aula.id_modulo = modulo.id_modulo JOIN curso ON modulo.id_curso = curso.id_curso
            GROUP BY modulo.id_modulo
            HAVING COUNT(modulo.id_modulo) > 0 ORDER BY COUNT(modulo.id_modulo) DESC";
            $stmt = $conn->query($sql);
            return $stmt->fetchAll(\PDO::FETCH_OBJ);
        }catch (\PDOException $e){
            throw new \Exception($e->getMessage());
        }
    }
         // INNER JOIN COM WHERE
         function all_joinwhere($conn, $tabela){
            $tabela = ($tabela) ? $tabela: $this->tabela;
            try {
                $sql = "SELECT id_cargo_curso, nome_cargo, nome_curso FROM cargo_curso INNER JOIN cargo 
                ON cargo_curso.id_cargo = cargo.id_cargo 
                INNER JOIN curso 
                ON cargo_curso.id_curso = curso.id_curso WHERE cargo.id_cargo = $tabela";
                $stmt = $conn->query($sql);
                return $stmt->fetchAll(\PDO::FETCH_OBJ);
                
            }catch (\PDOException $e){
                throw new \Exception($e->getMessage());
            }
        }
           // INNER JOIN Modulo
           function all_joinwhere_modulo($conn, $tabela,$id){
            $tabela = ($tabela) ? $tabela: $this->tabela;
            try {
                $sql = "SELECT * FROM aula INNER JOIN modulo ON aula.id_modulo = {$id} GROUP BY aula.id_aula";
                $stmt = $conn->query($sql);
                return $stmt->fetchAll(\PDO::FETCH_OBJ);
                
            }catch (\PDOException $e){
                throw new \Exception($e->getMessage());
            }
        }
    //Retorna uma consulta por um campo
    function find($conn, $campo, $valor, $tabela=null, $isLista=false ){
        $tabela = ($tabela) ? $tabela: $this->tabela;
        try {
            $sql = "SELECT * FROM ". $tabela . " WHERE " . $campo . " =:campo " ;
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(":campo", $valor);
            $stmt->execute();
            if($isLista){
                return $stmt->fetchAll(\PDO::FETCH_OBJ);
            }else{
                return $stmt->fetch(\PDO::FETCH_OBJ);
            }
            
        }catch (\PDOException $e){
            throw new \Exception($e->getMessage());
        }
    }   
    function findcheckbox($conn, $campo, $valor, $tabela=null, $isLista=false ){
        $tabela = ($tabela) ? $tabela: $this->tabela;
        try {
            $sql = "SELECT * FROM ". $tabela . " WHERE " . $campo . " =:campo";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(":campo", $valor);
            $stmt->execute();
            
            if($isLista){
                return $stmt->fetchAll(\PDO::FETCH_OBJ);
            }else{
                return $stmt->fetchAll(\PDO::FETCH_OBJ);
            }
            
        }catch (\PDOException $e){
            throw new \Exception($e->getMessage());
        }
    }  
    
    function findcargocurso($conn, $campo, $valor, $tabela=null, $isLista=false ){
        $tabela = ($tabela) ? $tabela: $this->tabela;
        try {
            $sql = "SELECT * FROM ". $tabela . " WHERE " . $campo . " =:campo LIMIT 1" ;
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(":campo", $valor);
            $stmt->execute();
            if($isLista){
                return $stmt->fetchAll(\PDO::FETCH_OBJ);
            }else{
                return $stmt->fetch(\PDO::FETCH_OBJ);
            }
            
        }catch (\PDOException $e){
            throw new \Exception($e->getMessage());
        }
    } 
    
    //Retorna uma consulta por um campo
    function findGeral($conn, $campo, $operador, $valor, $tabela=null, $isLista=false ){
        $tabela = ($tabela) ? $tabela: $this->tabela;
        try {
            $sql = "SELECT * FROM ". $tabela . " WHERE " . $campo . $operador . " :campo " ;
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(":campo", $valor);
            $stmt->execute();
            if($isLista){
                return $stmt->fetchAll(\PDO::FETCH_OBJ);
            }else{
                return $stmt->fetch(\PDO::FETCH_OBJ);
            }
            
        }catch (\PDOException $e){
            throw new \Exception($e->getMessage());
        }
    } 
 
    //Retorna uma consulta por um campo
    function findLike($conn, $campo, $valor, $tabela=null, $isLista=false, $posicao=null ){
        $tabela = ($tabela) ? $tabela: $this->tabela;
        try {
            $sql = "SELECT * FROM ". $tabela . " WHERE " . $campo .  " like :campo " ;
            $stmt = $conn->prepare($sql);
            if(!$posicao){
                $stmt->bindValue(":campo", "%". $valor."%");
            }else{
                if($posicao==1){
                    $stmt->bindValue(":campo", $valor."%");
                }else{
                    $stmt->bindValue(":campo", "%". $valor);
                }
            }
            
            $stmt->execute();
            if($isLista){
                return $stmt->fetchAll(\PDO::FETCH_OBJ);
            }else{
                return $stmt->fetch(\PDO::FETCH_OBJ);
            }
            
        }catch (\PDOException $e){
            throw new \Exception($e->getMessage());
        }
    }
    
    function findAgrega($conn, $tipo, $campoAgregacao, $tabela=null , $campo = null, $valor =null  ){
        $tabela = ($tabela) ? $tabela: $this->tabela;
        try {
            if($campo!=null && $valor!=null){
                $condicao = " WHERE " . $campo . " =:campo ";
            }else{
                $condicao = "";
            }
            
            if($tipo=="soma"){
                $sql = "SELECT sum($campoAgregacao) as soma FROM ". $tabela .$condicao;
            }else if($tipo=="total"){
                $sql = "SELECT count($campoAgregacao) as total FROM ". $tabela .$condicao;
            }else if($tipo=="media"){
                $sql = "SELECT avg($campoAgregacao) as media FROM ". $tabela .$condicao;
            }else if($tipo=="max"){
                $sql = "SELECT max($campoAgregacao) as max FROM ". $tabela .$condicao;
            }else if($tipo=="min"){
                $sql = "SELECT min($campoAgregacao) as min FROM ". $tabela .$condicao;
            }
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(":campo", $valor);
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_OBJ);            
            
        }catch (\PDOException $e){
            throw new \Exception($e->getMessage());
        }
    }
     
    //Retorna uma consulta por um campo
    function findEntre($conn, $campo, $valor1, $valor2, $tabela=null ){
        $tabela = ($tabela) ? $tabela: $this->tabela;
        try {
            $sql = "SELECT * FROM ". $tabela . " WHERE " . $campo . " between  :valor1 AND :valor2 " ;
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(":valor1", $valor1);
            $stmt->bindValue(":valor2", $valor2);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_OBJ);
        }catch (\PDOException $e){
            throw new \Exception($e->getMessage());
        }
    } 
    
    function add($conn, $dados, $tabela=null ){// funcao insert geral
        
        $tabela = ($tabela) ? $tabela: $this->tabela;
        
        if(!$dados){
            throw new Exception("É necessário enviar os parâmetros para o método add");
        }
        
        if(!is_array($dados)){
            throw new Exception("Para poder inserir os dados os valores precisam está em forma de array");
        }
        try {
            
            $campos 	= implode(", " , array_keys($dados));
           
         
            $valores 	= ":" . implode(", :" , array_keys($dados));
            
            $sql = "INSERT INTO {$tabela} ({$campos}) VALUES ({$valores})";
           
   
            $stmt = $conn->prepare($sql);
          
            foreach($dados as $chave=>$valor){
                $stmt->bindValue(":$chave", $valor);
              
            }
            if ($stmt->execute()){
            
                return $conn->lastInsertId();
            }
            return false;
        } catch (Exception $e) {
            //throw new \Exception($e->getMessage());
        }
    }
    function allWhereAluno($conn, $tabela =null, $nome_campo, $campo){
        $tabela = ($tabela) ? $tabela: $this->tabela;
        try {
            $sql = "SELECT ($nome_campo) FROM $tabela WHERE $nome_campo = '$campo'";
            $stmt = $conn->query($sql);
            return $stmt->fetch(\PDO::FETCH_OBJ);
            
        }catch (\PDOException $e){
            throw new \Exception($e->getMessage());
        }
    }
    function addAluno($conn, $dados, $tabela=null ){
     
        $tabela = ($tabela) ? $tabela: $this->tabela;
        if(!$dados){
            throw new Exception("É necessário enviar os parâmetros para o método add");
        }
        
        if(!is_array($dados)){
            throw new Exception("Para poder inserir os dados os valores precisam está em forma de array");
        }
        try {
            
            $campos 	= implode(", " , array_keys($dados));
           
         
            $valores 	= ":" . implode(", :" , array_keys($dados));

            $resultado = $this->allWhereAluno($conn ,$tabela, "cpf", $dados["cpf"]);
            $resultadoemail = $this->allWhereAluno($conn ,$tabela, "email", $dados["email"]);
            
            if(!$resultado){
            if(!$resultadoemail){    
            $sql = "INSERT INTO {$tabela} ({$campos}) VALUES ({$valores})";
            $stmt = $conn->prepare($sql);
            foreach($dados as $chave=>$valor){
                $stmt->bindValue(":$chave", $valor);
            }
            if ($stmt->execute()){
                return $conn->lastInsertId();
            }
            }else{
                return 2;
            } }else{
                if($resultadoemail){
                    return 3;
                }else{
                    return 1;
                } 
                }
        } catch (Exception $e) {
            //throw new \Exception($e->getMessage());
        }

    }
    

    function addCargo($conn, $dados, $tabela=null ){
    
        $tabela = ($tabela) ? $tabela: $this->tabela;
        if(!$dados){
            throw new Exception("É necessário enviar os parâmetros para o método add");
        }
        
        if(!is_array($dados)){
            throw new Exception("Para poder inserir os dados os valores precisam está em forma de array");
        }
        try {
            
            $campos 	= implode(", " , array_keys($dados));
           
         
            $valores 	= ":" . implode(", :" , array_keys($dados));

            $resultado = $this->allWhere($conn ,$tabela, "nome_cargo", $dados["nome_cargo"]);

            
            if(!$resultado){
                
            $sql = "INSERT INTO {$tabela} ({$campos}) VALUES ({$valores})";
            
   
            $stmt = $conn->prepare($sql);
           
            foreach($dados as $chave=>$valor){
                $stmt->bindValue(":$chave", $valor);
              
            }
            if ($stmt->execute()){
            
                return $conn->lastInsertId();
            }
            return false;

            }
        } catch (Exception $e) {
            //throw new \Exception($e->getMessage());
        }
    }
    
    function edit($conn, $dados, $campo, $tabela =null){
    
        $tabela = ($tabela) ? $tabela: $this->tabela;
        $parametro = null;
        
        if(!$dados){
            throw new Exception("É necessário enviar os parâmetros para o método edit");
        }
        
        if(!is_array($dados)){
            throw new Exception("Para poder editar os dados os valores precisam está em forma de array");
        }
        
        try {
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
        } catch (Exception $e) {
            throw new \Exception($e->getMessage());
        }        
    }
    
    function del($conn, $campo, $valor,$tabela=null){
        $tabela = ($tabela) ? $tabela: $this->tabela;
        
        if(!$campo || !$valor){
            throw new Exception("É necessário enviar o campo e o valor para fazer a exclusão");
        }
        try {
        
            $sql  = "DELETE FROM {$tabela} WHERE {$campo} = :valor";
        
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(":valor", $valor);
            $stmt->execute();
            return $stmt->rowCount() ;
        } catch (Exception $e) {
            throw new \Exception($e->getMessage());
        }
        
    }
}