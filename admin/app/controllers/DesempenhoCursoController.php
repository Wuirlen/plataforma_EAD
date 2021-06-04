<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Flash;
use app\models\service\DesempenhoCurso;
use app\models\service\DesempenhoCursoService;
use app\models\service\Service;
use app\util\UtilService;
use stdClass;

class DesempenhoCursoController extends Controller
{
    private $tabela = "aluno";
    private $campo  = "id_aluno";

    protected $a;
    public function __construct()
    {
        $this->usuario = UtilService::getUsuario();
        if (!$this->usuario) {
            $this->redirect(URL_BASE . "login");
        }
    }

    public function index()
    {
        $dados["count2"] = Service::contador_02($this->tabela);
        for($i = 0; $i < count($dados["count2"]);$i++){
            $dados["cont_aluno"][$i] =  Service::contador_aluno_curso("curso",$dados["count2"][$i]->id_curso);
        }
        $dados["view"]  = "DesempenhoCurso/Index";
        $this->load("template", $dados);
    }

    public function create()
    {
        $dados["desempenho_curso"] = Flash::getForm();
        $dados["cursos"] = Service::lista("curso");
        $dados["cargos"] = Service::lista("cargo");
        $dados["view"]  = "DesempenhoCurso/Create";
        $this->load("template", $dados);
    }

    public function edit($id)
    {
        $dados["lista"] = Service::inner_join_desempenho_curso($this->tabela, $id);
        $dados['desempenho_curso'] = Service::get("curso", "id_curso", $id);
        $cont = 0;
        foreach ($dados["lista"] as $aluno) {
            $dados["aulas_assistidas"][$cont] = Service::lista_aula_assistida("aula_assistida", $aluno->id_aluno, $id);
            $cont++;
        }
        $dados["count"] = Service::contador_02($this->tabela);
        $dados["id"] = $id;
        $dados["view"]  = "DesempenhoCurso/Create";
        $this->load("template", $dados);
    }

    public function salvarEdit($curso_escolhido, $cargo)
    {
        $desempenho_curso = new \stdClass();
        $desempenho_curso->id_desempenho_curso          = $_POST['id_desempenho_curso'];
        $desempenho_curso->id_cargo                = $cargo;
        $desempenho_curso->id_curso                = $curso_escolhido;
        Flash::setForm($desempenho_curso);
        DesempenhoCursoService::salvarcargocursoEdit($desempenho_curso, $this->campo, $this->tabela);
    }

    public function salvar($curso_escolhido, $cargo)
    {
        $dados["cursos"] = Service::lista("curso");
        $dados["cargos"] = Service::lista("cargo");
        $dados["cargocurso"] = Service::lista("desempenho_curso");
        $desempenho_curso = new \stdClass();
        $desempenho_curso->id_desempenho_curso          = $_POST['id_desempenho_curso'];
        $desempenho_curso->id_cargo                = $_POST['id_cargo'];

        $desempenho_curso->id_curso                = $curso_escolhido;
        Flash::setForm($desempenho_curso);

        if (DesempenhoCursoService::salvarcargocurso($desempenho_curso, $this->campo, $this->tabela)) {
        } else {
            if ($desempenho_curso->id_desempenho_curso) {
                $this->redirect(URL_BASE . "cargocurso/edit/" . $desempenho_curso->id_desempenho_curso);
            } else {
                $this->salvarEdit($curso_escolhido, $cargo);
            }
        }
    }

    public function seleciona()
    {

        if (isset($_REQUEST['checkbox_curso'])) {
            $cargo = $_REQUEST["id"];
            $curso_escolhido = $_REQUEST['checkbox_curso'];


            if ($curso_escolhido) {

                for ($i = 0; $i < count($curso_escolhido); $i++) {

                    $this->salvar($curso_escolhido[$i], $cargo);
                }
            }
        }
        $this->redirect(URL_BASE . "cargocurso");
    }

    public function excluir($id)
    {

        Service::excluir($this->tabela, $this->campo, $id);
        $this->redirect(URL_BASE . "cargocurso");
    }
}
