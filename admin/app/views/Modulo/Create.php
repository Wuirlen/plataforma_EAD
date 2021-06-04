<script src="<?php echo URL_BASE . "assets/js/js_modulo.js" ?>"></script>
<div class="caixa-home">
    <h1 class="titulo"><i class="fas fa-list-alt"></i> CADASTRO DE AULAS</h1>
    <div class="base-form">
        <input type="text" style="display: none;" id="curso_inicial" value="<?php echo $modulo->id_curso; ?>">
        <?php
        $this->verErro();
        $this->verMsg();
        ?>
        <div class=" d-flex text-justify-end">
            <a href="<?php echo URL_BASE . "modulo/index" ?>" class="btn d-inline-block mx-1">Voltar</a>
        </div>
        <ul class="tabs alt">
            <li class="current" data-tab="tab-1">Módulo</li>
            <li id="teste" style="display: inline;" data-tab="tab-2">Aula(s)</li>
            <li id="teste_2" style="display: inline;" data-tab="tab-3">Avaliação</li>
        </ul>
        <div id="tab-1" class="tab-content current">
            <div class="p-3">
                <span class="titulo2 h5 text-uppercase pt-3 mb-3">Dados</span>
                <form action="<?php echo URL_BASE . "modulo/salvar" ?>" method="Post" enctype="multipart/form-data">
                    <div class="rows">
                        <div class="col-12 mb-3">
                      
                            <label class="label">Titulo do Modulo</label> <input type="text" name="titulo_modulo" value="<?php echo $modulo->titulo_modulo ?>" class="form-campo">
                        </div>
                        <div class="col-6 mb-3">
                            <label class="label">Escolha um Curso</label>
                            <?php if ($modulo->id_curso == 0) {  ?>
                                <select name="id_curso" id="id_curso" class="form-campo">
                                    <?php foreach ($cursos as $curso) {
                                        $selecionado = ($modulo->id_curso == $curso->id_curso) ? "selected" : "";
                                        echo "<option value='$curso->id_curso' $selecionado>$curso->nome_curso</option>";
                                    } ?>
                                </select>
                            <?php } else {  ?>
                                <select name="id_curso" id="id_curso" class="form-campo">
                                    <?php foreach ($cursos as $curso) {
                                        $selecionado = ($modulo->id_curso == $curso->id_curso) ? "selected" : "disabled";
                                        echo "<option value='$curso->id_curso' $selecionado>$curso->nome_curso</option>";
                                    } ?>
                                </select>
                            <?php } ?>
                        </div>
                        <div class="col-12 mb-3">
                    <label class="label">Título da Avaliação do Módulo</label> <input placeholder="Informa um Título para Avaliação" type="text" id="titulo_avaliacao" value="<?php echo $modulo->titulo_avaliacao ?>" name="titulo_avaliacao" class="form-campo">
                        </div>
                        <div class="col-12 mt-3">
                            <input type="hidden" name="id_modulo" id="id_modulo" value="<?php echo isset($modulo->id_modulo) ? $modulo->id_modulo : 0 ?>">
                            <input type="submit" name="cadastrar" value="cadastrar" class="btn d-table m-auto">
                        </div>
                </form>
            </div>
        </div>
    </div>
    <div id="tab-2" class="tab-content">
        <div class="width-100">
            <div class="p-3">
                <span class="titulo2 h5 text-uppercase pt-3 mb-3">Dados</span>
                <div class="rows">
                    <div class="col-12 mb-3">
                        <label class="label">Titulo da aula</label> <input type="text" id="titulo_aula" name="titulo_aula" value="<?php echo $aula->titulo_aula ?>" class="form-campo">
                    </div>

                    <div class="col-3 mb-3">
                        <label class="label">Embed do vídeo</label> <input type="text" id="embed_youtube" name="embed_youtube" value="<?php echo isset($aula->embed_youtube) ? $aula->embed_youtube : null ?>" placeholder="Embed do vídeo" class="form-campo">
                    </div>
                    <div class="col-3 mb-3">
                        <script>
                            var mask = function(val) {
                                val = val.split(":");
                                return (parseInt(val[0]) > 19) ? "HZ:M0" : "H0:M0";
                            }

                            pattern = {
                                onKeyPress: function(val, e, field, options) {
                                    field.mask(mask.apply({}, arguments), options);
                                },
                                translation: {
                                    'H': {
                                        pattern: /[0-2]/,
                                        optional: false
                                    },
                                    'Z': {
                                        pattern: /[0-3]/,
                                        optional: false
                                    },
                                    'M': {
                                        pattern: /[0-5]/,
                                        optional: false
                                    }
                                },
                                placeholder: 'Horas:Minutos'
                            };

                            $(document).ready(function() {
                                $("#QuantidadeHoras").mask(mask, pattern);
                            });
                        </script>
                        <label class="label">Duração do vídeo</label> <input id="QuantidadeHoras" type="text" name="duracao_aula" value="<?php echo isset($aula->duracao_aula) ? $aula->duracao_aula : null ?>" placeholder="Duração do vídeo..." class="form-campo">

                    </div>
                    <div class="col-3 mb-3">
                        <label class="label">Ativo</label> <select name="ativo_aula" class="form-campo">
                            <option value="S">Sim</option>
                            <option value="N">Não</option>
                        </select>
                    </div>
                    <div class="col-10">
                        <span class="label">Carregar do arquivo</span>
                        <input type="file" id="arquivo" class="form-campo mb-3">
                    </div>
                    <div class="mt-4 col-2">
                        <input type="button" id="bt_arquivo" value="Enviar" onclick="upload()" class="btn width-100 bt_download" />
                    </div>

                    <div class="col-12 mt-4">
                        <table cellpadding="0" cellspacing="0" border="0" class="tabela width-100">
                            <thead>
                                <tr>
                                    <th align="center">Titulo</th>
                                    <th align="center">Editar</th>
                                    <th align="center">Excluir</th>

                                </tr>
                            </thead>
                            <tbody id="lista_down">
                                <?php foreach ($aulas as $aula) { ?>
                                    <tr>
                                        <td align="center"><?php echo $aula->titulo_aula ?></td>
                                        <td align="center" width="5%"><a href="<?php echo URL_BASE . "aula/edit/" . $aula->id_aula ?>" class="btn editar">Editar</a></td>
                                        <td align="center" width="5%"><a href="javascript:if(confirm('Deseja Realmente excluir?')){ window.location.href = '<?php echo URL_BASE . "aula/excluir/" . $aula->id_aula ?> '}" class="btn btn-vermelho">Excluir</a></td>


                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="tab-3" class="tab-content">
        <div class="p-3">
            <span class="titulo2 h5 text-uppercase pt-3 mb-3">Dados Da Avaliação</span>
            <div class="rows">
           
                <div class="col-12 mb-3">
                    <label class="label">Título da Questão</label> <input placeholder="Informa um Título" type="text" id="titulo_pergunta" name="titulo_pergunta" class="form-campo">

                </div>
                <table cellpadding="0" cellspacing="0" border="0" class="tabela width-100">
                    <thead>
                        <tr>
                            <th>Questão</th>
                            <th>Resposta Certa</th>
                        </tr>
                    </thead>
                    <tdbody id="tabela_input">
                        <tr>
                            <th style="padding: 10px!important;"> <input placeholder="Alternativa A" type="text" id="questao_a" name="questao_a" class="form-campo"></th>
                            <th><input type="radio" name='radio' id='radio_1' value="questao_a"></th>
                        </tr>
                        <tr>
                            <th style="padding: 10px!important;"><input placeholder="Alternativa B" type="text" id="questao_b" name="questao_b" class="form-campo"></th>
                            <th><input type="radio" name='radio' id='radio_2' value="questao_b"></th>
                        </tr>
                        <tr>
                            <th style="padding: 10px!important;"><input placeholder="Alternativa C" type="text" id="questao_c" name="questao_c" class="form-campo"></th>
                            <th><input type="radio" name='radio' id='radio_3' value="questao_c"></th>
                        </tr>
                        <tr>
                            <th style="padding: 10px!important;"><input placeholder="Alternativa D" type="text" id="questao_d" name="questao_d" class="form-campo"></th>
                            <th><input type="radio" name='radio' id='radio_4' value="questao_d"></th>
                        </tr>
                    </tdbody>
                </table>
                <input style="display: none;" type="text" id="resposta" name="resposta" value="">
                <div style="margin: auto!important;" class="mt-4 col-2">
                    <input type="button" id="bt_arquivo" value="Gravar" onclick="upload_avaliacao()" class="btn width-100 bt_download" />
                </div>
                <div class="col-12 mt-4">
                    <table cellpadding="0" cellspacing="0" border="0" class="tabela width-100">
                        <thead>
                            <tr>
                                <th align="center">Titulo Da Questão</th>
                                <th align="center">Editar</th>
                                <th align="center">Excluir</th>
                            </tr>
                        </thead>
                        <tbody id="lista_avaliacao">
                            <?php foreach ($avaliacao as $dados) {  ?>
                                <tr>
                                    <td align="center"><?php echo $dados->titulo_pergunta ?></td>
                                    <td align="center" width="5%"><a href="<?php echo URL_BASE . "avaliacao/edit/" . $dados->id_avaliacao ?>" class="btn editar">Editar</a></td>
                                    <td align="center" width="5%"><a href="javascript:if(confirm('Deseja Realmente excluir?')){ window.location.href = '<?php echo URL_BASE . "avaliacao/excluir/" . $dados->id_avaliacao ?> '}" class="btn btn-vermelho">Excluir</a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            capturando = document.getElementById('curso_inicial').value;
            if (capturando == 0) {
                document.getElementById('teste').style.display = "none";
                document.getElementById('teste_2').style.display = "none";
            }
        });
        $(function() {
            $('input[name=radio]').click(function() {

                if ($('#radio_1').is(':checked')) {
                    var a = $('input[name=radio]:checked').val();
                    $('#resposta').val(a);
                }
                if ($('#radio_2').is(':checked')) {
                    var a = $('input[name=radio]:checked').val();
                    $('#resposta').val(a);
                }
                if ($('#radio_3').is(':checked')) {
                    var a = $('input[name=radio]:checked').val();
                    $('#resposta').val(a);
                }
                if ($('#radio_4').is(':checked')) {
                    var a = $('input[name=radio]:checked').val();
                    $('#resposta').val(a);
                }
            });
        });
    </script>