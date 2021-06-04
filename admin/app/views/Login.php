<!doctype html>
<html>

<head>
    <title>EAD TUTIPLAST ADMINISTRATIVO</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="<?php echo URL_BASE ?>assets/css/auxiliar.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URL_BASE ?>assets/css/grade.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URL_BASE ?>assets/css/style.css">
    <script type="text/javascript" src="<?php echo URL_BASE ?>assets/js/jquery-3.3.1.min.js"></script>
    <!--font icones-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <script type="text/javascript">
        $(function() {
            $('.senha').click(function() {
                $('#form .dg_senha').slideToggle();
                $(this).toggleClass('active');
                return false;
            });

        });
    </script>
</head>

<body  class="base-login">
    <div class="caixa-login">
        <?php
        $this->verMsg()
        ?>
        <form action="<?php echo URL_BASE . "login/logar" ?>" method="post">
                 <div class="col-12 mb-0">
                 <div class="foto">
                <img  src="https://i.giphy.com/media/efCMCDdkCr53cdRZyU/giphy.webp">
                </div>
                </div>
            <label>
                <span>Login</span>
                <input type="text" name="login_usario" placeholder="Digite seu login" class="form-campo">
            </label>

            <label>
                <span>Senha</span>
                <input type="password" name="senha_usario" placeholder="Digite sua senha" class="form-campo">
            </label>

            <input type="submit" value="Entrar" class="btn width-100">

        </form>

        <a href="" class="senha">Esqueci minha senha</a>

        <div id="form">
            <div class="dg_senha">
                <a href="" class="senha"><i class="fas fa-angle-left"></i> Voltar</a>
                <p>Esquceu sua senha? digite um email para recupera-lo.</p>
                <label>
                    <span>Digite seu email</span>
                    <input type="text" placeholder="Digite seu email" class="form-campo">
                </label>
                <input type="submit" name="" value="Enviar" class="btn width-100">
                </label>
                <br />
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="sweetalert2.all.min.js"></script>

</html>