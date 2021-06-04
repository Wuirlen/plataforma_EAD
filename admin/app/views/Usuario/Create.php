<script src="<?php echo URL_BASE ?>assets/js/js_usuario.js"></script>
<div class="caixa-home">
    <section>
        <h1 class="titulo"><i class="fas fa-list-alt"></i> cadastro de usuários</h1>
        <div class="base-form">
            <?php 
				$this->verErro();
				$this->verMsg();					
			?>
            <form action="<?php echo URL_BASE."usuario/salvar"?>" method="POST" enctype="multipart/form-data">
                <div class="rows">
                <div class="col-4 mb-3">
                        <div class="foto">
                            <img src="<?php echo isset($usuario->foto) ? URL_IMAGEM . $usuario->foto : URL_IMAGEM . "img-usuario.png" ?>" id="imgUp" class="img-fluido">
                        </div>
                    </div>
                    <div class="col-8 mb-3">
        					<label class="label">Foto do Aluno</label>
    						<input type="file" name="arquivo" id="arquivo" onchange="pegaArquivo(this.files)" class="form-campo">
							<small class="d-block pt-2">Escolha uma Foto referente ao Aluno</small>
							<small class="d-block pt-1">Tamanho não pode ultrapassar 100KB (860 x 600 pixels)</small>
        				</div>
                    <div class="col-12 mb-3">
                        <label class="label">Nome</label>
                        <input name="nome_usuario"
                            value="<?php echo isset($usuario->nome_usuario) ? $usuario->nome_usuario : null ?>" type="text"
                            placeholder="Insira um nome" class="form-campo">
                    </div>
                    <div class="col-12 mb-3">
                        <label class="label">Login</label>
                        <input name="login_usuario" value="<?php echo isset($usuario->login_usuario) ? $usuario->login_usuario : null ?>"
                            type="text" placeholder="Insira um Login" class="form-campo">
                    </div>
                    <div class="col-6 mb-3">
                        <label class="label">Data de cadastro</label>
                        <input name="data_cadastro"
                            value="<?php echo isset($usuario->data_cadastro) ? $usuario->data_cadastro : null ?>"
                            type="date" placeholder="Insira sua data" class="form-campo">
                    </div>
                    <div class="col-6 mb-3">
                        <label class="label">Senha</label>
                        <input name="senha_usuario" value="<?php echo isset($usuario->senha_usuario) ? $usuario->senha_usuario : null ?>"
                            type="password" placeholder="Insira sua Senha" class="form-campo">
                    </div>
                    <div class="col-12 mt-3">
                        <input type="hidden" name="id_usuario"
                            value="<?php echo isset($usuario->id_usuario) ? $usuario->id_usuario : 0 ?>" />
                        <input type="submit" value="Cadastrar" class="btn m-auto d-table">
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
