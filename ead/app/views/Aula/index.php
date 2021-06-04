<style>
    /* (A) LIST TO MENU */
    .tree,
    .section ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .tree {
        background: #fbfbfb;
        border: 1px solid #d2d2d2;
    }

    .tree li {
        border-bottom: 1px solid #d2d2d2;
        padding: 15px 10px;
    }

    .tree li:last-child {
        border: 0;
    }

    /* (B) SUB-SECTIONS */
    /* (B1) TOGGLE SHOW/HIDE */
    .section ul {
        display: none;
    }

    .section input:checked~ul {
        display: block;
    }

    /* (B2) HIDE CHECKBOX */
    .section input[type=checkbox] {
        display: none;
    }

    /* (B3) ADD EXPAND/COLLAPSE ICON  */
    .section {
        position: relative;
        padding-left: 35px !important;
    }

    .section label:after {
        content: "\0002B";
        position: absolute;
        top: 0;
        left: 0;
        padding: 10px;
        text-align: center;
        color: #0ead69;
        transition: all 0.5s;
    }

    .section input:checked~label:after {
        color: #23c37a;
        transform: rotate(45deg);
    }

    /* (B4) SUB-SECTION ITEMS */
    .section ul {
        margin-top: 10px;
    }

    .section ul li {
        color: #23c37a;
    }

    /* DOES NOT MATTER */
</style>

<div class="caixa">
    <h2 class="titulo"><span class="case">
            <i class="ico curso"></i>
            <?php echo "$nome_curso->nome_curso"; ?>
        </span>
        <i class="seta"> <?php foreach ($modulo as $modulos) { ?><?php } ?></i><?php echo "$modulos->titulo_modulo"; ?>
        <i class="seta"></i><?php $valor = strlen($aula_atual->titulo_aula);
                            if ($valor <= 62) {
                                echo "$aula_atual->titulo_aula";
                            } else {
                                if ($valor >= 70 && $valor < 80) {
                                    $rest = substr($aula_atual->titulo_aula, 0, -20);
                                    echo "$rest" . '...';
                                } else {
                                    $rest = substr($aula_atual->titulo_aula, 0, -4);
                                    echo "$rest" . '...';
                                }
                            } ?>
    </h2>
