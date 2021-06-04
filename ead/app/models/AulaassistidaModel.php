<?php

namespace app\models;
use app\core\Model;

class AulaassistidaModel extends Model{

    public function getJaAssistiu($id_aula, $id_aluno){
        $sql = "SELECT * FROM aula_assistida WHERE id_aula = :id_aula 
        AND id_aluno = :id_aluno";
    
        $qry = $this->db->prepare($sql);
        $qry->bindValue(":id_aula", $id_aula);
        $qry->bindValue(":id_aluno", $id_aluno);
        $qry->execute();
        return $qry->fetch(\PDO::FETCH_OBJ);
    }
    public function getJNomeCurso($id_aula,$id_curso,$id_aluno){
        $sql = "SELECT aula.id_curso, curso.nome_curso, curso.id_curso
        FROM aula JOIN curso ON aula.id_curso = {$id_curso} AND curso.id_curso = {$id_curso}
        JOIN aluno ON id_aluno = {$id_aluno}";
        $qry = $this->db->prepare($sql);
        $qry->bindValue(":id_aluno", $id_aula);
        $qry->bindValue(":id_aluno", $id_aluno);
        $qry->bindValue(":id_curso", $id_curso);
        $qry->execute();
        return $qry->fetch(\PDO::FETCH_OBJ);
    }
    public function getModulo($id_curso){
        $sql = "SELECT modulo.titulo_modulo , modulo.id_modulo, modulo.titulo_avaliacao,modulo.id_curso FROM modulo  JOIN curso ON curso.id_curso= {$id_curso} and modulo.id_curso = {$id_curso}";
        $qry = $this->db->prepare($sql);
        $qry->bindValue(":id_curso", $id_curso);
        $qry->execute();
        return $qry->fetchALL(\PDO::FETCH_OBJ);
    }
    public function getModuloaula($id_modulo){
         
        $sql = "SELECT id_aula  FROM modulo INNER JOIN aula ON modulo.id_modulo = aula.id_modulo WHERE modulo.id_modulo = {$id_modulo}";
        $qry = $this->db->prepare($sql);
        $qry->bindValue(":id_curso", $id_modulo);
        $qry->execute();
        return $qry->fetchALL(\PDO::FETCH_OBJ);
    }
    public function getavaliacao(){
        $sql = "SELECT * FROM avaliacao INNER JOIN modulo ON avaliacao.id_modulo = modulo.id_modulo";
        $qry = $this->db->prepare($sql);
        $qry->execute();
        return $qry->fetchALL(\PDO::FETCH_OBJ);
    }

    public function getavaliacao_aluno($id_aluno,$id_modulo){
        $sql = "SELECT * FROM aluno_avaliacao WHERE id_aluno = {$id_aluno} AND id_modulo ={$id_modulo}";
        $qry = $this->db->prepare($sql);
        $qry->execute();
       return $qry->fetchAll(\PDO::FETCH_OBJ);
    
    }
    public function getproximomodulo($id_curso, $id_modulo){
          if($id_modulo != -1){
            $sql = "SELECT id_aula  FROM modulo INNER JOIN aula ON modulo.id_modulo = aula.id_modulo WHERE modulo.id_curso = {$id_curso} AND modulo.id_modulo = {$id_modulo}";
            $qry = $this->db->prepare($sql);
            $qry->bindValue(":id_curso", $id_curso);
            $qry->bindValue(":id_modulo", $id_modulo);
          
            $qry->execute();
            return $qry->fetchALL(\PDO::FETCH_OBJ); 
          }
    }
     
    public function getNomeModulo($id_aula){
        $sql = "SELECT * FROM modulo JOIN aula ON modulo.id_modulo = aula.id_modulo WHERE aula.id_aula = {$id_aula}";
        $qry = $this->db->prepare($sql);
        $qry->bindValue(":id_aula", $id_aula);
        $qry->execute();
        return $qry->fetchALL(\PDO::FETCH_OBJ);
    }
    
