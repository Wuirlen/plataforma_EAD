<?php 
namespace app\models;
use app\core\Model;
use PDO;

class DownloadModel extends Model{
    public function lista($id_curso) {
        $sql = "SELECT * FROM download WHERE
        id_curso = :id_curso "; 

        $qry = $this->db->prepare($sql);
        $qry->bindValue(":id_curso", $id_curso);
        $qry->execute();
        
        return $qry->fetchAll(\PDO::FETCH_OBJ);
    }
 

}
