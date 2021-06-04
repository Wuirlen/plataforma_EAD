<?php

namespace app\models;

use app\core\Model;
use PDO;

class CursoModel extends Model
{
    public function detalheCurso($id_curso)
    {
        $sql = "SELECT * FROM cargo_curso  JOIN aluno ON cargo_curso.id_cargo = aluno.id_cargo_aluno  JOIN curso ON curso.id_curso = :id_curso";
        $qry = $this->db->prepare($sql);
        $qry->bindValue(":id_curso", $id_curso);
        $qry->execute();
        return $qry->fetch(\PDO::FETCH_OBJ);
    }
    public function detalheAluno($id_aluno)
    {
        $sql = "SELECT * FROM aluno where id_aluno = {$id_aluno}";
        $qry = $this->db->prepare($sql);
        $qry->bindValue(":id_curso", $id_aluno);
        $qry->execute();
        return $qry->fetch(\PDO::FETCH_OBJ);
    }
    public function valida_certificado_se_existe_prova($id_curso)
    {
        $sql = "SELECT * FROM modulo INNER JOIN avaliacao ON modulo.id_modulo = avaliacao.id_modulo WHERE modulo.id_curso = {$id_curso}";
        $qry = $this->db->prepare($sql);
        $qry->bindValue(":id_curso", $id_curso);
        $qry->execute();
        return $qry->fetch(\PDO::FETCH_OBJ);
    }

    public function quantidadeTotaldequest_por_curso($id_curso)
    {
        $sql = "SELECT count(*) as total_quest FROM modulo INNER JOIN avaliacao ON avaliacao.id_modulo = modulo.id_modulo WHERE modulo.id_curso = 1";
        $qry = $this->db->prepare($sql);
        $qry->execute();
        return $qry->fetch(\PDO::FETCH_OBJ);
    }
    public function pega_data_aprovado($id_curso,$id_aluno)
    {
        $sql = "SELECT aluno_avaliacao.data_avaliacao FROM modulo INNER JOIN aluno_avaliacao ON modulo.id_modulo = aluno_avaliacao.id_modulo
        WHERE aluno_avaliacao.id_aluno = {$id_aluno} AND modulo.id_curso = {$id_curso} ORDER BY aluno_avaliacao.id_aluno_avaliacao DESC LIMIT 1";
        $qry = $this->db->prepare($sql);
        $qry->execute();
        return $qry->fetch(\PDO::FETCH_OBJ);
    }

