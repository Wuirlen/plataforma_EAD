<?php 
namespace app\controllers;

use app\core\Controller;
use app\core\Flash;
use app\models\service\CargoCursoService;
use app\models\service\CargoService;
use app\models\service\Service;
use app\util\UtilService;
use stdClass;

class CargoController extends Controller{
    private $tabela = "cargo";
    private $campo  = "id_cargo";
    
    public function __construct(){
        $this->usuario = UtilService::getUsuario();
        if(!$this->usuario){
           $this->redirect(URL_BASE . "login");
        }
     }

    public function index(){    
        $dados["lista"] = Service::lista($this->tabela);   
        $dados["view"]  = "Cargo/Index";
        $this->load("template", $dados);
     } 

    public function create(){
        $dados["cargo"] = Flash::getForm();
        $dados["view"]  = "Cargo/Create";
        $this->load("template", $dados);
    }
    public function edit($id){
        $cargo = Service::get($this->tabela, $this->campo, $id);
        
        if(!$cargo){
          
            $this->redirect(URL_BASE."cargo");
        }
        $dados["cargo"] = $cargo;
        $dados["view"]  = "Cargo/Create";
      
        $this->load("template", $dados);
    }
    public function salvar(){
      
        $cargo = new \stdClass();
        $cargo->id_cargo         = $_POST['id_cargo'];
        $cargo->nome_cargo       = $_POST['nome_cargo'];
        $cargo->descricao        = $_POST['descricao'];
      
       Flash::setForm($cargo);
       if(CargoService::salvar($cargo, $this->campo, $this->tabela)){
              
            $this->redirect(URL_BASE."cargo");
       }else {
           
            if($cargo->id_cargo){
                $this->redirect(URL_BASE. "cargo/edit/" . $cargo->id_cargo);
            }else {
                $this->redirect(URL_BASE . "cargo/create/");
            }
       };

    }
    public function excluir($id){
       Service::excluircargo($this->tabela, $this->campo, $id);
       $this->redirect(URL_BASE . "cargo");
    }

}