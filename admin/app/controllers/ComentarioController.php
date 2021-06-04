<?php 
namespace app\controllers;

use app\core\Controller;
use app\core\Flash;
use app\models\service\ComentarioService;
use app\models\service\Service;
use app\util\UtilService;
use stdClass;

class ComentarioController extends Controller{
    private $tabela = "comentario";
    private $campo  = "id_comentario";
    
    public function __construct(){
        $this->usuario = UtilService::getUsuario();
        if(!$this->usuario){
           $this->redirect(URL_BASE . "login");
        }
     }

    public function index(){    
        $dados["lista"] = Service::lista($this->tabela);   
        $dados["view"]  = "Comentario/Index";
        $this->load("template", $dados);
     } 

    public function create(){
        $dados["comentario"] = Flash::getForm();
        $dados["view"]  = "Comentario/Create";
        $this->load("template", $dados);
    }
    public function edit($id){
        $comentario = Service::get($this->tabela, $this->campo, $id);
        if(!$comentario){
            $this->redirect(URL_BASE."comentario");
        }
        $dados["comentario"] = $comentario;
        $dados["view"]  = "Comentario/Create";
      
        $this->load("template", $dados);
    }
    public function salvar(){
        $comentario = new \stdClass();
        $comentario->id_comentario         = $_POST['id_comentario'];
        $comentario->id_aula       = $_POST['id_aula'];
        $comentario->id_aluno   = $_POST['id_aluno'];
        $comentario->comentario   = $_POST['comentario'];
        $comentario->data_comentario    = date("Y-m-d");
        $comentario->hora_comentario   = $_POST['hora_comentario'];
       

       Flash::setForm($comentario);
       if(ComentarioService::salvar($comentario, $this->campo, $this->tabela)){
            $this->redirect(URL_BASE."comentario");
       }else {
            if($comentario->id_comentario){
                $this->redirect(URL_BASE. "comentario/edit/" . $comentario->id_comentario);
            }else {
                $this->redirect(URL_BASE . "comentario/create");
            }
       };

    }
    public function excluir($id){
       Service::excluir($this->tabela, $this->campo, $id);
       $this->redirect(URL_BASE . "comentario");
    }

}