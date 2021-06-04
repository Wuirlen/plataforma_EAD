<?php
namespace app\controllers;
use app\core\Controller;
use app\models\LoginModel;
use app\models\AlunocursoModel;
use app\models\Model;

class PerfilController extends Controller{
    private $tabela = "aluno";
    private $campo  = "id_aluno";
    public function __construct(){
        $objLogin = new LoginModel();
        $this->id_aluno = $objLogin->retornaIdAluno();
        if(!$this->id_aluno){
            header("Location:" . URL_BASE . "login");
        }
    }
    public function index(){
        $objAlunoCurso = new AlunocursoModel();
        $dados["lista_cursos"] = $objAlunoCurso->listaCursosMatriculados($this->id_aluno);
        $dados["dados"] = $objAlunoCurso->dados_aluno($this->id_aluno);
        $dados["bugas"] = "";
        $dados["view"] = "Perfil/index";
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
        $aluno->cep              = $_POST['cep'];
        //$aluno->imagem             = $_POST['foto'];
        $aluno->email            = strtolower($_POST['email']);
        $aluno->senha            = $_POST['senha'];
        $aluno->telefone         = $_POST['telefone'];
        $aluno->cpf              = $_POST['cpf'];
        $aluno->id_cargo_aluno   = $_POST['id_cargo_aluno'];
        $aluno->foto_aluno       = $_FILES['foto_aluno']['name'];
    
        move_uploaded_file($_FILES['foto_aluno']['tmp_name'],'C:\tutiplast\projetos-tutiplast\mvc/ead_upload/'.$_FILES['foto_aluno']['name']);
        $objAluno = new AlunocursoModel();
        $dados = $objAluno->dados_aluno($this->id_aluno);
        $array = get_object_vars($aluno);
     
       
        $valida_email = $objAluno->valida_email();  
        foreach($valida_email as $valida){
                if($array["email"] == $valida->email){
                    $true = 1;
                    break;
                }else{
                    $true = 0;
                }
        }
        if(empty($array["foto_aluno"])){
            $array["foto_aluno"] = $dados[0]->foto_aluno;
        }
       
        if($dados[0]->email == $array["email"] ){
            $true = 0;
        }
        if($array["email"] == ""){
            $true = 2;
        }
        if($array["nome_aluno"] == ""){
            $true = 3;
        }
        if($array["senha"] == ""){
            $true = 4;
        }
        if($true == 0){

            $objAluno->editar($array, $this->campo,$this->tabela);

             if($array["foto_aluno"]){
                $_SESSION[SESSION_LOGIN]->foto = $array["foto_aluno"];
             }
             if($array["nome_aluno"]){
                $_SESSION[SESSION_LOGIN]->nome_aluno = $array["nome_aluno"];
             }
             if($array["email"]){
                $_SESSION[SESSION_LOGIN]->email = $array["email"];
             }
            $dados["bugas"] = "";
            $objAlunoCurso = new AlunocursoModel();
            $dados["lista_cursos"] = $objAlunoCurso->listaCursosMatriculados($this->id_aluno);
            $dados["dados"] = $objAlunoCurso->dados_aluno($this->id_aluno); 
            $dados["view"] = "Perfil/index";
            $this->load("template", $dados);
        }else if($true == 2){
            $dados["bugas"] = "<div style='padding:21px; margin:0 auto;';><h2 style='text-align:center;
            color:red'>Email Vazio!</h2></div>";
            $objAlunoCurso = new AlunocursoModel();
            $dados["lista_cursos"] = $objAlunoCurso->listaCursosMatriculados($this->id_aluno);
            $dados["dados"] = $objAlunoCurso->dados_aluno($this->id_aluno); 
            $dados["view"] = "Perfil/index";
            $this->load("template", $dados);
        }else if($true == 3){
            $dados["bugas"] = "<div style='padding:21px; margin:0 auto;';><h2 style='text-align:center;
            color:red'>Nome Vazio!</h2></div>";
            $objAlunoCurso = new AlunocursoModel();
            $dados["lista_cursos"] = $objAlunoCurso->listaCursosMatriculados($this->id_aluno);
            $dados["dados"] = $objAlunoCurso->dados_aluno($this->id_aluno); 
            $dados["view"] = "Perfil/index";
            $this->load("template", $dados);
        }else if($true == 4){
            $dados["bugas"] = "<div style='padding:21px; margin:0 auto;';><h2 style='text-align:center;
            color:red'>Senha Vazio!</h2></div>";
            $objAlunoCurso = new AlunocursoModel();
            $dados["lista_cursos"] = $objAlunoCurso->listaCursosMatriculados($this->id_aluno);
            $dados["dados"] = $objAlunoCurso->dados_aluno($this->id_aluno); 
            $dados["view"] = "Perfil/index";
            $this->load("template", $dados);
        }else{
            $dados["bugas"] = "<div style='padding:21px; margin:0 auto;';><h2 style='text-align:center;
            color:red'>Email Já Cadastrado!</h2></div>";
            $objAlunoCurso = new AlunocursoModel();
            $dados["lista_cursos"] = $objAlunoCurso->listaCursosMatriculados($this->id_aluno);
            $dados["dados"] = $objAlunoCurso->dados_aluno($this->id_aluno); 
            $dados["view"] = "Perfil/index";
            $this->load("template", $dados);
        } 
        }
      
    
}