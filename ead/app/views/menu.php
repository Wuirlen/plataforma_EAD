<div id="menu">
    <div class="menu-lateral">
        <figure>
            <div class="thumb"><img src="<?php echo isset($_SESSION[SESSION_LOGIN]->foto) ? URL_IMAGEM . $_SESSION[SESSION_LOGIN]->foto : URL_IMAGEM . "img-usuario.png"  ?>"></div>
            <figcaption>
                <strong><?php echo $_SESSION[SESSION_LOGIN]->nome_aluno ?></strong>
                <small>Plataforma EAD</small>
            </figcaption>
        </figure>
        <ul>
            <li><a href="<?php echo URL_BASE ?>"><i class="ico home"></i>HOME</a></li>
            <li><a href="<?php echo URL_BASE . "meuscursos" ?>"><i class="ico curso"></i>MEUS CURSOS</a></li>
            <li><a href="<?php echo URL_BASE . "perfil"?>"><i class="ico perfil"></i>MEU PERFIL</a></li>
            <li><a href="<?php echo URL_BASE . "comentario"?> "><i class="ico duvida"></i>COMENTÁRIOS</a></li>
            <li><a href="<?php echo URL_BASE . "evento" ?> "><i class="ico evento"></i>EVENTOS</a></li>
            <li><a href="<?php echo URL_BASE . "login/logoff"?>"><i class="ico sair"></i>SAIR</a></li>
        </ul>
    </div>
</div>
