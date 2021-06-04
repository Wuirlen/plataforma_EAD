<style>
.sorting_1::after{
    content:"°";
}
</style>
<div class="caixa-home">
    <h1 class="titulo"><i class="fas fa-list-alt"></i> </h1>
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
                <table   data-page-length='5' cellpadding="0" cellspacing="0" data-order="[[ 1, &quot;asc&quot; ]]" border="0" id="dataTable">
                    <thead>
                        <tr>
                            <th width="20%" align="left">Nome do Aluno</th>
                            <th  align="center">Posição no Rank</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  $cont = 1;  foreach($rank as $key => $ranks) {   ?>
                        <tr>
                            <td align="left"><?php echo $ranks->nome_aluno ?></td>
                            <td align="center" ><?php echo $key+1  ?></td>
                            <?php if($key == 0){?>
                            <td><i class="fas fa-trophy fa-spin" style="font-size:30px;color:#ffd700;float:right"></i></td>
                            <?php }else if($key == 1){?>
                                <td> <i class="fas fa-trophy" style="font-size:30px;color:#dddd;float:right"></i></td>
                            <?php }else if($key == 2){?>
                                <td> <i class="fas fa-trophy" style="font-size:30px;float:right;color:#cd7f32"></i></td>
                            <?php }else{?>
                            <td></td>
                                <?php } ?>
                        </tr>   
                        <?php $cont++;} ?>
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
<div id="mascara"></div>
