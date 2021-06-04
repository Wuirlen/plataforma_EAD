<script src="<?php echo URL_BASE ?>assets/js/js_usuario.js"></script>
<div class="site">
    <div class="base-topo">
        <div class="conteudo">
        <a href="<?php echo URL_BASE?>" class="mobmenu" ><i class="fas fa-bars"></i></a>
            <a href="<?php echo URL_BASE?>" class="logo"><img src="<?php echo URL_BASE?>assets/img/logo.png"></a>
            <div class="usuario">
                <div class="txt">
                    <h1><?php echo $_SESSION[SESSION_LOGIN]->nome_usuario; ?></h1>
                    <h2>Administrador</h2>
                </div>
                <div class="thumb">
                    <img src="<?php echo URL_IMAGEM . $this->usuario->foto?>">
                </div>
            </div>
        </div>
    </div>
</div>