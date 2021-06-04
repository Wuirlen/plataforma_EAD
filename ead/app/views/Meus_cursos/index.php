<div class="caixa">
    <h2 class="titulo"><span class="case"><i class="ico duvida"></i>Meus Cursos</span> Lista de Cursos</h2>
</div>
<div class="base-home">
    <div class="rows cursos py-3">
        <?php foreach ($lista_cursos as $curso) {
            if ($curso->qtde_aula) {
                $andamento = number_format(($curso->qtde_assistida / $curso->qtde_aula) * 100, 0);
            } else {
                $andamento = 0;
            }
        ?>
        <div class="col-3">
            <div class="caixa">
                <div style="    height: 200px;
    padding: 20px; overflow: hidden; ">
                    <img style="filter: drop-shadow(5px 5px 5px rgba(0, 0, 0, 0.068));"
                        src="<?php echo isset($curso->imagem_curso) ? URL_IMAGEM . $curso->imagem_curso : URL_IMAGEM . "img-usuario.png" ?>">
                </div>
                <div class="del-curso">
                    <p><?php echo $curso->nome_curso ?></p>
                    <small>Andamento <b><?php echo $andamento ?>%</b></small>
                    <progress value="<?php echo $curso->qtde_assistida ?>"
                        max="<?php echo $curso->qtde_aula ?>"></progress>
                    <a href="<?php echo URL_BASE . "curso/detalhe/" . $curso->id_curso ?>" class="btn">Ir para o
                        curso</a>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>