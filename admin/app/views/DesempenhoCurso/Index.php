<style>
    /*janela modal*/
    .window {
        width: 900px;
        position: absolute;
        background: #fff;
        padding: 20px;
        box-shadow: 0 0px 5px 0 #44444480;
        z-index: 2;
        display: none;
    }

    .window.load {
        width: 400px;
        padding: 80px 0;
        border-radius: 5px;
        -webkit-border-radius: 5px;
        -o-border-radius: 5px;
        -moz-border-radius: 5px;
        position: fixed;
    }

    .window.load progress {
        width: 100%;
        display: block;
        -webkit-appearance: none;
        height: 18px
    }

    .window.load progress::-webkit-progress-bar {
        background: #DDDDDD;
        padding: 0;
        box-shadow: 0 0 3px #00000054 inset
    }

    .window.load progress::-webkit-progress-value {
        background: #0ead69;
    }

    .window.load .border.prog {
        border-color: #0ead69 !important;
        border-radius: 3px
    }

    .window.load span {
        color: #8e44ad;
        display: block;
        padding-top: 10px;
    }

    .window.load .carrega {
        display: block;
        text-align: center;
    }

    .window.load .carrega img {
        display: block;
        margin: 0 auto;
    }

    .fechar {
        display: block;
        text-align: right;
        position: absolute;
        right: 7px;
        top: 7px;
        background: #444;
        color: #fff;
        padding: 2px 7px;
        border-radius: 50%;
        cursor: pointer;
        z-index: 1;
    }

    #mascara,
    #fundo {
        display: none;
        position: fixed;
        left: 0;
        top: 0;
        bottom: 0;
        z-index: 1;
        background-color: #000;
    }

    /*md-fixo*/
    .md-fixo {
        position: fixed;
        top: 48.406px !important;
    }

    .bg-gray {
        background: #f4f4f4;
    }

    /*md-table*/
    .md-table {
        top: 0 !important;
    }

    .md-table .form-campo {
        background: #fff !important
    }
</style>
<div class="caixa-home">
    <h1 class="titulo"><i class="fas fa-list-alt"></i> LISTA DE CARGOS COM CURSOS</h1>
    <div class="base-lista">
        <div class="rows">
            <div class="col-12">

                <div class="mostraFiltro">
                    <form action="" method="">
                        <div class="rows">
                            <div class="col-4"><input type="text" placeholder="Nome" class="form-campo"></div>
                            <div class="col-6"><input type="text" placeholder="Email" class="form-campo"></div>
                            <div class="col-2"><input type="submit" value="Buscar" class="btn width-100"></div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-12">
                <?php
                $this->verMsg();
                ?>
                <div class="col-12 d-flex text-justify mb-2">
                    <button style="float: right;" class="btn d-inline-block mx-1" id="btnExport" onclick="gerarExcel()">Gerar Excel</button>
                    <a href="app/views/DesempenhoCurso/ead_report.xlsx" style="display: none;" id="btnExport2" download><button style="float: right;" class="btn d-inline-block mx-1">Baixar Excel</button></a>
                </div>
                <table data-page-length='5' cellpadding="0" cellspacing="0" border="0" id="dataTable">
                    <thead>
                        <tr>
                            <th width="20%" align="left">Nome</th>
                            <th align="center">QTD de Aula por curso</th>
                            <th align="center">QTD DE ALUNOS</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $cont = 0;
                        foreach ($count2 as $curso) {   ?>
                            <tr>
                                <td align="left"><?php echo $curso->nome_curso ?></td>
                                <td align="center"><a class="btn btn-outline-azul"> <?php echo $curso->qtd ?> </a></td>
                                <td align="center"><a class="btn btn-outline-azul"> <?php echo $cont_aluno[$cont][0]->QTD_ALUNO ?> </a></td>
                                <td align="center"><a href="<?php echo URL_BASE . "desempenhocurso/edit/" . $curso->id_curso ?>" class="btn editar">visualizar</a></td>
                            </tr>
                        <?php $cont++;
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="window md-modal" id="janela">
        <a href="" class="fechar">X</a>
        <div class="rows p-2">
            <div class="col-10">
                <label class="d-block pb-1">Selecionar Curso</label>
                <select class="form-campo">
                    <option>Opção 01</option>
                    <option>Opção 01</option>
                    <option>Opção 01</option>
                </select>
            </div>
            <div class="col-2 mt-3 pt-1">
                <input type="submit" class="btn btn-azul" value="Matricular">
            </div>
        </div>
        <div class="rows">
            <div class="col-12">
                <h1 class="titulo border-top"><i class="fas fa-list-alt"></i> Meus cursos cursos</h1>
                <div class="base-lista px-1">
                    <table cellpadding="0" cellspacing="0" border="0" id="dataTable">
                        <thead>
                            <tr>
                                <th align="left" width="80%">Curso</th>
                                <th align="center">Excluir </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td align="left">Curso</td>
                                <td align="center"><a href="" class="btn btn-vermelho d-inline-block">Excluir</a></td>
                            </tr>
                            <tr>
                                <td align="left">Curso</td>
                                <td align="center"><a href="" class="btn btn-vermelho d-inline-block">Excluir</a></td>
                            </tr>
                            <tr>
                                <td align="left">Curso</td>
                                <td align="center"><a href="" class="btn btn-vermelho d-inline-block">Excluir</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="window load" id="janela1" data-keyboard="false" data-backdrop="static">
    <div class="px-4 width-100 d-inline-block text-center">
        <img src="https://mjailton.com.br/imagens_geral/ajax-loader2.gif" class="d-block m-auto">
        <span class="d-block text-center text-azul pb-2">Carregando...</span>
    </div>
</div>
<div id="mascara"></div>
<script>
    function gerarExcel() {
        $.ajax({
            type: "POST",
            url: "app/views/DesempenhoCurso/gerarExcel.php",
            dataType: "Json",
            data: {
                valor: 1
            },
            beforeSend: function() {
                id = document.getElementById("janela1");
                var alturaTela = $(document).height();
                var larguraTela = $(window).width();

                //colocando o fundo preto
                $('#mascara').css({
                    'width': larguraTela,
                    'height': alturaTela
                });
                $('#mascara').fadeIn(1000);
                $('#mascara').fadeTo("slow", 0.8);

                var left = ($(window).width() / 2) - ($(id).width() / 2);
                var top = ($(window).height() / 2) - ($(id).height() / 2);

                $(id).css({
                    'top': top,
                    'left': left
                });
                $(id).show();
                $(window).scrollTop(0);
            },
            success: function(data) {
                console.log(data);
                $("#mascara").hide();
                $(".window").hide();
                if (data.valor == 1) {
                    document.getElementById("btnExport2").style.display = "";
                }
            }
        });
        // document.location.href = ("app/views/DesempenhoCurso/gerarExcel.php");
    }
</script>