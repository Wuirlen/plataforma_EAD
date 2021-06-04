<script src="<?php echo URL_BASE ?>assets/css/style.css"></script>
<div class="caixa-home">
  <section>
    <h1 class="titulo"><i class="fas fa-list-alt"></i> cadastro de Cargos</h1>
    <div class="base-form">
      <?php
      $this->verErro();
      $this->verMsg();
      ?>
      <form action="<?php echo URL_BASE . "cargo/salvar" ?>" method="POST" enctype="multipart/form-data">
        <div class="rows">
          <div class="col-12 mb-3">
            <label class="label">Nome do Cargo</label>
            <input name="nome_cargo" value="<?php echo isset($cargo->nome_cargo) ? $cargo->nome_cargo : null ?>" type="text" placeholder="Insira um nome do Cargo" class="form-campo">
          </div>
          <div class="col-12 mb-3">
            <label class="label">Descricao</label>
            <input name="descricao" value="<?php echo isset($cargo->descricao) ? $cargo->descricao : null ?>" type="text" placeholder="Insira uma Descricao do Cargo..." class="form-campo">
          </div>
          <div class="col-12 mt-3">
            <input type="hidden" name="id_cargo" value="<?php echo isset($cargo->id_cargo) ? $cargo->id_cargo : 0 ?>" />
            <input type="submit" value="Cadastrar" class="btn m-auto d-table">
          </div>
        </div>
      </form>
    </div>


  </section>

</div>