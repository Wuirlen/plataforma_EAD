<?php 
namespace app\controllers;

use app\core\Controller;
use app\core\Flash;
use app\models\service\CargoCursoService;
use app\models\service\CursoService;
use app\models\service\DescricaoCursoService;
use app\models\service\ModuloService;
use app\models\service\Service;
use app\util\UtilService;
use stdClass;

class CursoController extends Controller{
    private $tabela = "curso";
    private $campo  = "id_curso";
    
    public function __construct(){
        $this->usuario = UtilService::getUsuario();
        if(!$this->usuario){
           $this->redirect(URL_BASE . "login");
        }
     }

    public function index(){    
        $dados["lista"] = Service::lista($this->tabela);   
        $dados["view"]  = "Curso/Index";
        $this->load("template", $dados);
     } 

    public function create(){
        $curso =    Flash::limpaErro();
        $curso = Service::get("curso","id_curso", 0);
        if(!$curso){
            $objcurso = new \stdClass();
            $objcurso->id_curso     = null;
            $id = Service::salvar($objcurso,$this->campo,array(),$this->tabela);
            $curso = Service::get($this->tabela,$this->campo,$id);
        }
        if($curso){   
            $this->redirect(URL_BASE. "curso/edit/" . $curso->id_curso);
        }else{ 
            $this->redirect(URL_BASE."curso");
        }
       
    }
    public function edit($id){
        $curso = Service::get($this->tabela, $this->campo, $id);
       
        if(!$curso){
            $this->redirect(URL_BASE."curso");
        }
        $dados["curso"] = $curso;
        $dados["modulos"] = Service::get("modulo","id_curso",$id,true);
        $dados["lista"] = Service::get("descricao_curso","id_curso",$id,true);
        $dados["view"]  = "Curso/Create";
        $this->load("template", $dados);
    }
    
    public function salvar_cargo($id_cargo,$id_curso){
        $cargo_curso = new \stdClass();
        $cargo_curso->id_cargo_curso = null;
        $cargo_curso->id_cargo = $id_cargo;
        $cargo_curso->id_curso = $id_curso;
        CargoCursoService::salvarcargocurso($cargo_curso, "id_cargo_curso","cargo_curso");
    }
    public function salvar(){
        $curso = new \stdClass();
        $cargo_curso = new \stdClass();
        $curso->id_curso         =          $_POST['id_curso'];
        $curso->nome_curso       =          $_POST['nome_curso'];
        $curso->nome_instrutor       =     strtoupper ( $_POST['nome_instrutor']);
        $curso->duracao_curso    =          $_POST['duracao_curso'];
        $curso->slug_curso       =          slug($_POST['nome_curso']);
       // $curso->descricao_curso  =          $_POST['descricao_curso'];
       // $curso->embed            =          $_POST['embed'];
        $curso->ativo_curso      =          $_POST['ativo_curso'];
     
       Flash::setForm($curso);
       if(CursoService::salvar($curso, $this->campo, $this->tabela)){
        if($curso->ativo_curso == "S"){
            $dados["cargos"] = Service::lista("cargo");
            foreach($dados["cargos"] as $cargo){
             $this->salvar_cargo($cargo->id_cargo,$curso->id_curso);
            }
        }else{
            Service::excluir("cargo_curso", "id_curso",  $curso->id_curso);
        }
            $this->redirect(URL_BASE."curso");
       }else {
           
            if($curso->id_curso){
                $this->redirect(URL_BASE. "curso/edit/" . $curso->id_curso);
            }else { 
                $this->redirect(URL_BASE . "curso/create/");
            }
       }

    }
    public function excluir($id){
        
       Service::excluircurso($this->tabela, $this->campo, $id);
       $this->redirect(URL_BASE . "curso");
    }
    public function excluir_descricao_curso($dados){
       // $resul = Service::get($this->tabela, $this->campo, $dados);
        Service::excluir("descricao_curso", "id_descricao_curso", $dados);
        $this->redirect(URL_BASE . "curso");
     }
    public function fazer_upload_jquery(){
        global $config_upload;
        $descricao_curso = new \stdClass();
        $descricao_curso->id_descricao_curso       = null;
        $descricao_curso->descricao_curso         = $_POST["descricao_curso"];
        $descricao_curso->id_curso                = $_POST["id_curso"];
        $erro = 1;
        $msg = "Nenhum arquivo enviado";
        $lista = array();
                if(DescricaoCursoService::salvar($descricao_curso,"id_descricao_curso","descricao_curso")){
                    $erro = 0;
                    $msg = Flash::getMsg()->msg;
                }else{
                    $msg = Flash::getErro()[0];
                }
         $lista = Service::get("descricao_curso","id_curso",$descricao_curso->id_curso,true);
         echo json_encode(["erro" => $erro, "msg" =>$msg, "lista"=>$lista]);
    }

}

