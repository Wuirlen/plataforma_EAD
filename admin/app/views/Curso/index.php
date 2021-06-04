<div class="caixa-home">
			<h1 class="titulo"><i class="fas fa-list-alt"></i> LISTA DE CURSOS</h1>
			<div class="base-lista">
			<div class="rows">
				<div class="col-12 d-flex text-justify-end mb-2">
					<a href="<?php echo URL_BASE."curso/create"?>" class="btn mx-1">Adicionar novo</a>
					
				</div>
				<div class="col-12">
					<div class="mostraFiltro">
						<form action="" method="">
							<div class="rows">
								<div class="col-10"><input type="text" placeholder="Curso" class="form-campo"></div>
								<div class="col-2"><input type="submit" value="Buscar" class="btn width-100"></div>
							</div>
						</form>
					</div>
				</div>
				<div class="col-12">
                <?php 
                    $this->verMsg();					
                ?>
					<table  data-page-length='5' cellpadding="0" cellspacing="0" border="0" id="dataTable">
					<thead>
						<tr>
							<th width="8%">id</th>
							<th width="25%" align="left">Curso</th>
							<th align="center">Duração</th>
							<th align="center">Editar</th>
							<th align="center">Excluir </th>
						</tr>
					</thead>
					<tbody>
                        <?php foreach($lista as $curso) { ?>
						<tr>
							<td align="center"><?php echo $curso->id_curso?></td>
							<td align="left"><?php echo $curso->nome_curso ?></td>
							<td align="center"><?php echo $curso->duracao_curso?></td>
							<td align="center"><a href="<?php echo URL_BASE."curso/edit/".$curso->id_curso?>" class="btn editar">Editar</a></td>
							<td align="center"><a href="javascript:if(confirm('Deseja Realmente excluir?')){ window.location.href = '<?php echo URL_BASE."curso/excluir/".$curso->id_curso?>'}" class="btn btn-vermelho">Excluir</a></td>
                        </tr>
                        <?php } ?>		
					</tbody>
				</table>
				</div>
			</div>
				
			</div>
		</div>