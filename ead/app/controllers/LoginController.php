<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Flash as CoreFlash;
use app\models\AlunocursoModel;
use app\models\LoginModel;
use app\models\Flash;
class LoginController extends Controller
{

    public function index()
    { 
        $dados["view"] = "login";
        $this->load("login", $dados);
    }

    public function logar()
    {
        $objLoginModel = new LoginModel();

        $matricula = $_POST["matricula"];
        $senha = $_POST["senha"];

        $aluno = $objLoginModel->logar($matricula, $senha);
         
        if (!empty($aluno)) {         
            $_SESSION[SESSION_LOGIN] = $aluno;
            header("Location:" . URL_BASE);
        } else{
           unset($_SESSION[SESSION_LOGIN]);
           $_SESSION['SESSION_NAO_LOGADO'] = true;
           header("Location:" . URL_BASE . "login");
        }    
        
    }

    public function logoff()
    {
        unset($_SESSION[SESSION_LOGIN]);
        header("Location:" . URL_BASE . "login");
    }
   
}
