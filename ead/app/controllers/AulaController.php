<?php

namespace app\controllers;

use app\core\Controller;
use app\models\AulaModel;
use app\models\AulaassistidaModel;
use app\models\LoginModel;
use app\models\DownloadModel;
use app\models\ComentarioModel;

class AulaController extends Controller
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
        $objComentario = new AulaModel();
        $dados["lista_cursos"] = $objComentario->listaCursosMatriculados($this->id_aluno);
        $dados["view"] = "Aula/index";
        $this->load("template", $dados);
    }

    public function assistir($id_aula)
    {
        $objAula          = new AulaModel();
        $objAulaassistida = new AulaassistidaModel();
        $objDownload      = new DownloadModel();
        $objComentario    = new ComentarioModel();

        $aula = $objAula->listaAulas($id_aula);

        if (!$objAulaassistida->getJaAssistiu($id_aula, $this->id_aluno, "")) {
            $objAulaassistida->marcarComoAssistida($id_aula, $this->id_aluno, $aula->id_curso);
        }
        $dados["lista_cursos"] = $objAula->listaCursosMatriculados($this->id_aluno);
        $dados["aula_atual"] = $aula;
        $dados["aula"]       = $objAulaassistida->listaAulasAssistidas($aula->id_curso, $this->id_aluno);
        $contador = count($dados["aula"]);
        $dados["cont"] = $contador;
        $dados["modulo"]     = $objAulaassistida->getNomeModulo($id_aula);
        $dados["modulo_aula"] = $objAulaassistida->getModulo($aula->id_curso);
        $dados["proximo"] = $objAulaassistida->getModuloaula($aula->id_modulo);

        for ($j = 0; $j < count($dados["modulo_aula"]); $j++) {
            if ($j + 1 == count($dados["modulo_aula"])) {
                if ($j - 1 != -1) {
                    if ($dados["modulo_aula"][$j]->id_modulo != $dados["modulo_aula"][0]->id_modulo) {
                        $dados["anterior_modulo"] = $objAulaassistida->getproximomodulo($aula->id_curso, $dados["modulo_aula"][$j - 1]->id_modulo);
                    }
                }

                $dados["proximo_modulo"] = $objAulaassistida->getproximomodulo($aula->id_curso, $dados["modulo_aula"][$j]->id_modulo);
                break;
            }
            if (count($dados["modulo_aula"]) == 1) {


                $dados["proximo_modulo"] = $objAulaassistida->getproximomodulo($aula->id_curso, $dados["modulo_aula"][$j]->id_modulo);
            } else {

                if ($dados["modulo_aula"][$j]->id_modulo == $dados["aula_atual"]->id_modulo) {
                    if ($j - 1 != -1) {
                        if ($dados["modulo_aula"][$j]->id_modulo != $dados["modulo_aula"][0]->id_modulo) {
                            $dados["anterior_modulo"] = $objAulaassistida->getproximomodulo($aula->id_curso, $dados["modulo_aula"][$j - 1]->id_modulo);
                        }
                    }
                    $dados["proximo_modulo"] = $objAulaassistida->getproximomodulo($aula->id_curso, $dados["modulo_aula"][$j + 1]->id_modulo);
                    break;
                }
            }
        }
        $dados["nome_curso"] =  $objAulaassistida->getJNomeCurso($id_aula, $aula->id_curso, $this->id_aluno);
        $dados["download"]   = $objDownload->lista($aula->id_curso);
        //$dados["comentario"] = $objComentario->listaComentarios($this->id_aula);
        $dados["view"]       = "Aula/index";
        $this->load("template", $dados);
    }
}
