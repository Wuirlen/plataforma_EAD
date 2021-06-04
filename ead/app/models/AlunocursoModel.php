<?php 

namespace app\models;
use app\core\Model;
use PDO;

class AlunocursoModel extends Model{
    protected $db;
    protected $tabela;
    public function listaCursosMatriculados($id_aluno) {
        $sql = "SELECT * FROM cargo_curso  JOIN aluno ON cargo_curso.id_cargo = aluno.id_cargo_aluno AND aluno.id_aluno = {$id_aluno} JOIN curso ON curso.id_curso = cargo_curso.id_curso"; 
        $qry = $this->db->prepare($sql);
        $qry->bindValue(":id_aluno", $id_aluno);
        $qry->execute();

        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }
    public function listaCursosMatriculadosGeral($id_aluno) { 
        $sql = "SELECT * FROM curso INNER JOIN aluno ON aluno.id_aluno = {$id_aluno} WHERE curso.ativo_curso = 'S'"; 
        $qry = $this->db->prepare($sql);
        $qry->bindValue(":id_aluno", $id_aluno);
        $qry->execute();

        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }
    public function dados_aluno($id_aluno) {
        $sql = "SELECT * FROM cargo  JOIN aluno ON cargo.id_cargo = aluno.id_cargo_aluno AND aluno.id_aluno = {$id_aluno};"; 
        $qry = $this->db->prepare($sql);
        $qry->bindValue(":id_aluno", $id_aluno);
        $qry->execute();
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }
    function acesso_atual($data,$id_aluno,$valor){
       
        $sql = "UPDATE aluno set  acesso_atual='$data' where id_aluno = '$id_aluno'";
        $qry = $this->db->prepare($sql);
        $qry->execute();
        if($valor == 1){
            $sql = "UPDATE aluno set  acesso_anterior='$data' where id_aluno = '$id_aluno'";
            $qry = $this->db->prepare($sql);
            $qry->execute();
        }
    }
    function acesso_anterior($id_aluno){
        $sql = "SELECT DATE_FORMAT(acesso_anterior,'%d/%m/%Y') FROM aluno where id_aluno = '$id_aluno'";
        $qry = $this->db->prepare($sql);
        $qry->bindValue(":id_aluno", $id_aluno);
        $qry->execute();
        return $qry->fetch(\PDO::FETCH_OBJ);
    }
    public function valida_email(){
        $sql = "SELECT email FROM aluno;"; 
        $qry = $this->db->prepare($sql);
        $qry->execute();
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }
    public function editar( $valores, $campo, $tabela){
       
        return $this->edit($this->db, $valores,$campo, $tabela);
        
    }
}
