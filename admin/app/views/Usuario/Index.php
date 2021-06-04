<div class="caixa-home">
    <h1 class="titulo"><i class="fas fa-list-alt"></i> LISTA DE Usuários</h1>
    <div class="base-lista">
        <div class="rows">
            <div class="col-12 d-flex text-justify-end mb-2">
                <a href="<?php echo URL_BASE."usuario/create"?>" class="btn d-inline-block mx-1">Adicionar novo</a>
                <a href="" class="filtro btn btn-azul d-inline-block">Filtrar</a>
            </div>
        
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
                <table  data-page-length='5' cellpadding="0" cellspacing="0" border="0" id="dataTable">
                    <thead>
                        <tr>
                            <th width="8%">id</th>
                            <th align="left">Nome</th>
                            <th align="left">Login</th>
                            <th align="left">Senha</th>
                            <th align="right">Editar</th>
                            <th>Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($lista as $usuario) { ?>
                        <tr>
                            <td align="center"><?php echo $usuario->id_usuario ?></td>
                            <td align="left"><?php echo $usuario->nome_usuario ?></td>
                            <td align="left"><?php   echo $usuario->login_usuario ?></td>
                            <td align="left"><?php   echo $usuario->senha_usuario ?></td>
                            <td align="right"><a href="<?php echo URL_BASE."usuario/edit/".$usuario->id_usuario?>"
                                    class="btn editar">Editar</a></td>
                            <td align="center"><a href="javascript:if(confirm('Deseja Realmente excluir?')){ window.location.href = '<?php echo URL_BASE."usuario/excluir/".$usuario->id_usuario?>'}"
                                 class="btn btn-vermelho">Excluir</a></td>
                        </tr>
                        <?php } ?>
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
<div id="mascara"></div>