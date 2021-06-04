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
    overflow: hidden;
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
    font-size: 30px;
    color: #02c39a;
    transition: all 0.5s;
    cursor: pointer;
}

.section input:checked~label:after {
    color: #23c37a;
    transform: rotate(45deg);
    cursor: pointer;
}

/* (B4) SUB-SECTION ITEMS */
.section ul {
    margin-top: 10px;
}

.section ul li {
    color: #d43d3d;
}

/* DOES NOT MATTER */
.tree {
    font-family: arial, sans-serif;
    font-size: 18px;
}

.button {
    display: block;
    width: 115px;
    height: 25px;
    background: #ffa500ad;
    text-align: center;
    border-radius: 5px;
    text-decoration: none;
    color: #131212;
    font-weight: bold;
    line-height: 25px;
}

.button-2 {
    display: block;
    width: 115px;
    height: 25px;
    background: #41b986;
    text-align: center;
    border-radius: 5px;
    text-decoration: none;
    color: #131212;
    font-weight: bold;
    line-height: 25px;
}

@media only screen and (max-width: 350px) {
    .section ul {
        position: relative;
        left: -35px;
    }
}
</style>

<div class="rows base-cursos py-3">
    <div class="col-9">
        <div class="caixa">
            <div class="base-caixa-curso rows">
                <div class="col-4">
                    <div class="thumb"><img src="<?php echo URL_IMAGEM . $curso->imagem_curso ?>"></div>
                </div>
                <div class="col-8">
                    <span class="titulo"><?php
                                            echo $curso->nome_curso ?></span>
                    <ul>
                        <li><i class="ico data"></i><small>DATA DE INÍCIO:</small> <span>27/06/2017</span></li>
                        <li><i class="ico hora"></i><small>Duração:</small>
                            <span><?php echo $curso->duracao_curso ?></span>
                        </li>
                        <li><i class="ico qtd"></i><small>Quantidade:</small> <span><?php echo $qtde_aula; ?></span>
                        </li>
                    </ul>
                    <div class="progress">
                        <small>Nível de progressão deste curso <b>
                                <?php

                                if ($qtde_aula) {
                                    $progressao = number_format(($qtde_assistidas->qtde / $qtde_aula) * 100, 0);
                                } else {
                                    $progressao = 0;
                                }
                                echo $progressao;
                                ?>%</b></small>
                        <progress value="<?php echo $qtde_assistidas->qtde ?>"
                            max="<?php echo $qtde_aula ?>"></progress>
                    </div>
                </div>
            </div>
        </div>
        <div class="lista">

            <div class="caixa">
                <span class="titulo2">Lista de módulos</span>

                <!-- Estrutura de Arvore menu -->
                <?php $cont = 0;
                $contaulas = 0;
                foreach ($modulo as $modulos) {  ?>
                <ul class="tree">
                    <!-- (B) SECTION -->
                    <li class="section">
                        <?php if ($modulos->id_modulo == $modulo[$cont]->id_modulo) {  ?>
                        <?php echo "<input type='checkbox' id='$modulos->titulo_modulo'/>";
                                echo "<label for='$modulos->titulo_modulo'> $modulos->titulo_modulo</label>" ?>
                        <ul>
                            <table cellpadding="0" cellspacing="0" border="0">
                                <thead>
                                    <tr>
                                        <th align="left">Titulo</th>
                                        <th align="left">Duração</th>
                                        <th align="left">Data</th>
                                        <th align="left">Assistido</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                            foreach ($aula as $aulas) {
                                                $afirmacao = "Não";
                                                $assistido = ($aulas["assistido"]) ? "iassistido" : "inaoassistido";
                                                if ($assistido == "iassistido")
                                                    $afirmacao = "Sim";

                                            ?>
                                    <?php if ($aulas["id_modulo"]  == $modulo[$cont]->id_modulo) { ?>

                                    <tr>
                                        <td align="left"><a
                                                href="<?php echo URL_BASE . "aula/assistir/" . $aulas["id_aula"] ?>"><i
                                                    class="ico ititulo"></i>
                                                <?php echo $aulas["titulo_aula"] ?></a></td>
                                        <td align="left"><i
                                                class="ico iduracao"></i><?php echo $aulas["duracao_aula"] ?></td>
                                        <td align="left"><i class="ico idata"></i><?php echo $aulas["data_assistida"] ?>
                                        </td>
                                        <td align="left"><i
                                                class="ico <?php echo $assistido ?>"></i><?php echo $afirmacao ?></td>
                                    </tr>
                                    <?php } ?>

                                    <?php } ?>
                                </tbody>
                            </table>
                            <?php  if(count($quantidade_de_aulas_assistidas) > 1 ){ ?>
                            <?php 
                                    if (!empty($quantidade_de_aulas_assistidas) && $quantidade_de_aulas_assistidas[$cont]->id_modulo == $modulos->id_modulo ){  
                                        if ($quantidade_de_aulas_assistidas[$cont]->qtd == $quantidade_de_aulas_total_modulo[$cont]->qtd_total) { ?>
                            <?php if($valida_aprovado == 0 && $valida_reprovado == 0) {  ?>
                            <div class="col-4 mb-3" style="padding: 2px;top: 10px;">
                                <span class="titulo">Prova Avaliativa</span>
                                <a class="button" href="http://localhost/projetos-tutiplast/quiz/"
                                    onclick='modulo("<?php echo $modulos->id_modulo ?>","<?php echo $id_aluno ?>","<?php echo $voltar ?>")'><?php echo $modulos->titulo_avaliacao ?></a>
                            </div>
                            <?php } else{    ?>
                            <?php if($valida_aprovado == 0){   ?>
                            <?php  if(in_array($modulos->id_modulo, $valida_reprovado)){  ?>
                            <div class="col-4 mb-3" style="padding: 2px;top: 10px;">
                                <span class="titulo">Prova Avaliativa</span>
                                <a class="button-2">Concluída</a>
                            </div>
                            <?php }else{ ?>
                            <div class="col-4 mb-3" style="padding: 2px;top: 10px;">
                                <span class="titulo">Prova Avaliativa</span>
                                <a class="button" href="http://localhost/projetos-tutiplast/quiz/"
                                    onclick='modulo("<?php echo $modulos->id_modulo ?>","<?php echo $id_aluno ?>","<?php echo $voltar ?>")'><?php echo $modulos->titulo_avaliacao ?></a>
                            </div>
                            <?php } ?>
                            <?php }else if($valida_reprovado == 0){ ?>

                            <?php  if(in_array($modulos->id_modulo, $valida_aprovado)){ ?>
                            <div class="col-4 mb-3" style="padding: 2px;top: 10px;">
                                <span class="titulo">Prova Avaliativa</span>
                                <a class="button-2">Concluída</a>
                            </div>
                            <?php }else{ ?>
                            <div class="col-4 mb-3" style="padding: 2px;top: 10px;">
                                <span class="titulo">Prova Avaliativa</span>
                                <a class="button" href="http://localhost/projetos-tutiplast/quiz/"
                                    onclick='modulo("<?php echo $modulos->id_modulo ?>","<?php echo $id_aluno ?>","<?php echo $voltar ?>")'><?php echo $modulos->titulo_avaliacao ?></a>
                            </div>
                            <?php } ?>
                            <?php }else{?>
                            <div class="col-4 mb-3" style="padding: 2px;top: 10px;">
                                <span class="titulo">Prova Avaliativa</span>
                                <a class="button-2">Concluída</a>
                            </div>
                            <?php }?>
                            <?php }?>
                            <?php }} ?>
                            <?php }else{  ?>
                            <?php 
                            if(!empty($quantidade_de_aulas_assistidas) && $quantidade_de_aulas_assistidas[0]->id_modulo == $modulos->id_modulo){?>
                            <?php ?>
                            <div class="col-4 mb-3" style="padding: 2px;top: 10px;">
                                <span class="titulo">Prova Avaliativa</span>
                                <a class="button" href="http://localhost/projetos-tutiplast/quiz/"
                                    onclick='modulo("<?php echo $modulos->id_modulo ?>","<?php echo $id_aluno ?>","<?php echo $voltar ?>")'><?php echo $modulos->titulo_avaliacao ?></a>
                            </div>
                            <?php }}?>

                        </ul>
                        <?php } else {
                                $cont++;
                            ?>
                        <?php
                                echo   "<input type='checkbox' id='$modulos->titulo_modulo' />";
                                echo   "<label for='$modulos->titulo_modulo'>$modulos->titulo_modulo</label> " ?>
                        <ul>
                            <table cellpadding="0" cellspacing="0" border="0">
                                <thead>
                                    <tr>
                                        <th align="left">Titulo</th>
                                        <th align="left">Duração</th>
                                        <th align="left">Data</th>
                                        <th align="left">Assistido</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                            foreach ($aula as $aulas) {

                                                $afirmacao = "Não";
                                                $assistido = ($aulas["assistido"]) ? "iassistido" : "inaoassistido";
                                                if ($assistido == "iassistido")
                                                    $afirmacao = "Sim";
                                            ?>
                                    <?php if ($aulas["id_modulo"]  == $modulo[$cont]->id_modulo) {
                                                ?>
                                    <tr>
                                        <td align="left"><a
                                                href="<?php echo URL_BASE . "aula/assistir/" . $aulas["id_aula"] ?>"><i
                                                    class="ico ititulo"></i>
                                                <?php echo $aulas["titulo_aula"] ?></a></td>
                                        <td align="left"><i
                                                class="ico iduracao"></i><?php echo $aulas["duracao_aula"] ?>
                                        </td>
                                        <td align="left"><i class="ico idata"></i><?php echo $aulas["data_assistida"] ?>
                                        </td>
                                        <td align="left"><i
                                                class="ico <?php echo $assistido ?>"></i><?php echo $afirmacao ?>
                                        </td>
                                    </tr>

                                    <?php }  ?>

                                    <?php } ?>
                                </tbody>
                            </table>
                        </ul>
                        <?php } ?>
                    </li>
                </ul>
                <?php $cont++;
                } ?>
                <!-- FIM Estrutura de Arvore menu -->
            </div>
        </div>
    </div>
    <!--sidebar-->
    <div class="col-3">
        <div class="v-desempenho">

            <div class="caixa">
                <span class="titulo2">Seus acessos no curso</span>
                <ul>

                    <li>
                        <i class="ico acesso"></i>
                        <span class="tt1">ÚLTIMO CESSO</span>
                        <span class="tt2">
                            <?php
                            $date = new DateTime($_SESSION[SESSION_LOGIN]->acesso_anterior);
                            $resultado = $date->format('d/m/Y');
                            echo "$resultado"; ?>
                        </span>
                    </li>

                    <li>
                        <i class="ico horas"></i>
                        <span class="tt1">Duração</span>
                        <span class="tt2"><?php echo $curso->duracao_curso ?></span>
                    </li>
                    <li>
                        <i class="ico aula"></i>
                        <span class="tt1">Total de Aulas</span>
                        <span class="tt2"><?php echo $qtde_aula ?> aulas </span>
                    </li>
                    <li>
                        <i class="ico aula-ass"></i>
                        <span class="tt1">Aulas assistidas</span>
                        <span class="tt2"><?php echo $qtde_assistidas->qtde ?> aulas </span>
                    </li>
                    <li>
                        <?php if (!empty($valida_certificado)) { //existe avaliacao para este curso 
                        ?>
                        <?php if ($certificado >= 70) { ?>
                        <i class="ico certificado"></i>
                        <span class="tt1">Certificado Por Aprovacão</span>
                        <?php $autenticacao = bin2hex($curso->nome_curso . $this->id_aluno); ?>
                        <span style="cursor:pointer;color:#d43d3d"
                            onclick="gerar(<?php echo $voltar ?>,0,<?php echo $this->id_aluno ?>,'<?php echo $autenticacao ?>')"
                            class="tt2">Gerar</span>
                        <?php } ?>

                        <?php if(!empty($msg_reprovado))echo$msg_reprovado; ?>
                        <?php } else { ?> <?php $soma_qtd_aulas = 0;
                            for ($i = 0; $i < count($qtd_aula_por_modulo); $i++) {
                                $soma_qtd_aulas += $qtd_aula_por_modulo[$i][0]->qtd_aula;
                            } ?> <?php $soma_qtd_aulas_assistidas = 0;
                            for ($j = 0; $j < count($qtd_aulas_assistidas_por_modulo); $j++) {
                                $soma_qtd_aulas_assistidas += $qtd_aulas_assistidas_por_modulo[$j][0]->qtd_aula_assistida_por_modulo;
                            } ?> <?php if (($soma_qtd_aulas_assistidas * 100) / $soma_qtd_aulas == 100) { //certificado por participação 
                            ?> <?php if (count($baixar_certificado) == 0) { ?> <i class="ico certificado"></i>
                        <span class="tt1">Certificado Por Participação</span>
                        <span style="cursor:pointer;color:#d43d3d" onclick="gerar(<?php echo $voltar ?>,1)"
                            class="tt2">Gerar</span>
                        <?php } else {  ?>
                        <i class="ico certificado"></i>
                        <span class="tt1">Certificado Por Participação</span><a style=" text-decoration:none; "
                            href="<?php echo URL_IMAGEM . $baixar_certificado[0]->path_certificado ?>" class="icon"
                            target="_blank" download>
                            <span style="cursor:pointer;color:#d43d3d" class="tt2">Baixar
                            </span> </a>
                        <?php } ?>
                        <?php } ?>
                        <?php  } ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
function modulo(props, id_aluno, id_curso) {
    localStorage.setItem("modulo", props);
    localStorage.setItem("aluno", id_aluno);
    localStorage.setItem("curso", id_curso);

}

function gerar(id_curso, tipo, id_aluno, nome_curso) {

    let autenticacao = nome_curso + 'user=' + id_aluno
    localStorage.setItem("tipo", tipo);
    localStorage.setItem("curso", id_curso);
    localStorage.setItem("id_aluno", id_aluno);
    localStorage.setItem("autentication", autenticacao);
    window.open('http://localhost/projetos-tutiplast/certificado_02/');

}
</script>