    public function excluir_para_refazer_curso($id_curso,$id_aluno,$data_hoje)
    {
        
        $sql_historico_aula_assistida = "SELECT data_registro_historico FROM historico_aluno WHERE id_curso = {$id_curso} AND id_aluno = {$id_aluno}  ORDER BY data_registro_historico asc LIMIT 1";
        $qry_historico_aula_assistida = $this->db->prepare($sql_historico_aula_assistida);
        $qry_historico_aula_assistida->execute();
        $historico_aulas_assistidas =  $qry_historico_aula_assistida->fetch(\PDO::FETCH_OBJ);
        
        
        $data_historico_aluno = explode("-",$historico_aulas_assistidas->data_registro_historico);
        
         
        if(empty($historico_aulas_assistidas->data_registro_historico) || $data_historico_aluno[1] < $data_hoje || $data_historico_aluno[1] = 12 && $data_hoje = 1  ){
        
        $sql_aula_assistida = "SELECT * FROM aula_assistida WHERE id_curso = {$id_curso} AND id_aluno = {$id_aluno}";
        $qry_aula_assistida = $this->db->prepare($sql_aula_assistida);
        $qry_aula_assistida->execute();
        $aulas_assistidas =  $qry_aula_assistida->fetchAll(\PDO::FETCH_OBJ);
          $data = date("Y-m-d");
          foreach($aulas_assistidas as $aula_assistida){
           
              $sql = "INSERT INTO historico_aluno (id_aula_assistida,id_aula,id_curso,data_assistida,hora_assistida,id_aluno,data_registro_historico) values('$aula_assistida->id_aula_assistida','$aula_assistida->id_aula','$aula_assistida->id_curso','$aula_assistida->data_assistida','$aula_assistida->hora_assistida','$aula_assistida->id_aluno','$data')";
              $qry = $this->db->prepare($sql);
              $qry->execute();
              
            
          }
        

        $sql_aluno_avaliacao = "SELECT aluno_avaliacao.* FROM modulo INNER JOIN aluno_avaliacao ON modulo.id_modulo = aluno_avaliacao.id_modulo WHERE id_curso = {$id_curso} AND id_aluno = {$id_aluno}";
        $qry_aluno_avaliacao = $this->db->prepare($sql_aluno_avaliacao);
        $qry_aluno_avaliacao->execute();
        $alunos_avaliacoes =  $qry_aluno_avaliacao->fetchAll(\PDO::FETCH_OBJ);
      
        foreach($alunos_avaliacoes as $aluno_avaliacao){
        
        $sql = "INSERT INTO historico_aluno (id_aluno_avaliacao,id_aluno,id_modulo,titulo_questao,resposta,data_avaliacao,id_curso,data_registro_historico) values('$aluno_avaliacao->id_aluno_avaliacao','$aluno_avaliacao->id_aluno','$aluno_avaliacao->id_modulo','$aluno_avaliacao->titulo_questao','$aluno_avaliacao->resposta','$aluno_avaliacao->data_avaliacao','$id_curso','$data')";
        $qry = $this->db->prepare($sql);
        $qry->execute();
             
        }


        $sql_aluno_reprovacao = "SELECT aluno_reprovacao.* FROM modulo INNER JOIN aluno_reprovacao ON modulo.id_modulo = aluno_reprovacao.id_modulo WHERE id_curso = {$id_curso} AND id_aluno = {$id_aluno}";
        $qry_aluno_reprovacao = $this->db->prepare($sql_aluno_reprovacao);
        $qry_aluno_reprovacao->execute();
        $alunos_reprovacoes =  $qry_aluno_reprovacao->fetchAll(\PDO::FETCH_OBJ);

        foreach($alunos_reprovacoes as $aluno_reprovacao){
          
         $sql = "INSERT INTO historico_aluno (id_aluno_reprovacao,id_aluno,id_modulo,titulo_questao,resposta,data_avaliacao,id_curso,data_registro_historico) values('$aluno_reprovacao->id_aluno_reprovacao','$aluno_reprovacao->id_aluno','$aluno_reprovacao->id_modulo','$aluno_reprovacao->titulo_questao','$aluno_reprovacao->resposta','$aluno_reprovacao->data_avaliacao','$id_curso','$data')";
         $qry = $this->db->prepare($sql);
         $qry->execute();
                
        }

        $sql_excluir_aula_assistida = "DELETE FROM aula_assistida WHERE id_curso = {$id_curso} AND id_aluno = {$id_aluno}";
        $qry_excluir_aula_assistida = $this->db->prepare($sql_excluir_aula_assistida);
        $qry_excluir_aula_assistida->execute();

        $sql_aluno_avaliacao = "DELETE aluno_avaliacao.* FROM aluno_avaliacao INNER JOIN modulo ON modulo.id_modulo = aluno_avaliacao.id_modulo 
        WHERE aluno_avaliacao.id_aluno = {$id_aluno} AND modulo.id_curso = {$id_curso}";
        $qry_aluno_avaliacao = $this->db->prepare($sql_aluno_avaliacao);
        $qry_aluno_avaliacao->execute();
        
        $sql_aluno_reprovacao = "DELETE aluno_reprovacao.* FROM aluno_reprovacao INNER JOIN modulo ON modulo.id_modulo = aluno_reprovacao.id_modulo 
        WHERE aluno_reprovacao.id_aluno = {$id_aluno} AND modulo.id_curso = {$id_curso}";
        $qry_aluno_reprovacao = $this->db->prepare($sql_aluno_reprovacao);
        $qry_aluno_reprovacao->execute();

    }
        // echo"<pre>";
        // print_r($aluno_avaliacao);
        // echo"<pre>";
        // print_r($aluno_reprovacao);

    }
    public function pega_data_reprovado($id_curso,$id_aluno)
    {
        $sql = "SELECT * FROM modulo INNER JOIN aluno_reprovacao ON modulo.id_modulo = aluno_reprovacao.id_modulo
        WHERE aluno_reprovacao.id_aluno = {$id_aluno} AND modulo.id_curso = {$id_curso} ORDER BY aluno_reprovacao.id_aluno_reprovacao DESC LIMIT 1";
        $qry = $this->db->prepare($sql);
        $qry->execute();
        return $qry->fetch(\PDO::FETCH_OBJ);
    }

