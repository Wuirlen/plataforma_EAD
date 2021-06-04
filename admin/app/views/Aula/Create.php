<script src="<?php echo URL_BASE."assets/js/js_aula.js"?>"></script>
<div class="caixa-home">
    <h1 class="titulo"><i class="fas fa-list-alt"></i> CADASTRO DE AULAS</h1>
    <div class="base-form">
        <?php 
				$this->verErro();
				$this->verMsg();					
			?>
        <ul class="tabs alt">
            <li class="current" data-tab="tab-1">Dados</li>
        </ul>
        <div id="tab-1" class="tab-content current">
            <div class="p-3">
                <span class="titulo2 h5 text-uppercase pt-3 mb-3">Dados</span>
                <form action="<?php echo URL_BASE."aula/salvar"?>" method="Post" enctype="multipart/form-data">
                    <div class="rows">
                        <div class="col-12 mb-3">
                            <label class="label">Titulo da aula</label> <input type="text" name="titulo_aula"
                                value="<?php echo $aula->titulo_aula ?>" class="form-campo">
                        </div>
                      
                        
                        <div class="col-6 mb-3">
                            <label class="label">Escolha um Curso</label>

                            <select   name="id_curso" id="id_curso" class="form-campo" >
                                <?php  foreach($cursos as $curso){
							$selecionado = ($aula->id_curso == $curso->id_curso) ? "selected" : "disabled";
							echo "<option value='$curso->id_curso' $selecionado>$curso->nome_curso</option>";

						}?>
                            </select>
                        </div>
                        <div class="col-3 mb-3">
                            <label class="label">Embed do vídeo</label> <input type="text" name="embed_youtube"
                                value="<?php echo isset($aula->embed_youtube) ? $aula->embed_youtube : null ?>"
                                placeholder="Embed do vídeo" class="form-campo">
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
                            <label class="label">Duração do vídeo</label> <input id="QuantidadeHoras" type="text" name="duracao_aula"
                                value="<?php echo isset($aula->duracao_aula) ? $aula->duracao_aula : null?>"
                                placeholder="Duração do vídeo..." class="form-campo">

                        </div>
                        <div class="col-10">
                        <span class="label">Carregar do arquivo</span>
                        <input type="file" id="arquivo" name="path_aula"   class="form-campo mb-3">
                    </div>
                        <div class="col-12 mt-3">
                            <input type="hidden" name="id_aula" id="id_aula"
                                value="<?php echo isset($aula->id_aula) ? $aula->id_aula : 0 ?>">
                                <input style="display: none;" type="text" name="id_modulo" id="id_modulo"
                                value="<?php echo isset($aula->id_modulo) ? $aula->id_modulo : 0 ?>">
                            <input type="submit" name="cadastrar" value="cadastrar"  class="btn d-table m-auto">
                        </div>

                </form>
            </div>
        </div>
    </div>
</div>
