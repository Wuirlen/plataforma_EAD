<?php
namespace app\controllers;

use app\core\Controller;
use app\util\UtilService;


use app\core\Flash;
use app\models\service\AulaService;
use app\models\service\Service;
use app\models\service\DownloadService;
use stdClass;
use app\assets\js\js_aula;

class HomeController extends Controller{  

   public function __construct()
   {
      $this->usuario = UtilService::getUsuario();
      if(!$this->usuario){
         $this->redirect(URL_BASE . "login");
      }
   }

   public function retornaTotal($tabela, $agregacao){
      $total = Service::getTotal($tabela, $agregacao, null, null);

      if($total == 0){
         return null;
      }else {
         return $total;
      }
   }
    
   public function index(){       
      $dados["view"]        = "home";
      $dados["totalAluno"]  =  $this->retornaTotal("aluno", "*");
      $dados["totalCurso"]  =  $this->retornaTotal("curso", "*");
      $dados["totalAula"]   =  $this->retornaTotal("aula", "*");
      
      $this->load("template", $dados); 
   } 
}