    public function marcarComoAssistida($id_aula, $id_aluno, $id_curso){
        if(!empty($id_aluno)){
        $sql = "INSERT INTO aula_assistida SET
        id_aula = :id_aula,
        id_aluno = :id_aluno,
        id_curso = :id_curso,
        data_assistida = :data_assistida,
        hora_assistida = :hora_assistida";

        $qry = $this->db->prepare($sql);
        $qry->bindValue(":id_aula", $id_aula);
        $qry->bindValue(":id_aluno", $id_aluno);
        $qry->bindValue(":id_curso", $id_curso);
        $qry->bindValue(":data_assistida", date("Y-m-d"));
        $qry->bindValue(":hora_assistida", date("H:i:s"));
        $qry->execute();
    }
    return $this->db->lastInsertId();
    }

    public function qtdeAulasAssistidas($id_curso, $id_aluno){
        $sql = "SELECT count(*) as qtde FROM aula_assistida WHERE id_curso = :id_curso
        AND id_aluno = :id_aluno";
      
        $qry = $this->db->prepare($sql);
        $qry->bindValue(":id_curso", $id_curso);
        $qry->bindValue(":id_aluno", $id_aluno);
        $qry->execute();
        return $qry->fetch(\PDO::FETCH_OBJ);
    }

   
 
    
    public function qtdecursoAssistidasHome($id_aluno){
        $sql = "SELECT  count(distinct id_curso) as qtdcurso FROM aula_assistida WHERE aula_assistida.id_aluno = {$id_aluno}";
        $qry = $this->db->prepare($sql);
        $qry->execute();
        return $qry->fetch(\PDO::FETCH_OBJ);
    }
    
    public function qtdeAulasAssistidasHome($id_aluno){
        $sql = "SELECT count(*) as qtde FROM aula_assistida WHERE aula_assistida.id_aluno = {$id_aluno}";
        $qry = $this->db->prepare($sql);
        $qry->execute();
        return $qry->fetch(\PDO::FETCH_OBJ);
    }
    public function rank_(){
        $sql = "SELECT aluno.nome_aluno,COUNT(avaliacao.resposta) AS qtd_acertada, avaliacao.resposta AS resp_av, aluno_avaliacao.resposta AS resp_aluno, aluno_avaliacao.id_aluno 
        from avaliacao INNER JOIN aluno_avaliacao 
        ON avaliacao.titulo_pergunta = aluno_avaliacao.titulo_questao 
        AND avaliacao.resposta = aluno_avaliacao.resposta INNER JOIN aluno ON aluno.id_aluno = aluno_avaliacao.id_aluno GROUP BY aluno_avaliacao.id_aluno 
        ORDER BY qtd_acertada DESC";
        $qry = $this->db->prepare($sql);
        $qry->execute();
        return $qry->fetchALL(\PDO::FETCH_OBJ);
    }
    public function listaAulasAssistidas($id_curso, $id_aluno){
        $objAula = new AulaModel();
        $objAulaassistida = new AulaassistidaModel();

        $aulas = $objAula->listaAulasPorCurso($id_curso);
      
        $aulasAssistidas = array();
        if($aulas){
            foreach ($aulas as $aula) {
                $assistiu = $objAulaassistida->getJaAssistiu($aula->id_aula, $id_aluno);
                if ($assistiu) {
                    $data = $assistiu->data_assistida;
                    $hora = $assistiu->hora_assistida;
                    $jaassistido = true;
                }else{
                    $data = "0000-00-00";
                    $hora = "00:00:00";
                    $jaassistido = false;
                }
                $aulasAssistidas[]  =  array(
                    "id_aula"       => $aula->id_aula,
                    "id_modulo"       => $aula->id_modulo,
                    "id_curso"      => $aula->id_curso,
                    "titulo_aula"   => $aula->titulo_aula,
                    "duracao_aula"  => $aula->duracao_aula,
                    "embed_youtube" => $aula->embed_youtube,
                    "slug_aula"     => $aula->slug_aula,
                    "ativo_aula"    => $aula->ativo_aula,
                    "data_assistida"=> $data,
                    "hora_assistida"=> $hora,
                    "assistido"     => $jaassistido,
                    "path_aula"     => $aula->path_aula
                );
             
            }
           
        }
     
        return $aulasAssistidas;
    }
}