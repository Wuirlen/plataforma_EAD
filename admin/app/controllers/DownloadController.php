<?php 
namespace app\controllers;

use app\core\Controller;
use app\core\Flash;
use app\models\service\DownloadService;
use app\models\service\Service;
use app\util\UtilService;
use stdClass;

class DownloadController extends Controller{
    private $tabela = "download";
    private $campo  = "id_download";
    
    public function __construct(){
        $this->usuario = UtilService::getUsuario();
        if(!$this->usuario){
           $this->redirect(URL_BASE . "login");
        }
     }

    public function index(){    
        $dados["lista"] = Service::lista($this->tabela);   
        $dados["view"]  = "Download/Index";
        $this->load("template", $dados);
     } 

    public function create(){
        $dados["download"] = Flash::getForm();
        $dados["view"]  = "Download/Create";
        $this->load("template", $dados);
    }
    public function edit($id){
        $download = Service::get($this->tabela, $this->campo, $id);
        if(!$download){
            $this->redirect(URL_BASE."download");
        }
        $dados["download"] = $download;
        $dados["view"]  = "Download/Create";
        $this->load("template", $dados);
    }
    public function salvar(){
        global $resul;
        $download = new \stdClass();
       //$download->id_download         =          $_POST['id_download'];
       $download->id_curso            =          $_POST['id_curso'];
       $download->titulo_download     =          $_POST['titulo_download'];
      $resul =  $download->id_aula             =          $_POST['id_aula'];
     
        

       Flash::setForm($download);
       if(DownloadService::salvar($download, $this->campo, $this->tabela)){
            $this->redirect(URL_BASE."download");
       }else {
            if($download->id_download){
                $this->redirect(URL_BASE. "download/edit/" . $download->id_download);
            }else {
                $this->redirect(URL_BASE . "download/create");
            }
       };

    }
    public function excluir($id){
        $resul = Service::get($this->tabela, $this->campo, $id);
       Service::excluir($this->tabela, $this->campo, $id);
       $this->redirect(URL_BASE . "aula/edit/".$resul->id_aula);
    }

}