    public function quantidadeTotaldequest_por_tabela_reprovado($id_aluno, $id_curso)
    {
        $sql = "SELECT count(aluno_reprovacao.resposta) AS total_acertadas_reprovado from aluno_reprovacao 
    INNER JOIN modulo  ON aluno_reprovacao.id_modulo = modulo.id_modulo
    inner JOIN avaliacao ON avaliacao.id_modulo = modulo.id_modulo 
    AND aluno_reprovacao.titulo_questao = avaliacao.titulo_pergunta
    WHERE modulo.id_curso = {$id_curso} AND aluno_reprovacao.id_aluno = {$id_aluno} AND aluno_reprovacao.resposta = avaliacao.resposta";
        $qry = $this->db->prepare($sql);
        $qry->execute();
        return $qry->fetch(\PDO::FETCH_OBJ);
    }
    public function quantidadeTotaldequest_por_tabela_aprovado($id_aluno, $id_curso)
    {
        $sql = "SELECT count(aluno_avaliacao.resposta) AS total_acertadas_aprovadas from aluno_avaliacao INNER JOIN modulo  ON aluno_avaliacao.id_modulo = modulo.id_modulo
        inner JOIN avaliacao ON avaliacao.id_modulo = modulo.id_modulo 
        AND aluno_avaliacao.titulo_questao = avaliacao.titulo_pergunta
        WHERE modulo.id_curso = {$id_curso} AND aluno_avaliacao.id_aluno = {$id_aluno} AND aluno_avaliacao.resposta = avaliacao.resposta";
        $qry = $this->db->prepare($sql);
        $qry->execute();
        return $qry->fetch(\PDO::FETCH_OBJ);
    }
    public function qtdeAulaPorCurso($id_curso)
    {
        $sql = "SELECT count(*) qtde FROM aula WHERE
        id_curso = :id_curso";

        $qry = $this->db->prepare($sql);
        $qry->bindValue(":id_curso", $id_curso);
        $qry->execute();

        return $qry->fetch(\PDO::FETCH_OBJ);
    }
    public function qtdeAulaAssistidaPorCurso($id_curso,$id_aluno)
    {
        $sql = "SELECT COUNT(*) qtd_assistidas FROM aula INNER JOIN aula_assistida ON aula.id_aula = aula_assistida.id_aula 
        WHERE aula_assistida.id_aluno = {$id_aluno} AND aula.id_curso = {$id_curso}";

        $qry = $this->db->prepare($sql);
        $qry->bindValue(":id_curso", $id_curso);
        $qry->bindValue(":id_aluno", $id_aluno);
        $qry->execute();

        return $qry->fetch(\PDO::FETCH_OBJ);
    }
    public function quantidade_aulas_assistidas_modulo($id_aluno,$id_curso) {
        $sql = "SELECT modulo.id_modulo,COUNT(*) AS qtd FROM aula INNER JOIN aula_assistida ON aula.id_aula = aula_assistida.id_aula 
        INNER JOIN modulo ON modulo.id_modulo = aula.id_modulo
        WHERE aula_assistida.id_aluno = {$id_aluno} AND aula.id_curso = {$id_curso} GROUP BY modulo.id_modulo ORDER by modulo.id_modulo ASC"; 
        $qry = $this->db->prepare($sql);
        $qry->bindValue(":id_aluno", $id_aluno);
        $qry->execute();
        return $qry->fetchALL(\PDO::FETCH_OBJ);
    }
 public function quantidade_total_aulas_modulo($id_curso) {
        $sql = "SELECT COUNT(*) AS qtd_total FROM aula INNER JOIN modulo ON aula.id_modulo = modulo.id_modulo WHERE aula.id_curso = {$id_curso}
        GROUP BY modulo.id_modulo ORDER by modulo.id_modulo ASC"; 
        $qry = $this->db->prepare($sql);
        $qry->bindValue(":id_curso", $id_curso);
        $qry->execute();
        return $qry->fetchALL(\PDO::FETCH_OBJ);
    }
     public function verifica_se_existe_prova_feita_aprovado($id_aluno,$id_curso) {
        $sql = "SELECT * FROM aluno_avaliacao INNER JOIN modulo ON aluno_avaliacao.id_modulo = modulo.id_modulo
        WHERE modulo.id_curso = {$id_curso} AND aluno_avaliacao.id_aluno = {$id_aluno}"; 
        $qry = $this->db->prepare($sql);
        $qry->bindValue(":id_aluno", $id_aluno);
        $qry->execute();
        return $qry->fetchALL(\PDO::FETCH_OBJ);
    }
    public function verifica_se_existe_prova_feita_reprovado($id_aluno,$id_curso) {
        $sql = "SELECT * FROM aluno_reprovacao INNER JOIN modulo ON aluno_reprovacao.id_modulo = modulo.id_modulo
        WHERE modulo.id_curso = {$id_curso} AND aluno_reprovacao.id_aluno = {$id_aluno}"; 
        $qry = $this->db->prepare($sql);
        $qry->bindValue(":id_aluno", $id_aluno);
        $qry->execute();
        return $qry->fetchALL(\PDO::FETCH_OBJ);
    }
    public function listaCursosMatriculados($id_aluno)
    {
        $sql = "SELECT * FROM cargo_curso  JOIN aluno ON cargo_curso.id_cargo = aluno.id_cargo_aluno AND aluno.id_aluno = {$id_aluno} JOIN curso ON curso.id_curso = cargo_curso.id_curso";
        $qry = $this->db->prepare($sql);
        $qry->bindValue(":id_aluno", $id_aluno);
        $qry->execute();
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }
}