<?php
namespace app\controllers;
use app\core\Controller;
use app\models\LoginModel;
use app\models\ComentarioModel;
use stdClass;

class ComentarioController extends Controller{

    public function __construct(){
        $objLogin = new LoginModel();

        $this->id_aluno = $objLogin->retornaIdAluno();
        if(!$this->id_aluno){
            header("Location:" . URL_BASE . "login");
        }
    }

    public function index(){
        $objComentario = new ComentarioModel();
        $dados["lista_cursos"] = $objComentario->listaCursosMatriculados($this->id_aluno);
        $dados["view"] = "Comentario/index";
       $this->load("template", $dados);
    }

    public function inserir(){
        $objComentario = new ComentarioModel();
       
        $comentario             = new \stdClass();
        $comentario->id_aula    = $_POST["id_aula"];
        $comentario->id_aluno   = $this->id_aluno;
        $comentario->comentario = $_POST["comentario"];

        $objComentario->inserir($comentario);

        header("Location:" . URL_BASE . "aula/assistir/" . $comentario->id_aula);
    }
}