<?php
define("SERVIDOR", "localhost");
define("BANCO", "plataforma_ead");
define("USUARIO", "root");
define("SENHA", "12345");
define("CHARSET","UTF8");


define('CONTROLLER_PADRAO', 'home');
define('METODO_PADRAO', 'index');
define('NAMESPACE_CONTROLLER', 'app\\controllers\\');
define('TIMEZONE',"America/Amazonas ");
define('CAMINHO'            , realpath('./'));
define("TITULO_SITE","mjailton-ligando vc ao mundo do conhecimento");

define('URL_BASE', 'http://' . $_SERVER["HTTP_HOST"].'/projetos-tutiplast/mvc/admin/');
define('URL_IMAGEM', "http://". $_SERVER['HTTP_HOST'] . "/projetos-tutiplast/mvc/ead_upload/");

define("SESSION_LOGIN","usuario_ead_logado");

$config_upload["verifica_extensao"] = false;
$config_upload["extensoes"]         = array(".gif",".jpeg", ".png", ".bmp", ".jpg",".pdf",".zip");
$config_upload["verifica_tamanho"]  = true;
$config_upload["tamanho"]           = 3097152;
$config_upload["caminho_absoluto"]  = realpath('../'). '/ead_upload/';
$config_upload["renomeia"]          = false;