</div>
<div class="base-home">
    <div class="rows base-cursos ver_videos py-3">
        <div class="col-9 d-flex">
            <div class="caixa">
                <span class="titulo2"><?php echo $aula_atual->titulo_aula ?></span>
                <div class="caixa-video">
                    <div class="caixa-embed">
                        <iframe src="https://www.youtube.com/embed/<?php echo $aula_atual->embed_youtube ?>" class="embed-item" width="655" height="360" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    </div>
                    <div class="controles">
                        <?php $cont = 0;
                        $contar = 0;
                        foreach ($modulo_aula as $modulos_aulas) {    ?>
                            <?php if ($cont == 0) { ?>
                                <?php if ($modulos_aulas->id_modulo == $modulo_aula[$cont]->id_modulo) { ?>
                                    <?php foreach ($aula as $aulas) {  ?>
                                        <?php if ($aulas["id_modulo"]  == $modulo_aula[$cont]->id_modulo) {  ?>
                                            <?php if ($aulas["id_modulo"] == $aula_atual->id_modulo && $aulas["id_aula"] == $aula_atual->id_aula) {     ?>
                                                <?php if ($proximo[0]->id_aula == $aulas["id_aula"]) { ?>
                                                    <a style="display: none;" href="<?php echo URL_BASE . "aula/assistir/" . $proximo[$contar - 1]->id_aula ?>" class="btn anterior">Anterior</a>
                                                    <a href="<?php echo URL_BASE . "aula/assistir/" . $proximo[$contar + 1]->id_aula ?>" class="btn proximo">Próximo</a>

                                                <?php } else { ?>
                                                    <?php $array = count($proximo);
                                                    if ($proximo[$array - 1]->id_aula == $aulas["id_aula"]) {  ?>
                                                        <?php if ($modulo_aula[$cont]->id_modulo != $modulo_aula[$cont + 1]->id_modulo) {  ?>
                                                            <a href="<?php echo URL_BASE . "aula/assistir/" . $proximo[$contar - 1]->id_aula ?>" class="btn anterior">Anterior</a>
                                                            <a href="<?php echo URL_BASE . "aula/assistir/" . $proximo_modulo[0]->id_aula ?>" class="btn proximo">Próximo</a>
                                                        <?php } ?>
                                                    <?php } else { ?>
                                                        <a href="<?php echo URL_BASE . "aula/assistir/" . $proximo[$contar - 1]->id_aula ?>" class="btn anterior">Anterior</a>
                                                        <a href="<?php echo URL_BASE . "aula/assistir/" . $proximo[$contar + 1]->id_aula ?>" class="btn proximo">Próximo</a>
                                                    <?php } ?>

                                                <?php   } ?>


                                            <?php   } ?>
                                        <?php $contar += 1;
                                        } ?>
                                    <?php  } ?>
                                <?php  }  ?>
                            <?php  } else {
                                $contar = 0;  ?>
                                <?php if ($modulos_aulas->id_modulo == $modulo_aula[$cont]->id_modulo) { ?>
                                    <?php foreach ($aula as $aulas) {  ?>
                                        <?php if ($aulas["id_modulo"]  == $modulo_aula[$cont]->id_modulo) {  ?>
                                            <?php if ($aulas["id_modulo"] == $aula_atual->id_modulo && $aulas["id_aula"] == $aula_atual->id_aula) {   ?>
                                                <?php $array = count($proximo);
                                                if ($proximo[0]->id_aula == $aulas["id_aula"]) { ?>
                                                    <?php if ($array == 1) {
                                                        $array_anterior = count($anterior_modulo);  ?>
                                                        <a href="<?php echo URL_BASE . "aula/assistir/" . $anterior_modulo[$array_anterior - 1]->id_aula ?>" class="btn anterior">Anterior</a>
                                                        <a href="<?php echo URL_BASE . "aula/assistir/" . $proximo_modulo[0]->id_aula ?>" class="btn proximo">Próximo</a>
                                                    <?php } else {
                                                        $array_anterior = count($anterior_modulo);
                                                    ?>
                                                        <a href="<?php echo URL_BASE . "aula/assistir/" . $anterior_modulo[$array_anterior - 1]->id_aula ?>" class="btn anterior">Anterior</a>
                                                        <a href="<?php echo URL_BASE . "aula/assistir/" . $proximo[$contar + 1]->id_aula ?>" class="btn proximo">Próximo</a>
                                                    <?php } ?>
                                                <?php } else {  ?>
                                                    <?php $array = count($proximo);
                                                    if ($proximo[$array - 1]->id_aula == $aulas["id_aula"]) { ?>
                                                        <a href="<?php echo URL_BASE . "aula/assistir/" . $proximo[$contar - 1]->id_aula ?>" class="btn anterior">Anterior</a>
                                                        <a href="<?php echo URL_BASE . "aula/assistir/" . $proximo_modulo[0]->id_aula ?>" class="btn proximo">Próximo</a>

                                                    <?php } else {   ?>
                                                        <a href="<?php echo URL_BASE . "aula/assistir/" . $proximo[$contar - 1]->id_aula ?>" class="btn anterior">Anterior</a>
                                                        <a href="<?php echo URL_BASE . "aula/assistir/" . $proximo[$contar + 1]->id_aula ?>" class="btn proximo">Próximo</a>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php   } ?>

                                        <?php $contar += 1;
                                        } ?>
                                    <?php  } ?>
                                <?php  }  ?>
                            <?php } ?>
                        <?php $cont++;
                        } ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- LISTA DE AULA -->
        <div class="col-3 d-flex">
            <div class="caixa">
                <div class="menu-sidebar">
                    <span class="titulo2">Lista de módulos</span>
                    <div class="scroll-lista">
                        <?php $contador = 0;
                        foreach ($modulo_aula as $modulos_aulas) {    ?>

                            <ul class="tree">

                                <!-- (B) SECTION -->
                                <li class="section">
                                    <?php if ($modulos_aulas->id_modulo == $modulo_aula[$contador]->id_modulo) { ?>
                                        <?php echo " <input type='checkbox' id='$modulos_aulas->titulo_modulo'/>";
                                        echo "<label for='$modulos_aulas->titulo_modulo'>$modulos_aulas->titulo_modulo</label>" ?>
                                        <ul>
                                            <?php
                                            foreach ($aula as $aulas) {
                                                $assistido = ($aulas["assistido"]) ? "marcado" : "naomarcado";
                                            ?>

                                                <?php if ($aulas["id_modulo"] == $modulo_aula[$contador]->id_modulo) { ?>
                                                    <li class="<?php echo $assistido ?>">
                                                        <a href="<?php echo URL_BASE . "aula/assistir/" . $aulas["id_aula"] ?>">
                                                            <?php echo $aulas["titulo_aula"] ?>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                            <?php } ?>
                                        </ul>
                                    <?php } else {
                                        $contador++; ?>
                                        <?php echo " <input type='checkbox' id='$modulos_aulas->titulo_modulo'/>";
                                        echo "<label for='$modulos_aulas->titulo_modulo'>$modulos_aulas->titulo_modulo</label>" ?>
                                        <ul>
                                            <?php
                                            foreach ($aula as $aulas) {
                                                $assistido = ($aulas["assistido"]) ? "marcado" : "naomarcado";
                                            ?>
                                                <?php if ($modulo_aulas[$contador]->id_modulo == $aulas["id_modulo"]) { ?>
                                                    <li class="<?php echo $assistido ?>">
                                                        <a href="<?php echo URL_BASE . "aula/assistir/" . $aulas["id_aula"] ?>">
                                                            <?php echo $aulas["titulo_aula"] ?>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                            <?php } ?>
                                        </ul>
                                    <?php } ?>
                                </li>
                            </ul>
                        <?php $contador++;
                        } ?>
                    </div>
                </div>
            </div>
        </div>

        <!--FIM LISTA DE AULA -->
    </div>
    <div class="rows base-cursos ver_videos pb-3">
        <div class="col-9 mb-3">

            <div class="v-downloads">
                <div class="caixa">
                    <span class="titulo2">ARQUIVOS DISPONÍVEIS PARA DOWNLOADS</span>

                    <?php if (isset($aula_atual->id_aula)) { ?>
                        <ul>
                            <li><a href="<?php echo URL_IMAGEM . $aula_atual->path_aula ?>" class="icon" target="_blank" download><?php echo $aula_atual->path_aula ?></a></li>
                        </ul>

                    <?php } ?>

                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="v-desempenho">
                <div class="caixa">
                    <span class="titulo2">Informações Gerais</span>
                    <ul>
                        
                        <li>
                            <i class="ico acesso"></i>
                            <span class="tt1">ÚLTIMO CESSO</span>
                            <span class="tt2">
                            <?php
                            if(!empty($_SESSION[SESSION_LOGIN]->acesso_anterior)){
                            $date = new DateTime($_SESSION[SESSION_LOGIN]->acesso_anterior);
                            $resultado = $date->format('d/m/Y');
                            echo "$resultado";
                            
                             }else{
                                 echo"00/00/0000";
                             } ?>
                        </span>
                        </li>
                        
                        <li>
                            <i class="ico horas"></i>
                            <span class="tt1">Duração</span>
                            <span class="tt2"><?php echo $aula_atual->duracao_aula ?></span>
                        </li>
                        <li>
                            <i class="ico aula"></i>
                            <span class="tt1">Total de Aulas</span>
                            <span class="tt2"><?php echo $cont ?></span>
                        </li>
                        <!--
                        <li>
                            <i class="ico aula-ass"></i>
                            <span class="tt1">Aulas assistidas</span>
                            <span class="tt2">27 aulas </span>
                        </li>
                        -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--<div class="window sm-modal" id="responder">
    <a href="" class="fechar">X</a>
    <div class="base-comentario mt-0">
        <div class="caixa">
            <span class="titulo2">Fazer um Comentário</span>

            <textarea placeholder="Deixe sua resposta" rows="10"></textarea>
            <input type="submit" name="" value="Enviar resposta" class="btn">
        </div>
    </div>
</div>
<div id="mascara">
    <script>
        function responder(id_comentario){
            $("#id_comentario").val(id_comentario);
        }
    </script>
</div>-->