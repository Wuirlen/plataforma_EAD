<script src="<?php echo URL_BASE."assets/js/js_aula.js"?>"></script>
<div class="caixa-home">
			<h1 class="titulo"><i class="fas fa-list-alt"></i> LISTA DE Módulos</h1>
			<div class="base-lista">
				<div class="rows">
				<div class="col-12 d-flex text-justify-end mb-2">
					<a  href="<?php echo URL_BASE."modulo/create"?>" class="btn mx-1">Adicionar novo Módulo</a>
				
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
				<?php
                 $this->verErro();
				 $this->verMsg();
                ?>
					<table  data-page-length='5'   class="display nowrap"   cellpadding="0" cellspacing="0" border="0"   id="dataTable">
						<thead>
							<tr>
								<th>Módulo</th>
								<th width="30%" align="center">Curso</th>
								<th >Editar / Add Aulas</th>
								<th>Excluir </th>
							</tr>
						</thead>
						<tbody>
						<?php foreach($lista as $modulo){ ?>
							<tr>
								<td align="center"><?php echo $modulo->titulo_modulo ?></td>
								<td align="center"><?php echo $modulo->nome_curso ?></td>
								<td align="center"><a href="<?php echo URL_BASE."modulo/edit/".$modulo->id_modulo?>" class="btn editar">Entrar</a></td>
								<td align="center"><a href="javascript:if(confirm('Deseja Realmente excluir?')){ window.location.href = '<?php echo URL_BASE."modulo/excluir/".$modulo->id_modulo?>'}"
                                 class="btn btn-vermelho">Excluir</a></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
		</div>            	
	</div>
		
  </div>