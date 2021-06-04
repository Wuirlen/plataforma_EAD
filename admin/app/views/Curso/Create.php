<script src="<?php echo URL_BASE ?>assets/js/js_curso.js"></script>

<div class="caixa-home">
	<h1 class="titulo"><i class="fas fa-list-alt"></i> CADASTRO DE CURSO</h1>
	<div class="base-form">
		<?php
		$this->verErro();
		$this->verMsg();
		?>
		<!-- Curso - Modal -->

		<ul class="tabs alt">
			<li class="current" data-tab="tab-1">Dados Curso</li>
			<li id="teste" style="display: inline;" data-tab="tab-2">Grade Curricular</li>
		</ul>
		<div id="tab-1" class="tab-content current">
			<div class="p-3">
				<form action="<?php echo URL_BASE . "curso/salvar" ?>" method="Post" enctype="multipart/form-data">
					<div class="rows">

						<div class="col-4 mb-3">
							<div class="foto">
								<img src="<?php echo isset($curso->imagem_curso) ? URL_IMAGEM . $curso->imagem_curso : URL_IMAGEM . "img-usuario.png" ?>" id="imgUp" class="img-fluido">
							</div>
						</div>
						<div class="col-8 mb-3">
							<label class="label">IMAGEM DO CURSO</label>
							<input type="file" name="arquivo" id="arquivo" onchange="pegaArquivo(this.files)" class="form-campo">
							<small class="d-block pt-2">Escolha uma imagem referente ao curso</small>
							<small class="d-block pt-1">Tamanho não pode ultrapassar 100KB (860 x 600 pixels)</small>
						</div>
						<div class="col-4 mb-3">
							<div class="foto">
								<img src="<?php echo isset($curso->imagem_assinatura) ? URL_IMAGEM . $curso->imagem_assinatura : URL_IMAGEM . "img-usuario.png" ?>" id="imgUpAssinatura" class="img-fluido">
							</div>
						</div>
						<div class="col-8 mb-3">
							<label class="label">IMAGEM DA ASSINATURA RH</label>
							<input type="file" name="assinatura" id="assinatura" onchange="pegaAssinatura(this.files)" class="form-campo">
							<small class="d-block pt-2">Escolha uma imagem referente a assinatura do rh</small>
							<small class="d-block pt-1">Tamanho não pode ultrapassar 100KB (860 x 600 pixels)</small>
						</div>
						<div class="col-12 mb-3">
							<label class="label">Título do curso</label>
							<input type="text" name="nome_curso" value="<?php echo isset($curso->nome_curso) ? $curso->nome_curso : null ?>" placeholder="Ex::Título do Curso" class="form-campo">
						</div>
						<div class="col-2 mb-3">
							<label class="label">Adicionar p/todos os cargos</label>
							<select value="" name="ativo_curso" class="form-campo">
							    <option></option>
								<option value="S">Sim</option>
								<option value="N">Não</option>
							</select>
						</div>
						<div class="col-4 mb-3">
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
							<label class="label">Carga Hóraria do Curso</label>
							<input type="text" id="QuantidadeHoras" name="duracao_curso" value="<?php echo isset($curso->duracao_curso) ? $curso->duracao_curso : null ?>" class="form-campo">

						</div>
						<div class="col-6 mb-3">
							<label class="label">Nome do Instrutor</label>
							<input type="text" name="nome_instrutor" value="<?php echo isset($curso->nome_instrutor) ? $curso->nome_instrutor : null ?>" placeholder="Ex::Nome do Instrutor" class="form-campo">
						</div>
					</div>
					<div class="col-12 mt-3">
						<input type="hidden" id="id_curso" name="id_curso" value="<?php echo isset($curso->id_curso) ? $curso->id_curso : 0 ?>">
						<input type="submit" name="" value="cadastrar" class="btn d-table m-auto">
					</div>
				</form>
			</div>
		</div>
		<div id="tab-2" class="tab-content">
			<div class="width-100">
				<div class="p-3">
					<span class="titulo2 h5 text-uppercase pt-3 mb-3">Dados</span>
					<div class="rows">
						<div class="col-12 mb-3">
							<label class="label">Grade Curricular do Curso</label>
							<input type="text" id="descricao_curso" name="descricao_curso" value="<?php echo isset($descricao_curso->descricao_curso) ? $descricao_curso->descricao_curso : null ?>" placeholder="Ex::Grade Curricular" class="form-campo">
						</div>
						<div class="mt-2 col-2">
							<input type="button" id="bt_arquivo" value="Enviar" onclick="upload_grade()" class="btn width-100 bt_download" />
						</div>
						<div class="col-12 mt-4">
							<table cellpadding="0" cellspacing="0" border="0" class="tabela width-100">
								<thead>
									<tr>
										<th align="center">Grade Curricular do Curso</th>
									 <!--	<th align="center">Editar</th> -->
										<th align="center">Excluir</th>
									</tr>
								</thead>
								<tbody id="lista_grade">
									<?php foreach($lista as $dados) { ?>
										<tr>
											<td align="center"><?php echo $dados->descricao_curso ?></td>
										<!--	<td align="center" width="5%"><a href="<?php //echo URL_BASE . "avaliacao/edit/" . $dados->id_descricao_curso ?>" class="btn editar">Editar</a></td> -->
											<td align="center" width="5%"><a href="javascript:if(confirm('Deseja Realmente excluir?')){ window.location.href = '<?php echo URL_BASE . "curso/excluir_descricao_curso/" . $dados->id_descricao_curso ?> '}" class="btn btn-vermelho">Excluir</a></td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script>
			function upload_grade() {
				var data = new FormData();
				data.append("id_curso", $("#id_curso").val());
				data.append("descricao_curso", $("#descricao_curso").val());
				$.ajax({
					type: "POST",
					url: base_url + "curso/fazer_upload_jquery",
					data: data,
					contentType: false,
					processData: false,
					dataType: "json",
					success: function(data) {
						if (data.erro <= 0) {
							console.log(data);
							lista_itens_avaliacao(data.lista);
							$("#descricao_curso").val("");
						} else {
							alert(data.msg);
						}
					},
					error: function() {

					}
				});

			}

		function lista_itens_avaliacao(data){   
		html = "<tr>";
		for(var i in data){ 
			console.log(data);
			html += '<td align="center">' + data[i].descricao_curso +  '</td>' + 
					 //'<td align="center"><a id="btn3" onclick=alert_validacao_edit_avaliacao('+ data[i].id_descricao_curso +')  class="btn editar d-inline-bock">Editar</a></td>' +
					 '<td width="10%" align="center"><a id="btn-4" onclick=alert_validacao_avaliacao('+ data[i].id_descricao_curso +')  class="btn btn-vermelho d-inline-bock">Excluir</a></td></tr>';
		 }
		 $("#lista_grade").html(html);
	 }

	 function alert_validacao_avaliacao(id_avaliacao){
	confirme = confirm('Deseja Realmente excluir?');
	if(confirme == true){
		$("#btn-4").append("class='btn btn-vermelho d-inline-bock'");
		window.location.href = 'http://localhost/projetos-tutiplast/mvc/admin/curso/excluir_descricao_curso/'+ id_avaliacao;
	}else{
		window.location.href = 'http://localhost/projetos-tutiplast/mvc/admin/curso/create';
	}
}
		</script>

	</div>
</div>