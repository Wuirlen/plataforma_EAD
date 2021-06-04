<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Flash;
use app\models\service\AulaService;
use app\models\service\Service;
use app\util\UtilService;
use app\models\service\DownloadService;
use stdClass;
use app\assets\js\js_aula;
use app\models\service\AvaliacaoService;

class AvaliacaoController extends Controller
{
    private $tabela = "avaliacao";
    private $campo  = "id_avaliacao";

    public function __construct()
    {
        $this->usuario = UtilService::getUsuario();
        if (!$this->usuario) {
            $this->redirect(URL_BASE . "login");
        }
    }
    public function index()
    {
        $dados["lista"] = Service::lista($this->tabela);
        $dados["view"]  = "Avaliacao/Index";
        $this->load("template", $dados);
    }

    public function create()
    {
        $avaliacao = Flash::limpaErro();
        $avaliacao = Service::get("avaliacao", "id_avaliacao", 0);
        if (!$avaliacao) {
            $objAvaliacao = new \stdClass();
            $objAvaliacao->id_avaliacao = 0;
            $objAvaliacao->titulo_pergunta = "sem titulo";

            $id = Service::salvar($objAvaliacao, $this->campo, array(), $this->tabela);

            $avaliacao = Service::get($this->tabela, $this->campo, $id);
        }
        if ($avaliacao) {
            $this->redirect(URL_BASE . "avaliacao/edit/" . $avaliacao->id_avaliacao);
        } else {
            $this->redirect(URL_BASE . "avaliacao");
        }
    }
    public function edit($id)
    {
        $avaliacao = Service::get("avaliacao", "id_avaliacao", $id);
        if (!$avaliacao) {
            $this->redirect(URL_BASE . "avaliacao");
        }
        $dados["avaliacao"] = $avaliacao;
        $dados["cursos"] = Service::lista("curso");
        $dados["downloads"] = Service::get("download", "id_aula", $id, true);
        $dados["view"]  = "Avaliacao/Create";
        $this->load("template", $dados);
    }
    public function salvar()
    {
        $avaliacao = new \stdClass();
        $avaliacao->id_modulo             = $_POST['id_modulo'];
        $avaliacao->titulo_pergunta       = $_POST['titulo_pergunta'];
        $avaliacao->id_avaliacao          = $_POST['id_avaliacao'];
        $avaliacao->questao_a             = $_POST['questao_a'];
        $avaliacao->questao_b             = $_POST['questao_b'];
        $avaliacao->questao_c             = $_POST['questao_c'];
        $avaliacao->questao_d             = $_POST['questao_d'];
        $avaliacao->resposta             = $_POST['resposta'];
        Flash::setForm($avaliacao);
        if (AvaliacaoService::salvar($avaliacao, $this->campo, $this->tabela)) {
            $this->redirect(URL_BASE . "modulo/edit/" . $avaliacao->id_modulo);
        } else {
            if ($avaliacao->id_avaliacao) {

                $this->redirect(URL_BASE . "avaliacao/edit/" . $avaliacao->id_avaliacao);
            } else {
                $this->redirect(URL_BASE . "avaliacao/create/");
            }
        };
    }
    public function excluir($id)
    {
        $resul = Service::get($this->tabela, $this->campo, $id);
        Service::excluir($this->tabela, $this->campo, $id);
        $this->redirect(URL_BASE . "modulo/edit/" . $resul->id_modulo);
    }

    public function fazer_upload_jquery()
    {
        global $config_upload;
        $aula = new \stdClass();
        $aula->id_aula           = null;
        $aula->id_modulo         = $_POST["id_modulo"];
        $aula->id_curso          = $_POST["id_curso"];
        $aula->titulo_aula       = $_POST["titulo_aula"];
        $aula->embed_youtube     = $_POST["embed_youtube"];
        $aula->duracao_aula      = $_POST["duracao_aula"];
        $erro = 1;
        $msg = "Nenhum arquivo enviado";
        $lista = array();

        $subir = UtilService::upload("arquivo", $config_upload);
        $aula->path_aula = $subir;
        if (AulaService::salvar($aula, "id_aula", "aula")) {
            $erro = 0;
            $msg = Flash::getMsg()->msg;
        } else {
            $msg = Flash::getErro()[0];
        }
        $lista = Service::get("aula", "id_modulo", $aula->id_modulo, true);
        echo json_encode(["erro" => $erro, "msg" => $msg, "lista" => $lista]);
    }
}
