<?php

namespace app\controllers;

use app\core\Controller;
use app\models\AlunocursoModel;
use app\models\LoginModel;
use app\models\AulaModel;
use app\models\AulaassistidaModel;
use app\models\DownloadModel;
use app\models\ComentarioModel;
use app\core\Model;
use app\models\service\AlunoService;

class HomeController extends Controller
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

        $objAula          = new AulaModel();
        $objAlunoCurso    = new AlunocursoModel();
        $objAulaassistida = new AulaassistidaModel();
        $dados["qtd"]     = $objAulaassistida->qtdeAulasAssistidasHome($this->id_aluno);
        $dados["qtdcurso"] = $objAulaassistida->qtdecursoAssistidasHome($this->id_aluno);
        $aula             = $objAula->listaAulasAluno($this->id_aluno);
        $dados["rank"]    = $objAulaassistida->rank_();
        $dados["avaliacao"] = $objAulaassistida->getavaliacao();
        $aux = 1;
        date_default_timezone_set('America/Sao_Paulo');
        $data = date('Y/m/d');
        $hora = date('H:i:s');
        $dados["acesso_anterior"] = $objAlunoCurso->acesso_anterior($this->id_aluno);

        if(empty($dados["acesso_anterior"]->acesso_anterior)){
            $dados["acesso_atual"] = $objAlunoCurso->acesso_atual($data,$this->id_aluno,1); 
        }else{

            $dados["acesso_anterior"] = $objAlunoCurso->acesso_anterior($this->id_aluno);
            
            if($dados["acesso_anterior"]->acesso_anterior != $data ){
                $dados["acesso_atual"] = $objAlunoCurso->acesso_atual($data,$this->id_aluno,1); 
            }
        }
       
        $dados["usuario_posicao"] = 0;
        foreach ($dados["rank"] as $usuario_posicao) {

            if ($usuario_posicao->id_aluno == $this->id_aluno) {
                $dados["usuario_posicao"] =  $aux;
                break;
            }
            $aux++;
        }
        if ($aula) {
            $count = 0;
            foreach ($aula as $aulas) {
                $aula_informacoes      = $objAula->listaAulasAlunoInnerJoin($this->id_aluno, $aulas->id_aula);
                $dados["aula"][$count] = (array)$aula_informacoes;
                $dados["lista_cursos"] = $objAlunoCurso->listaCursosMatriculados($this->id_aluno);
                $dados["view"]         = "home";
                $count++;
            }
        } else {
            $dados["aula"]         = "Não possui aula assistida";
            $dados["lista_cursos"] = $objAlunoCurso->listaCursosMatriculados($this->id_aluno);
            $dados["view"]         = "home";
        }
        $this->load("template", $dados);
    }
}
