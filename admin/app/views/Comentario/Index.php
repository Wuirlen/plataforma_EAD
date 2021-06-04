<div class="caixa-home">
		<h1 class="titulo"><i class="fas fa-list-alt"></i> LISTA DE COMENTÁRIOS</h1>
		<div class="base-lista">
			<div class="rows">
				<div class="col-12 d-flex text-justify-end mb-2">
				
				</div>
				<div class="col-12">
					<div class="mostraFiltro">
						<form action="" method="">
							<div class="rows">
								<div class="col-10"><input type="text" placeholder="Comentário" class="form-campo"></div>
								<div class="col-2"><input type="submit" value="Buscar" class="btn width-100"></div>
							</div>
						</form>
					</div>
				</div>
				<div class="col-12">
					<table  data-page-length='5' cellpadding="0" cellspacing="0" border="0" id="dataTable">
						<thead>
							<tr>
								<th width="8%">id</th>
								<th width="40%" align="left">Título</th>
								<th align="center">Data</th>
								<th align="center">Hora</th>
								<th >Editar</th>
								<th>Excluir </th>
							</tr>
						</thead>
						<tbody>
						<?php foreach($lista as $comentario) { ?>
							<tr>
								<td align="center"><?php echo $comentario->id_comentario ?></td>
								<td align="left"><?php echo $comentario->titulo_comentario ?></td>
								<td align="center"><?php echo $comentario->data_comentario ?></td>
								<td align="center"><?php echo $comentario->hora_comentario ?></td>
								<td align="center"><a href="<?php echo URL_BASE."comentario/edit/".$comentario->id_comentario?>" class="btn editar">Ver</a></td>
								<td align="center"><a href="javascript:if(confirm('Deseja Realmente excluir?')){ window.location.href = '<?php echo URL_BASE."comentario/excluir/".$comentario->id_comentario?>'}"
                                 class="btn btn-vermelho">Excluir</a></td>
							</tr>	
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div> 