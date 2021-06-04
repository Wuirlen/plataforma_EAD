<div class="conteudo">
    <a href="" class="menu-m">menu mobile esquerdo</a><!-- aqui fico icone reponsavel pelo meno da esquerda-->
    <a href="" class="menu-grade">menu mobile direito</a><!--aqui fica o menu responsavel pelo meno do topo-->
    <a href="" class="logo"></a>
    <div id="grade">
        <ul class="menu-topo">
            <li class="sub"><a href=""><i class="ico cursos"></i>Cursos</a>
                <ul>
                <?php foreach($lista_cursos as $curso) {  ?>
                    <li>
                        <a href="<?php echo URL_BASE . "curso/detalhe/" . $curso->id_curso ?>"><?php echo $curso->nome_curso ?></a>
                    </li>
                    <?php } ?>
                </ul>
            </li>
            <li class="sub user"><a href="" class="thumb"><img src="<?php echo isset($_SESSION[SESSION_LOGIN]->foto) ? URL_IMAGEM . $_SESSION[SESSION_LOGIN]->foto : URL_IMAGEM . "img-usuario.png"  ?>"></a>
                <ul>
                    <li><b><?php echo $_SESSION[SESSION_LOGIN]->nome_aluno ?></b><small><a href="<?php echo URL_BASE . "login/logoff" ?>">Sair</a></small></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
