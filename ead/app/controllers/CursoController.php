<?php
namespace app\controllers;
use app\core\Controller;
use app\models\CursoModel;
use app\models\AulaModel;
use app\models\AulaassistidaModel;
use app\models\DownloadModel;
use app\models\LoginModel;

class CursoController extends Controller{

    public function __construct(){
        $objLogin = new LoginModel();

        $this->id_aluno = $objLogin->retornaIdAluno();
        if(!$this->id_aluno){
            header("Location:" . URL_BASE . "login");
        }
    }

    public function index(){  
      
        $dados["view"] = "Curso/index";
        $this->load("template", $dados);
    }

    public function detalhe($id_curso){
        $objCurso         = new CursoModel();
        $objDownload      = new DownloadModel();
        $acesso           =          "0000-00-00";
        $objAulaassistida = new AulaassistidaModel();
        $dados["voltar"]            =  $id_curso;
        $dados["id_aluno"]          =  $this->id_aluno;
        $dados["curso"]             = $objCurso->detalheCurso($id_curso);
        $dados["qtde_assistidas"]   = $objAulaassistida->qtdeAulasAssistidas($id_curso, $this->id_aluno);
        $dados["modulo"]            = $objAulaassistida->getModulo($id_curso);
        $dados["quantidadeTotaldequest_por_curso"]       =  $objCurso->quantidadeTotaldequest_por_curso($id_curso);
        $dados["aula"]              = $objAulaassistida->listaAulasAssistidas($id_curso, $this->id_aluno, "*");
        $dados["lista_cursos"]      = $objCurso->listaCursosMatriculados($this->id_aluno);
        $dados["valida_certificado"]      = $objCurso->valida_certificado_se_existe_prova($id_curso);
        $dados["Quantidade_total_de_aulas_neste_curso"] = $objCurso->qtdeAulaPorCurso($id_curso);
        $dados["Quantidade_total_de_aulas_assistida_neste_curso"] = $objCurso->qtdeAulaAssistidaPorCurso($id_curso,$this->id_aluno);
    
        if(empty($objCurso->verifica_se_existe_prova_feita_aprovado($this->id_aluno,$id_curso))  && empty($objCurso->verifica_se_existe_prova_feita_reprovado($this->id_aluno,$id_curso))){
            $dados["valida_aprovado"]      =  0;
            $dados["valida_reprovado"]     =  0;
        }else{
            
            $aux = $objCurso->verifica_se_existe_prova_feita_aprovado($this->id_aluno,$id_curso);
            $aux_reprovado = $objCurso->verifica_se_existe_prova_feita_reprovado($this->id_aluno,$id_curso); 
            $array [] = 0;
            $array_reprovado[] = 0;
             if(!empty($aux)){
                foreach($dados["modulo"] as $modulos){
                    for($i= 0; $i < count($aux); $i++){
                     if($aux[$i]->id_modulo == $modulos->id_modulo){
                        $array[] = $modulos->id_modulo;
                        break; 
                     }
                    }
                    $dados["valida_aprovado"]= $array;  
                }
             }else{
                $dados["valida_aprovado"] = 0;      
             }
             if(!empty($aux_reprovado)){
        
                foreach($dados["modulo"] as $modulos){
                    for($j= 0; $j < count($aux_reprovado); $j++){
                     if($aux_reprovado[$j]->id_modulo == $modulos->id_modulo){
                        $array_reprovado[] = $modulos->id_modulo;
                        break; 
                     }
                    }
                    $dados["valida_reprovado"]= $array_reprovado;
           
                }
             }else{
                $dados["valida_reprovado"] = 0;      
             }
        
        }
       
        $dados["qtde_aula"]         = count($dados["aula"]);
        $dados["quantidade_de_aulas_total_modulo"]      =  $objCurso->quantidade_total_aulas_modulo($id_curso);
        $dados["quantidade_de_aulas_assistidas"]      =  $objCurso->quantidade_aulas_assistidas_modulo($this->id_aluno,$id_curso);
        $dados["quantidadeTotaldequest_por_tabela_aprovado"]  = $objCurso->quantidadeTotaldequest_por_tabela_aprovado($this->id_aluno,$id_curso);
        $dados["quantidadeTotaldequest_por_tabela_reprovado"] = $objCurso->quantidadeTotaldequest_por_tabela_reprovado( $this->id_aluno,$id_curso);
        $soma_total = $dados["quantidadeTotaldequest_por_tabela_aprovado"]->total_acertadas_aprovadas + $dados["quantidadeTotaldequest_por_tabela_reprovado"]->total_acertadas_reprovado;
        $dados["certificado"] = ($soma_total * 100) / $dados["quantidadeTotaldequest_por_curso"]->total_quest;
        if($dados["certificado"] < 70){
          
            $data_aprovado  = $objCurso->pega_data_aprovado($id_curso,$this->id_aluno);
            $data_reprovado = $objCurso->pega_data_reprovado($id_curso,$this->id_aluno);
            if(!empty($data_aprovado)){
               
                $data_aprovado  = explode("-",$data_aprovado->data_avaliacao);
            }
            if(!empty($data_reprovado)){
               
                $data_reprovado = explode("-",$data_reprovado->data_avaliacao);
            }

            $hoje = date("d/m/Y");
            $hoje = explode("/",$hoje);

        if(!empty($data_aprovado[1]) && empty($data_reprovado[1]) ){ 
            if($data_aprovado[1] < $hoje[1]){

                $objCurso->excluir_para_refazer_curso($id_curso, $this->id_aluno,$hoje[1]);
                echo '<script>alert("Liberação Para Refazer o curso concluída!");r</script>';
                header("Refresh:0");
            }
        } else if(empty($data_aprovado[1]) && !empty($data_reprovado[1])){  
            $dados["msg_reprovado"] = "Reprovado";
            if($data_reprovado[1] < $hoje[1]){
                $objCurso->excluir_para_refazer_curso($id_curso, $this->id_aluno,$hoje[1]);
                echo '<script>alert("Liberação Para Refazer o curso concluída!");r</script>';
                 header("Refresh:0");
            }
    
        }
          
        if(!empty($data_aprovado[1]) && !empty($data_reprovado[1]) ){ 
            $dados["msg_reprovado"] = "Reprovado";
           
        if($data_aprovado[1] >= $data_reprovado[1]){
          
            if($data_aprovado[1] < $hoje[1]){

                $objCurso->excluir_para_refazer_curso($id_curso, $this->id_aluno,$hoje[1]);
                echo '<script>alert("Liberação Para Refazer o curso concluída!");r</script>';
                header("Refresh:0");
            }
        }else{

            if($data_reprovado[1] < $hoje[1]){
                $objCurso->excluir_para_refazer_curso($id_curso, $this->id_aluno,$hoje[1]);
                echo '<script>alert("Liberação Para Refazer o curso concluída!");r</script>';
                header("Refresh:0");
            }
        }   
           }
        }
        $dados["view"]        = "Curso/index";
        $this->load("template", $dados);
    }   
    public function gerar_certificado(){
        $tipo     = $_POST["tipo"];
        $id_curso = $_POST["id_curso"];
        $objCurso = new CursoModel();
        $dados["curso"]   = $objCurso->detalheCurso($id_curso);
        $dados["aluno"]   = $objCurso->detalheAluno($this->id_aluno);
        //$dados["valida_certificado_fez_prova"]  = $objCurso->valida_certificado_se_aluno_fez_prova($id_curso,$this->id_aluno);
        //criamos o arquivo
        $arquivo = fopen('C:\tutiplast\projetos-tutiplast\mvc\ead/assets/downloads/certificado_'.$dados["aluno"]->nome_aluno.'.txt', 'w');
        //verificamos se foi criado
        if ($arquivo == false) die('Não foi possível criar o arquivo.');
        //escrevemos no arquivo
        $texto = $dados["curso"]->nome_aluno."\n".$tipo."\n".$dados["curso"]->nome_curso."\n". $dados["valida_certificado_fez_prova"]->data_avaliacao."\n".$dados["curso"]->duracao_curso."\n".$dados["curso"]->nome_instrutor."\n".$id_curso."\n".$this->id_aluno;
        fwrite($arquivo, $texto);
        //Fechamos o arquivo após escrever nele
        fclose($arquivo); 
    }
}