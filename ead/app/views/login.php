
<!doctype html>
<html>
<head>
    <title>EAD Tutiplast</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="<?php echo URL_BASE ?>assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URL_BASE ?>assets/css/auxiliar.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URL_BASE ?>assets/css/grade.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URL_BASE ?>assets/css/m-style.css">

    <script type="text/javascript" src="<?php echo URL_BASE ?>assets/js/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
    <script type="text/javascript" src="<?php echo URL_BASE ?>assets/js/js.js"></script>
    <script type="text/javascript" src="<?php echo URL_BASE ?>assets/js/sweet.js"></script>
   <style>
   
   </style>

</head>
<body class="base-login">
    <div class="caixa-login position-relative">
    
        <img src="<?php echo URL_BASE ?>assets/img/img-topo-login.png">
        <form action="<?php echo URL_BASE . "login/logar" ?>" method="post" name="form">
            <h1>login </h1>
            <?php
              if(isset($_SESSION['SESSION_NAO_LOGADO'])){
            ?>
            <span style="
    top: -10px;
    position: relative;
    color: red;
   
    margin: 90px;
    ">
					    Acesso Negado!
					</span>
                <?php unset($_SESSION['SESSION_NAO_LOGADO']); } ?>
              <script type="text/javascript">
                            $(document).ready(function() {
                                $("#matricula").mask("999999999");
                            });
                        </script>
            <label for="matricula">
                <input  id="matricula" type="text" name="matricula" value="" placeholder="matricula">
            </label>
            <br>
            
            <label>
                <input type="password" name="senha" value="" placeholder="Senha">
            </label>
            <input type="submit" value="Entrar" class="btn">
        </form>
        <a href="" class="senha text-azul mt-3 d-block">Esqueci minha senha</a>

        <div class=" mostrasenha">
            <div class="caixa">
                <span class="sair senha">X</span>
                <h1 class="h3 mb-0 pb-1">Esqueci minha senha </h1>
                <p class="text-center pb-4">Digite seu email no campo abaixo para recuperar sua senha</p>
                <form action="" method="post">
                   
                    <label for="email">
                        <input type="text" value="" placeholder="Inserir email">
                    </label>
                    </label>
                    <input id="mensagem" type="submit"  value="Enviar" class="btn">
                </form>
            </div>
        </div>
    </div>

</body>

</html>