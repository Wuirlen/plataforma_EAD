<link rel="stylesheet" type="text/css" href="slick/slick/slick.css" />
<link rel="stylesheet" type="text/css" href="slick/slick/slick-theme.css" />
<link rel="stylesheet" type="text/css" href="<?php echo URL_BASE  ?>assets/fontawesome-free-5.15.3-web/css/all.css">
<div class="caixa">
    <h2 class="titulo"><span class="case"><i class="ico duvida"></i>Home</span> Seja Bem Vindo</h2>
</div>
<div class="base-home">
    <div class="rows detalhes py-3">
        <div class="col-4">
            <figure class="caixa">
                <div class="thumb"><img src="<?php echo isset($_SESSION[SESSION_LOGIN]->foto) ? URL_IMAGEM . $_SESSION[SESSION_LOGIN]->foto : URL_IMAGEM . "img-usuario.png"  ?>"></div>
                <figcaption>
                    <strong><?php echo $_SESSION[SESSION_LOGIN]->nome_aluno ?></strong>
                    <small><?php echo $_SESSION[SESSION_LOGIN]->email ?></small>
                </figcaption>
            </figure>
        </div>
        <div class="col">
            <div class="caixa">
                <i class="ico video"></i>
                <small>Aulas assistidas</small>
                <?php foreach ($qtd as $valor) { ?>
                    <h3><?php echo $valor ?></h3>
                <?php } ?>
            </div>
        </div>
        <div class="col">
            <div class="caixa">
                <i class="ico curso"></i>
                <small>Cursos assisitidos</small>
                <?php foreach ($qtdcurso as $valorcurso) { ?>
                    <h3><?php echo $valorcurso ?></h3>
                <?php } ?>
            </div>
        </div>
        <div class="col">
            <div class="caixa">
                <i class="ico exercicio"></i>
                <small>Posição no Rank</small>
                <h3> <?php echo $usuario_posicao;
                        ?>°</h3>
            </div>
        </div>
    </div>


    <div class="rows listagem">
        <div class="col-6 matriculados d-flex mb-3">
            <div class="caixa">
                <span class="titulo2">CURSOS MATRICULADOS</span>
                <div class="rolagem">
                    <div class="lista">
                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                            <thead>
                                <tr>
                                    <th align="left">CURSOS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($lista_cursos as $curso) {  ?>
                                    <tr>
                                        <td><a href="<?php echo URL_BASE . "curso/detalhe/" . $curso->id_curso ?>">
                                                <?php echo $curso->nome_curso ?></a></td>
                                    </tr>
                                    <?php if (!empty($lista_cursos_geral)) {  ?>
                                        <?php foreach ($lista_cursos_geral as $curso_geral) {  ?>
                                            <?php if($curso_geral->id_curso != $curso->id_curso){?>
                                            <tr>
                                                <td><a href="<?php echo URL_BASE . "curso/detalhe/" . $curso_geral->id_curso ?>">
                                                        <?php echo $curso_geral->nome_curso ?></a></td>
                                            </tr>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--
						<div class="naoativo">
							<img src="img/nao-matriculado.png"><h2>Nenhum curso matriculado</h2>
						</div>
						-->
            </div>
        </div>
        <div class="col-6 assistidos d-flex mb-3">
            <div class="caixa">
                <span class="titulo2">ÚLTIMAS AULAS ASSISITIDAS</span>
                <div class="rolagem mb-3">
                    <div class="lista">
                        <table cellpadding="0" cellspacing="0" border="0">
                            <thead>
                                <tr>
                                    <th align="left">AULA</th>
                                    <th>DATA</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($aula != "Não possui aula assistida") {
                                    foreach ($aula as $aulas) {
                                        $afirmacao = "Não";
                                        if (in_array("assistido", $aula)) {
                                            $assistido = ($aula["assistido"]) ? "iassistido" : "inaoassistido";
                                            if ($assistido == "iassistido")
                                                $afirmacao = "Sim";
                                        }

                                ?>
                                        <tr>
                                            <td><i></i> <?php echo $aulas["titulo_aula"] ?></td>
                                            <?php $date = new DateTime($aulas["data_assistida"]);
                                            $resultado = $date->format('d/m/Y');
                                            ?>
                                            <td align="center"><?php echo $resultado ?></td>

                                        </tr>
                                    <?php }
                                } else { ?>
                                    <tr>
                                        <td><i></i> <?php echo $aula ?></td>
                                        <td align="center">00/00/0000</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <a href="<?php echo URL_BASE . "meuscursos" ?>" class="btn btn-curso d-table">VER MEUS CURSOS</a>
                <!--<div class="naoativo">
							<img src="img/nao-matriculado.png"><h2>Nenhuma aula assistida</h2>
						</div>-->
            </div>
        </div>
    </div>
    <div class="rows listagem">
        <div class="col-12 matriculados d-flex mb-3">
            <div style="height: 431px;" class="caixa">
                <span class="titulo2">Rank de Pontuações</span>
                <div class="rolagem">
                    <div class="lista">
                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                            <thead>
                                <tr>
                                    <th align="left">Alunos</th>
                                    <th align="center">Pontos</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $posicao = 1;
                                foreach ($rank as $listagem) { ?>
                                    <tr>
                                        <td>
                                            <h4 style="text-decoration: none;
                                                                text-transform: uppercase;
                                                                color: #1a936f;
                                                                 display: block;
                                                                 margin: 3px;"><?php echo '<strong>' . $posicao . '°' . '</strong>' ?>
                                                <?php echo  $listagem->nome_aluno ?></h4>
                                        </td>
                                        <td align="center">


                                            <?php if ($posicao == 1) {  ?>
                                                <h2><?php echo $listagem->qtd_acertada ?></h2> <span>Pts</span>
                                            <?php } ?>
                                            <?php if ($posicao == 2) { ?>
                                                <h2><?php echo $listagem->qtd_acertada ?></h2> <span>Pts</span>
                                            <?php } ?>
                                            <?php if ($posicao == 3) { ?>
                                                <h2><?php echo $listagem->qtd_acertada ?></h2> <span>Pts</span>
                                            <?php } ?>
                                            <?php if ($posicao > 3) { ?>
                                                <h2><?php echo $listagem->qtd_acertada ?></h2> <span>Pts</span>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php if ($posicao == 1) {  ?>
                                                <i class="fas fa-trophy fa-spin" style="font-size:30px;color:#ffd700;float:right"></i>
                                            <?php } ?>
                                            <?php if ($posicao == 2) {  ?>
                                                <i class="fas fa-trophy" style="font-size:30px;float:right"></i>
                                            <?php } ?>
                                            <?php if ($posicao == 3) {  ?>
                                                <i class="fas fa-trophy" style="font-size:30px;float:right;color:#cd7f32"></i>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php $posicao++;
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--
						<div class="naoativo">
							<img src="img/nao-matriculado.png"><h2>Nenhum curso matriculado</h2>
						</div>
						-->
            </div>
        </div>
    </div>



</div>
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo URL_BASE . "slick/slick/slick.min.js" ?>"></script>

<script type="text/javascript">
    $('.single-item').slick({
        dots: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        //autoplay: true,
        // autoplaySpeed: 8000,

        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });
</script>