<?php 
namespace app\controllers;

use app\core\Controller;
use app\core\Flash;
use app\models\service\AulaService;
use app\models\service\Service;
use app\util\UtilService;
use app\models\service\DownloadService;
use stdClass;
use app\assets\js\js_aula;
class AulaController extends Controller{
    private $tabela = "aula";
    private $campo  = "id_aula";
    
    public function __construct(){
        $this->usuario = UtilService::getUsuario();
        if(!$this->usuario){
           $this->redirect(URL_BASE . "login");
        }
     }
    public function index(){    
        $dados["lista"] = Service::lista($this->tabela);  
        $dados["view"]  = "Aula/Index";
        $this->load("template", $dados);
     } 

    public function create(){
        $aula = Flash::limpaErro();
        $aula = Service::get("aula","id_curso", 0);
        if(!$aula){
            $objAula = new \stdClass();
            $objAula->id_aula = null;
            $objAula->id_curso = 0;
            $objAula->titulo_aula = "sem titulo";
          
            $id = Service::salvar($objAula,$this->campo,array(),$this->tabela);

            $aula = Service::get($this->tabela,$this->campo,$id);
         
        }
        if($aula){
            $this->redirect(URL_BASE. "aula/edit/" . $aula->id_aula);
        }else{
            $this->redirect(URL_BASE."aula");
        }
     
       
    }
    public function edit($id){
        $aula = Service::get($this->tabela, $this->campo, $id);
     
        if(!$aula){
            $this->redirect(URL_BASE."aula");
        }
        $dados["aula"] = $aula;
        $dados["cursos"] = Service::lista("curso");
        $dados["downloads"] = Service::get("download","id_aula",$id,true);
        $dados["view"]  = "Aula/Create";
      
        $this->load("template", $dados);
    }
    public function salvar(){
        $aula = new \stdClass();
        $aula->id_modulo         = $_POST['id_modulo'];
        $aula->id_curso         = $_POST['id_curso'];
        $aula->id_aula          = $_POST['id_aula'];
        $aula->titulo_aula      = $_POST['titulo_aula'];
        $aula->duracao_aula     = $_POST['duracao_aula'];
        $aula->embed_youtube    = $_POST['embed_youtube'];
        $aula->slug_aula        = slug($_POST['titulo_aula']);
        $aula->path_aula        = $_FILES['path_aula']['name'];
        move_uploaded_file($_FILES['path_aula']['tmp_name'],'C:\tutiplast\projetos-tutiplast\mvc/ead_upload/'.$_FILES['path_aula']['name']);
       Flash::setForm($aula);
       if(AulaService::salvar($aula, $this->campo, $this->tabela)){
            $this->redirect(URL_BASE."modulo/edit/".$aula->id_modulo);
       }else {
            if($aula->id_aula){
             
                $this->redirect(URL_BASE. "aula/edit/" . $aula->id_aula);
               
            }else {
                $this->redirect(URL_BASE . "aula/create/");
            }
       };

    }
    public function excluir($id){
        $resul = Service::get($this->tabela, $this->campo, $id);
       Service::excluir($this->tabela, $this->campo, $id);
       $this->redirect(URL_BASE . "modulo/edit/".$resul->id_modulo);
    }

    public function fazer_upload_jquery(){
        global $config_upload;
        $aula = new \stdClass();
        $aula->id_aula           = null;
        $aula->id_modulo         = $_POST["id_modulo"];
        $aula->id_curso          = $_POST["id_curso"];
        $aula->titulo_aula       = $_POST["titulo_aula"];
        $aula->embed_youtube     = $_POST["embed_youtube"];
        $aula->duracao_aula      = $_POST["duracao_aula"];
        $erro = 1;
        $msg = "Nenhum arquivo enviado";
        $lista = array();
   
        $subir = UtilService::upload("arquivo", $config_upload);
        $aula->path_aula = $subir;
                if(AulaService::salvar($aula,"id_aula","aula")){
                    $erro = 0;
                    $msg = Flash::getMsg()->msg;
                }else{
                    $msg = Flash::getErro()[0];
                }
        $lista = Service::get("aula","id_modulo",$aula->id_modulo,true);
        echo json_encode(["erro" => $erro, "msg" =>$msg, "lista"=>$lista]);
    }
}