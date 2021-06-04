<?php 
namespace app\controllers;

use app\core\Controller;
use app\core\Flash;
use app\models\service\UsuarioService;
use app\models\service\Service;
use app\util\UtilService;
use stdClass;

class UsuarioController extends Controller{
    private $tabela = "usuario";
    private $campo  = "id_usuario";
    
    public function __construct(){
        $this->usuario = UtilService::getUsuario();
        if(!$this->usuario){
           $this->redirect(URL_BASE . "login");
        }
     }

    public function index(){    
        $dados["lista"] = Service::lista($this->tabela);   
        $dados["view"]  = "Usuario/Index";
        $this->load("template", $dados);
     } 

    public function create(){
        $dados["usuario"] = Flash::getForm();
        $dados["view"]  = "Usuario/Create";
        $this->load("template", $dados);
    }
    public function edit($id){
      
        $usuario = Service::get($this->tabela, $this->campo, $id);
        if(!$usuario){
            $this->redirect(URL_BASE."usuario");
        }
        $dados["usuario"] = $usuario;
        $dados["view"]  = "Usuario/Create";
      
        $this->load("template", $dados);
    }
    public function salvar(){
        $usuario = new \stdClass();
        $usuario->id_usuario       = $_POST['id_usuario'];
        $usuario->nome_usuario     = $_POST['nome_usuario'];
        $usuario->login_usuario    = $_POST['login_usuario'];
        $usuario->senha_usuario    = $_POST['senha_usuario'];
        

       Flash::setForm($usuario);
       if(UsuarioService::salvar($usuario, $this->campo, $this->tabela)){
           if($usuario->foto){
            $_SESSION[SESSION_LOGIN]->foto = $usuario->foto;
           }
           if($usuario->nome_usuario){
            $_SESSION[SESSION_LOGIN]->nome_usuario = $usuario->nome_usuario;
           }
            $this->redirect(URL_BASE."usuario");
       }else {
            if($usuario->id_usuario){
                $this->redirect(URL_BASE. "usuario/edit/" . $usuario->id_usuario);
            }else {
                $this->redirect(URL_BASE . "usuario/create");

            }
       };

    }
    public function excluir($id){
       if( $_SESSION[SESSION_LOGIN]->id_usuario == $id){
            unset($_SESSION[SESSION_LOGIN]);
            Service::excluir($this->tabela, $this->campo, $id);
            $this->redirect(URL_BASE . "login");
       }

       Service::excluir($this->tabela, $this->campo, $id);
       $this->redirect(URL_BASE . "usuario");
    }

}