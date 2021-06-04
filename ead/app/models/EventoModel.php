<?php 

namespace app\models;
use app\core\Model;
use PDO;

class EventoModel extends Model{
    public function listaCursosMatriculados($id_aluno) {
        $sql = "SELECT * FROM cargo_curso  JOIN aluno ON cargo_curso.id_cargo = aluno.id_cargo_aluno AND aluno.id_aluno = {$id_aluno} JOIN curso ON curso.id_curso = cargo_curso.id_curso"; 
        $qry = $this->db->prepare($sql);
        $qry->bindValue(":id_aluno", $id_aluno);
        $qry->execute();
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }
}