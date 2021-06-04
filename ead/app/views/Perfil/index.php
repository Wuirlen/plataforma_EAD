<style type="text/css">
.maius
{
text-transform: uppercase;
}
</style>
<script>
function pegaArquivo(files){
	var tipoArquivo = ["image/jpeg","image/png", "image/jpg", "imag/gif"];
	var file = files[0];
	var tipo = file.type;
	if(!tipoArquivo.includes(tipo)){
		alert("tipo de Arquivo inválido");
		$("#arquivo").val("");
		$("#imgUp").attr("src",url_img + "img-usuario.png" );
		return false;
	}else{
		const fileReader = new FileReader();
		fileReader.onloadend = function(){
			$("#imgUp").attr("src", fileReader.result);
		}
		fileReader.readAsDataURL(file);
	}
}
</script>
<div class="caixa">
    <h2 class="titulo"><span class="case"><i class="ico user"></i>Meu perfil</span> Editar e alterar dados do perfil
</h2>
</div>
<div class="base-home">
    <div class="rows base-perfil py-3">
        <div class="col-12">
            <div class="caixa">
                <form action="<?php echo URL_BASE . "perfil/salvar" ?>" method="POST" enctype="multipart/form-data">
                    <fieldset class="mt-1">
                        <legend>Dados do cadastro</legend>
                        <div class="rows">
                            <div class="col-6">
                                <label>Foto perfil</label>
                                <div class="thumb">
                             
                                <img src="<?php  echo $dados[0]->foto_aluno ? URL_IMAGEM . $dados[0]->foto_aluno : URL_IMAGEM . "img-usuario.png" ?>" id="imgUp" >
                                    <input type="file" name="foto_aluno" id="arquivo" onchange="pegaArquivo(this.files)">
                                </div>
                                <small class="text-center d-block">Tamanho máximo: 220px altura x 220px largura</small>
                            </div>

                            <div class="col-6">
                                <div class="py-1">
                                    <?php 
                                     echo $bugas;
                                     unset($bugas);
                                    ?>
                                    <label>Nome</label>
                                    <?php $nome = strtoupper($dados[0]->nome_aluno); ?>
                                    <input type="text"  name="nome_aluno" placeholder="Nome" class="maius" value="<?php echo isset($nome) ? $nome : null ?>">
                                    <input type="hidden"  name="id_aluno" placeholder="Nome" value="<?php echo isset($dados[0]->id_aluno) ? $dados[0]->id_aluno : null ?>">

                                </div>
                                <div class="py-1">
                                    <label>Email</label>
                                    <?php $email = strtoupper($dados[0]->email); ?>
                                    <input class="maius" type="text" name="email" placeholder="Email" value="<?php echo isset($email) ? $email : null ?>">
                                </div>
                                <div class="py-1">
                                    <label>Senha</label>
                                    <input type="password" name="senha" placeholder="Senha" value="<?php echo isset($dados[0]->senha) ? $dados[0]->senha : null ?>">
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>Dados pessoais</legend>
                        <div class="rows">
                            <div class="col-3 mb-3">
                                <label>CPF</label>
                                <input  readonly='true' type="text" name="cpf" placeholder="CPF" value="<?php echo isset($dados[0]->cpf) ? $dados[0]->cpf : null ?>">
                            </div>
                            <div class="col-3 mb-3">
                                <label>Data de Cadastro</label>
                                <?php $date = new DateTime($dados[0]->data_cadastro);
                                                $resultado = $date->format('d/m/Y');
                                 ?>
                                <input readonly='true' type="text" name="data_cadastro" placeholder="Data" value="<?php echo isset($resultado) ? $resultado : null ?>">
                            </div>
                            <div class="col-3 mb-3">
                                <label>Telefone</label>
                                <input readonly='true' type="text" name="telefone" placeholder="TElefone" value="<?php echo isset($dados[0]->telefone) ? $dados[0]->telefone : null ?>">
                            </div>
                            <div class="col-3 mb-3">
                                <label>Profissão</label>
                                <input readonly='true' type="text" name="nome_cargo" placeholder="Profissão" value="<?php echo isset($dados[0]->nome_cargo) ? $dados[0]->nome_cargo : null ?>">
                                <input type="hidden" name="id_cargo_aluno" placeholder="Profissão" value="<?php echo isset($dados[0]->id_cargo_aluno) ? $dados[0]->id_cargo_aluno : null ?>">

                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend>Endereço</legend>
                        <div class="rows">
                            <div class="col-4 mb-3">
                          
                                <label>Bairro</label>
                                <input readonly='true' type="text" name="bairro_aluno" placeholder="Bairro" value="<?php echo isset($dados[0]->bairro_aluno) ? $dados[0]->bairro_aluno : null ?>">
                            </div>
                            <div class="col-4 mb-3">
                                <label>Cidade</label>
                                <input readonly='true' type="text" name="cidade_aluno" placeholder="Cidade" value="<?php echo isset($dados[0]->cidade_aluno) ? $dados[0]->cidade_aluno : null ?>">
                            </div>
                            <div class="col-4 mb-3">
                                <label>Endereço</label>
                                <input readonly='true' type="text" name="endereco_aluno" placeholder="Endereço" value="<?php echo isset($dados[0]->endereco_aluno) ? $dados[0]->endereco_aluno : null ?>">
                            </div>
                        </div>
                        <div class="rows">
                            <div class="col-4 mb-3">
                                <label>Estado</label>
                                <input readonly='true' type="text" name="uf" placeholder="Estado" value="<?php echo isset($dados[0]->uf) ? $dados[0]->uf : null ?>">
                            </div>
                            <div class="col-4 mb-3">
                                <label>CEP</label>
                                <input readonly='true' type="text" name="cep" placeholder="CEP" value="<?php echo isset($dados[0]->cep) ? $dados[0]->cep : null ?>">
                            </div>
                         
                        </div>
                    </fieldset>

                    <input type="submit" value="Atualizar perfil" class="btn d-table m-auto px-5 width-auto">
                </form>
            </div>
        </div>
    </div>
</div>