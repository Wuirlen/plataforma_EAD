<?php 
namespace app\controllers;

use app\core\Controller;
use app\core\Flash;
use app\models\service\CargoCursoService;
use app\models\service\Service;
use app\util\UtilService;
use stdClass;

class CargoCursoController extends Controller{
    private $tabela = "cargo_curso";
    private $campo  = "id_cargo_curso";
    
    protected $a;
    public function __construct(){
        $this->usuario = UtilService::getUsuario();
        if(!$this->usuario){
           $this->redirect(URL_BASE . "login");
        }

     }

    public function index(){    
        $dados["lista"] = Service::inner_join($this->tabela); 
        $dados["count"] = Service::contador($this->tabela);
     
        $dados["view"]  = "CargoCurso/Index";
       
        $this->load("template", $dados);
     } 

    public function create(){
        $dados["cargo_curso"] = Flash::getForm();
        $dados["cursos"] = Service::lista("curso");
        $dados["cargos"] = Service::lista("cargo");
        $dados["view"]  = "CargoCurso/Create";
        $this->load("template", $dados);
    }
   
    public function edit($id){
        $dados["lista"] = Service::inner_join($this->tabela); 
        $cargo_curso = Service::get($this->tabela, $this->campo, $id);
        $dados["cargo_curso"] = $cargo_curso;
        $dados["cursos"] = Service::lista("curso");
        $dados["cargo"] = Service::getcheckbox("cargo_curso", "id_cargo",$id);  
        $dados["id"]= $id;
        $dados["view"]  = "CargoCurso/Create"; 
        $this->load("template", $dados);
    
    }
   
    public function salvarEdit($curso_escolhido,$cargo){
        $cargo_curso = new \stdClass();
        $cargo_curso->id_cargo_curso          = $_POST['id_cargo_curso'];  
        $cargo_curso->id_cargo                = $cargo;
        $cargo_curso->id_curso                = $curso_escolhido;
        Flash::setForm($cargo_curso);
      CargoCursoService::salvarcargocursoEdit($cargo_curso, $this->campo, $this->tabela);
       
       }

    public function salvar($curso_escolhido,$cargo){
        $dados["cursos"] = Service::lista("curso");
        $dados["cargos"] = Service::lista("cargo");
        $dados["cargocurso"] = Service::lista("cargo_curso");
        $cargo_curso = new \stdClass();
        $cargo_curso->id_cargo_curso          = $_POST['id_cargo_curso'];  
        $cargo_curso->id_cargo                = $_POST['id_cargo'];
        
        $cargo_curso->id_curso                = $curso_escolhido;
        Flash::setForm($cargo_curso);
      
        if(CargoCursoService::salvarcargocurso($cargo_curso, $this->campo, $this->tabela)){
            
        }else{
            if($cargo_curso->id_cargo_curso){
                $this->redirect(URL_BASE. "cargocurso/edit/" . $cargo_curso->id_cargo_curso);
            }else {
                $this->salvarEdit($curso_escolhido,$cargo);
            }
       }
    }

    public function seleciona(){
        
        if(isset($_REQUEST['checkbox_curso'])){
            $cargo = $_REQUEST["id"];
            $curso_escolhido = $_REQUEST['checkbox_curso'];
               if($curso_escolhido){
                 
                  for ($i = 0; $i < count($curso_escolhido);$i++){
                     
                       $this->salvar($curso_escolhido[$i],$cargo);
                  }
            
              }
        }
        $this->redirect(URL_BASE."cargocurso");
    }
   
    public function excluir($id){
    
       Service::excluir($this->tabela, $this->campo, $id);
       $this->redirect(URL_BASE . "cargocurso");
    }

}