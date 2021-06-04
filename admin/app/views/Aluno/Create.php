<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

<script src="<?php echo URL_BASE ?>assets/js/js_aluno.js"></script>

<div class="caixa-home">
    <section>
        <h1 class="titulo"><i class="fas fa-list-alt"></i> cadastro de alunos</h1>
        <div class="base-form">
            <?php
            $this->verErro();
            $this->verMsg();
            ?>
            <form action="<?php echo URL_BASE . "aluno/salvar" ?>" method="POST" enctype="multipart/form-data">
                <div class="rows">
                    <div class="col-4 mb-3">
                        <div class="foto">
                            <img src="<?php echo isset($aluno->foto) ? URL_IMAGEM . $aluno->foto : URL_IMAGEM . "img-usuario.png" ?>" id="imgUp" class="img-fluido">
                        </div>
                    </div>
                    <div class="col-8 mb-3">
                        <label class="label">Foto do Arquivo</label>
                        <input type="file" name="arquivo" id="arquivo" onchange="pegaArquivo(this.files)" class="form-campo">
                        <small class="d-block pt-2">Escolha um Arquivo do Tipo Xmls</small>
                      <!--  <small class="d-block pt-1">Tamanho não pode ultrapassar 100KB (860 x 600 pixels)</small> -->
                    </div>
                    <div class="col-12 mt-3">
                        <input type="hidden" name="id_aluno" value="<?php //echo isset($aluno->id_aluno) ? $aluno->id_aluno : 0 ?>" />
                        <input type="submit" value="Cadastrar" class="btn m-auto d-table">
                    </div>
                </div>
            </form>
    
        </div>
    </section>

</div>
