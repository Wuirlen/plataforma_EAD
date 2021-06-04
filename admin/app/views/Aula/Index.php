<div class="caixa-home">
			<h1 class="titulo"><i class="fas fa-list-alt"></i> LISTA DE AULAS</h1>
			<div class="base-lista">
				<div class="rows">
				<div class="col-12 d-flex text-justify-end mb-2">
					<a href="<?php echo URL_BASE."aula/create"?>" class="btn mx-1">Adicionar novo</a>
				
				</div>
				<div class="col-12">
					<div class="mostraFiltro">
						<form action="" method="">
							<div class="rows">
								<div class="col-10"><input type="text" placeholder="Aula" class="form-campo"></div>
								<div class="col-2"><input type="submit" value="Buscar" class="btn width-100"></div>
							</div>
						</form>
					</div>
				</div>
				
				<div class="col-12">
					<table  data-page-length='5' cellpadding="0" cellspacing="0" border="0"  id="dataTable">
						<thead>
							<tr>
								<th width="8%">id</th>
								<th width="30%" align="left">Aula</th>
								<th align="center">Duração</th>
								<th align="center" width="30%">Embed</th>
								<th >Editar</th>
								<th >Download</th>
								<th>Excluir </th>
							</tr>
						</thead>
						<tbody>
						<?php foreach($lista as $aula){ ?>
							<tr>
								<td align="center"><?php echo $aula->id_aula ?></td>
								<td align="left"><?php echo $aula->titulo_aula ?></td>
								<td align="center"><?php echo $aula->duracao_aula ?></td>
								<td align="center"><?php echo $aula->embed_youtube ?></td>
								<td align="center"><a href="<?php echo URL_BASE."aula/edit/".$aula->id_aula?>" class="btn editar">Editar</a></td>
								<td><a href="form_download.html" class="btn btn-azul">Downloads</a></td>
								<td align="center"><a href="javascript:if(confirm('Deseja Realmente excluir?')){ window.location.href = '<?php echo URL_BASE."aula/excluir/".$aula->id_aula?>'}"
                                 class="btn btn-vermelho">Excluir</a></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
		</div>            	
	</div>
		
  </div>