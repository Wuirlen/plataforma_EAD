<?php 

namespace app\controllers;

use app\core\Controller;
use app\models\service\Service;

class LoginController extends Controller{
    public function index(){
        $dados["view"] = "Login";
        $this->load("Login", $dados);
    }

    public function logar(){
        $login = $_POST["login_usario"];
        $senha = $_POST["senha_usario"]; 
      
        if(Service::logar("login_usuario", $login, $senha, "usuario")){
            $this->redirect(URL_BASE);
        }else {
            $this->redirect(URL_BASE . "login");
        } 
    }

    public function logoff(){
        unset($_SESSION[SESSION_LOGIN]);
        $this->redirect(URL_BASE . "login");
    }
}