<?php 

namespace app\models;
use app\core\Model;
use PDO;

class ComentarioModel extends Model{
   
    public function inserir($dados){
            $sql = "INSERT INTO comentario SET
            id_aula         = :id_aula,
            id_aluno        = :id_aluno,
            comentario      = :comentario,
            data_comentario = :data_comentario,
            hora_comentario = :hora_comentario
        ";

        $qry = $this->db->prepare($sql);
        $qry->bindValue(":id_aula", $dados->id_aula);
        $qry->bindValue(":id_aluno", $dados->id_aluno);
        $qry->bindValue(":comentario", $dados->comentario);
        $qry->bindValue(":data_comentario", date("Y-m-d"));
        $qry->bindValue(":hora_comentario", date("H:i:s"));
        $qry->execute();
 
        return $this->db->lastInsertId();
    }

    public function listaComentarios($id_aula){
        $sql = "SELECT * FROM comentario WHERE id_aula = :id_aula";

        $qry = $this->db->prepare($sql);
        $qry->bindValue(":id_aula", $id_aula);
        $qry->execute();

        return $qry->fetch(\PDO::FETCH_OBJ);
    }
    public function listaCursosMatriculados($id_aluno) {
        $sql = "SELECT * FROM cargo_curso  JOIN aluno ON cargo_curso.id_cargo = aluno.id_cargo_aluno AND aluno.id_aluno = {$id_aluno} JOIN curso ON curso.id_curso = cargo_curso.id_curso"; 
        $qry = $this->db->prepare($sql);
        $qry->bindValue(":id_aluno", $id_aluno);
        $qry->execute();
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }
}
