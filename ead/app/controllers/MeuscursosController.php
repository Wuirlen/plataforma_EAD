<?php

namespace app\controllers;

use app\core\Controller;
use app\models\AlunocursoModel;
use app\models\AulaassistidaModel;
use app\models\CursoModel;
use app\models\LoginModel;


class MeuscursosController extends Controller
{

    public function __construct()
    {
        $objLogin = new LoginModel();


        $this->id_aluno = $objLogin->retornaIdAluno();
        if (!$this->id_aluno) {
            header("Location:" . URL_BASE . "login");
        }
    }

    public function index()
    {
        $objAlunoCurso    = new AlunocursoModel();
        $dados["lista_cursos"] = $this->lista($this->id_aluno);
        $dados["lista_cursos_geral"] = $objAlunoCurso->listaCursosMatriculadosGeral($this->id_aluno);
        $dados["view"] = "Meus_cursos/index";
        $this->load("template", $dados);
    }

    public function lista($id_aluno)
    {
        $objAlunoCurso = new AlunocursoModel();
        $objAulaassistida = new AulaassistidaModel();
        $objCurso = new CursoModel();

        $lista = $objAlunoCurso->listaCursosMatriculados($this->id_aluno);
        $resultado = array();
        if ($lista) {
            foreach ($lista as $curso) {

                $quantidade_assistida  = $objAulaassistida->qtdeAulasAssistidas($curso->id_curso, $id_aluno);
                $quantidade_aula       = $objCurso->qtdeAulaPorCurso($curso->id_curso);
                $curso->qtde_assistida = $quantidade_assistida->qtde;
                $curso->qtde_aula      = $quantidade_aula->qtde;
                $resultado[]           = $curso;
            }
        }
        return $resultado;
    }
}