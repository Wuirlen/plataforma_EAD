<?php 
namespace app\controllers;
use app\core\Controller;
use app\models\LoginModel;
use app\models\EventoModel;

class EventoController extends Controller{ 
        public function __construct()
        {
            $objLogin = new LoginModel();

            $this->id_aluno = $objLogin->retornaIdAluno();
            if(!$this->id_aluno){
                header("Location:" . URL_BASE . "login");
        }
    }

    public function index(){
        $objAlunoCurso = new EventoModel();
        $dados["lista_cursos"] = $objAlunoCurso->listaCursosMatriculados($this->id_aluno);
        $dados["view"] = "Evento/Index";
       $this->load("template", $dados);
    }
}
