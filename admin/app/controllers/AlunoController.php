<?php 
namespace app\controllers;

use app\core\Controller;
use app\core\Flash;
use app\models\service\AlunoService;
use app\models\service\Service;
use app\util\UtilService;
use stdClass;

class AlunoController extends Controller{
    private $tabela = "aluno";
    private $campo  = "id_aluno";
    
    public function __construct(){
        $this->usuario = UtilService::getUsuario();
        if(!$this->usuario){
           $this->redirect(URL_BASE . "login");
        }
     }

    public function index(){    
        
        $dados["lista"] = Service::inner_join_aluno($this->tabela);
        
        $dados["view"]  = "Aluno/Index";
        $this->load("template", $dados);
     } 

    public function create(){
        $dados["aluno"] = Flash::getForm();
        $dados["cargos"] = Service::lista("cargo");
        $dados["view"]  = "Aluno/Create";
        $this->load("template", $dados);
    }
    public function edit($id){
       
        $aluno = Service::get($this->tabela, $this->campo, $id);
        if(!$aluno){
            $this->redirect(URL_BASE."aluno");
        }
        $dados["aluno"] = $aluno;
        $dados["cargos"] = Service::lista("cargo");
        $dados["view"]  = "Aluno/Create";
        $this->load("template", $dados);
    }
   
    public function salvar(){
        $aluno = new \stdClass();
        $aluno->id_aluno         = $_POST['id_aluno'];
        $aluno->nome_aluno       = strtolower($_POST['nome_aluno']);
        $aluno->endereco_aluno   = $_POST['endereco_aluno'];
        $aluno->cidade_aluno     = $_POST['cidade_aluno'];
        $aluno->bairro_aluno     = $_POST['bairro_aluno'];
        $aluno->uf               = $_POST['uf'];
        $aluno->matricula              = $_POST['matricula'];
        $aluno->imagem             = $_FILES['arquivo']['name'];
        if(!empty($_FILES['arquivo']['name'])){
            move_uploaded_file($_FILES['arquivo']['tmp_name'],'C:\tutiplast\projetos-tutiplast\mvc/ead_upload/'.$_FILES['arquivo']['name']);
            $this->redirect(URL_BASE."aluno");
        }
        $aluno->email            = strtolower($_POST['email']);
        $aluno->senha            = $_POST['senha'];
        $aluno->telefone         = $_POST['telefone'];
        $aluno->data_cadastro    = date("Y-m-d");
        $aluno->ativo_aluno      = $_POST['ativo_aluno'];
        $aluno->id_cargo_aluno   = $_POST['id_cargo_aluno'];
        $aluno->cpf              = $_POST['cpf'];
       Flash::setForm($aluno);
       if(AlunoService::salvar($aluno, $this->campo, $this->tabela)){
       
            $this->redirect(URL_BASE."aluno");
       }else {
           
            if($aluno->id_aluno){
                $this->redirect(URL_BASE. "aluno/edit/" . $aluno->id_aluno);
            }else {
               
                $this->redirect(URL_BASE . "aluno/create/");
            }
       };

    }
    public function excluir($id){
       Service::excluir($this->tabela, $this->campo, $id);
       $this->redirect(URL_BASE . "aluno");
    }

}