<?php 

namespace app\models;
use app\core\Model;
use PDO;

class AulaModel extends Model{

    // Lista os detalhes da aula
    public function listaAulas($id_aula) {
        $sql = "SELECT * FROM aula  WHERE id_aula = :id_aula"; 

        $qry = $this->db->prepare($sql);
        $qry->bindValue(":id_aula", $id_aula);
        $qry->execute();
        
        return $qry->fetch(\PDO::FETCH_OBJ);
    }
    public function listaAulasAluno($id_aluno) {
        $sql = "SELECT * FROM aula_assistida  WHERE id_aluno = :id_aluno"; 

        $qry = $this->db->prepare($sql);
        $qry->bindValue(":id_aluno", $id_aluno);
        $qry->execute();
        
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }
    public function listaAulasAlunoInnerJoin($id_aluno, $id_aula) {
        $sql = "SELECT aula_assistida.id_aula_assistida, aula_assistida.id_aula, aula_assistida.id_aluno,
        aula_assistida.id_curso, aula_assistida.data_assistida, aula_assistida.hora_assistida,
        aula.titulo_aula, aula.embed_youtube, aula.slug_aula, aula.ativo_aula, aula.duracao_aula
        FROM aula_assistida JOIN aula ON aula_assistida.id_aula = :id_aula 
        JOIN aluno ON aluno.id_aluno = :id_aluno WHERE aula.id_aula = :id_aula"; 

        $qry = $this->db->prepare($sql);
        $qry->bindValue(":id_aluno", $id_aluno);
        $qry->bindValue(":id_aula",  $id_aula);
        $qry->execute();
        
        return $qry->fetch(\PDO::FETCH_OBJ);
    }

    // Lista as aulas de acordo com o curso
    public function listaAulasPorCurso($id_curso) {
    $sql = "SELECT * FROM curso JOIN aula ON curso.id_curso=aula.id_curso  AND aula.id_curso = {$id_curso}"; 
        $qry = $this->db->prepare($sql);
        $qry->bindValue(":id_curso", $id_curso);
        $qry->execute();
        
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }
    public function listaCursosMatriculados($id_aluno) {
        $sql = "SELECT * FROM cargo_curso  JOIN aluno ON cargo_curso.id_cargo = aluno.id_cargo_aluno AND aluno.id_aluno = {$id_aluno} JOIN curso ON curso.id_curso = cargo_curso.id_curso"; 
        $qry = $this->db->prepare($sql);
        $qry->bindValue(":id_aluno", $id_aluno);
        $qry->execute();
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }
}
