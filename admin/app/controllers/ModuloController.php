<?php 
namespace app\controllers;

use app\core\Controller;
use app\core\Flash;
use app\models\service\ModuloService;
use app\models\service\Service;
use app\util\UtilService;
use app\models\service\DownloadService;
use stdClass;
use app\assets\js\js_aula;
use app\models\service\AulaService;
use app\models\service\AvaliacaoService;

class ModuloController extends Controller{
    private $tabela = "modulo";
    private $campo  = "id_modulo";
    
    public function __construct(){
        $this->usuario = UtilService::getUsuario();
        if(!$this->usuario){
           $this->redirect(URL_BASE . "login");
        }
     }

    public function index(){    
        $dados["lista"] = Service::contadormodulo($this->tabela); 
        $dados["view"]  = "Modulo/Index";
        $this->load("template", $dados);
     } 

    public function create(){
        $modulo =    Flash::limpaErro();
        $modulo = Service::get("modulo","id_curso", 0);
        if(!$modulo){
            $objModulo = new \stdClass();
            $objModulo->id_modulo     = null;
            $objModulo->id_curso      = 0;
            $objModulo->titulo_modulo = "Ex::Informe um Título";
            $id = Service::salvar($objModulo,$this->campo,array(),$this->tabela);
            $modulo = Service::get($this->tabela,$this->campo,$id);
        }
        if($modulo){   
            $this->redirect(URL_BASE. "modulo/edit/" . $modulo->id_modulo);
        }else{ 
            $this->redirect(URL_BASE."modulo");
        }
    }
    public function edit($id){
        $modulo = Service::get($this->tabela, $this->campo, $id);
        if(!$modulo){
            $this->redirect(URL_BASE."modulo");
        }
        $dados["modulo"] = $modulo;
       
        $dados["cursos"] = Service::lista("curso");
        $dados["aulas"] = Service::get("aula","id_modulo",$id,true);
        $dados["avaliacao"] = Service::get("avaliacao","id_modulo",$id,true);
        $dados["view"]  = "Modulo/Create";
      
        $this->load("template", $dados);
    }
    public function editaula($id){
        $aula = Service::get($this->tabela, $this->campo, $id);
        if(!$aula){
            $this->redirect(URL_BASE."aula");
        }
        $dados["aula"] = $aula;
        $dados["cursos"] = Service::lista("curso");
        $dados["aulas"] = Service::get("aula","id_aula",$id,true);
        $dados["view"]  = "Aula/Create";
      
        $this->load("template", $dados);
    }
    public function salvar(){
        $modulo = new \stdClass();
        $modulo->id_modulo        = $_POST['id_modulo'];
        $modulo->id_curso        = $_POST['id_curso'];
        $modulo->titulo_modulo   = $_POST['titulo_modulo'];
        $modulo->titulo_avaliacao  = $_POST["titulo_avaliacao"];
        
       Flash::setForm($modulo);
       if(ModuloService::salvar($modulo, $this->campo, $this->tabela)){
            $this->redirect(URL_BASE."modulo");
       }else {
            if($modulo->id_modulo){
             
                $this->redirect(URL_BASE. "modulo/edit/" . $modulo->id_modulo);
               
            }else {
                $this->redirect(URL_BASE . "modulo/create/");
            }
       };

    }
    public function excluir($id){
        $dados["inner_join"] = service::inner_joinwhere_modulo($this->tabela,$id);
        $dados_["assistida"] = service::lista_aula_assistida_modulo("aula_assistida");
        if(isset($dados["inner_join"])){
               foreach($dados["inner_join"] as $dados){
               
                if(isset($dados_["assistida"])){
                    foreach( $dados_["assistida"] as $dados_assistidos){
                        if($dados->id_aula == $dados_assistidos->id_aula){
                            Service::excluir("aula_assistida","id_aula_assistida", $dados_assistidos->id_aula_assistida); 
                        }
                    }
                }
                Service::excluir("aula","id_aula", $dados->id_aula);
               }
              Service::excluir($this->tabela, $this->campo, $id);
        }else{
            Service::excluir($this->tabela, $this->campo, $id);
        }
      
       $this->redirect(URL_BASE . "modulo");
    }
    public function fazer_upload_jquery(){
        global $config_upload;
        $aula = new \stdClass();
        $aula->id_aula           = null;
        $aula->id_modulo         = $_POST["id_modulo"];
        $aula->id_curso          = $_POST["id_curso"];
        $aula->titulo_aula       = $_POST["titulo_aula"];
       // $aula->titulo_avaliacao  = $_POST["titulo_avaliacao"];
        $aula->embed_youtube     = $_POST["embed_youtube"];
        $aula->duracao_aula      = $_POST["duracao_aula"];
        $erro = 1;
        $msg = "Nenhum arquivo enviado";
        $lista = array();

        $subir = UtilService::upload("arquivo", $config_upload);
        $aula->path_aula = $subir;
                if(AulaService::salvar($aula,"id_aula","aula")){
                    
                    $erro = 0;
                    $msg = Flash::getMsg()->msg;
                }else{
                    $msg = Flash::getErro()[0];
                }
        $lista = Service::get("aula","id_modulo",$aula->id_modulo,true);
        echo json_encode(["erro" => $erro, "msg" =>$msg, "lista"=>$lista]);
    }
    public function fazer_upload_avaliacao_jquery(){
        global $config_upload;
        $avaliacao = new \stdClass();
        $avaliacao->id_avaliacao      = null;
        $avaliacao->id_modulo         = $_POST["id_modulo"];
        $avaliacao->titulo_pergunta   = $_POST["titulo_pergunta"];
        $avaliacao->questao_a         = $_POST["questao_a"];
        $avaliacao->questao_b         = $_POST["questao_b"];
        $avaliacao->questao_c         = $_POST["questao_c"];
        $avaliacao->questao_d         = $_POST["questao_d"];
        $avaliacao->resposta         = $_POST["resposta"];
        $erro = 1;
        $msg = "Nenhum arquivo enviado";
        $lista = array();
                if(AvaliacaoService::salvar($avaliacao,"id_avaliacao","avaliacao")){
                   
                    $erro = 0;
                    $msg = Flash::getMsg()->msg;
                }else{
                    $msg = Flash::getErro()[0];
                }
        $lista = Service::get("avaliacao","id_modulo",$avaliacao->id_modulo,true);
        echo json_encode(["erro" => $erro, "msg" =>$msg, "lista"=>$lista]);
    }
}