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
                        <label class="label">Foto do Aluno</label>
                        <input type="file" name="arquivo" id="arquivo" onchange="pegaArquivo(this.files)" class="form-campo">
                        <small class="d-block pt-2">Escolha uma Foto referente ao Aluno</small>
                        <small class="d-block pt-1">Tamanho não pode ultrapassar 100KB (860 x 600 pixels)</small>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="label">Nome</label>
                        <input name="nome_aluno" value="<?php echo isset($aluno->nome_aluno) ? $aluno->nome_aluno : null ?>" type="text" placeholder="Insira um nome" class="form-campo">
                    </div>

                    <div class="col-4 mb-3">
                        <label class="label">Cargo</label>
                        <select name="id_cargo_aluno" id="id_cargo_aluno" class="form-campo">

                            <?php foreach ($cargos as $cargo) {

                                $selecionado = ($aluno->id_cargo_aluno == $cargo->id_cargo) ? "selected" : "";

                                echo "<option value='$cargo->id_cargo' $selecionado>$cargo->nome_cargo</option>";
                            } ?>
                        </select>
                    </div>

                    <div class="col-4 mb-3">
                        <label class="label">Endereco</label>
                        <input name="endereco_aluno" value="<?php echo isset($aluno->endereco_aluno) ? $aluno->endereco_aluno : null ?>" type="text" placeholder="Insira seu Endereço" class="form-campo">
                    </div>

                    <div class="col-4 mb-3">
                        <label class="label">Cidade</label>
                        <input name="cidade_aluno" value="<?php echo isset($aluno->cidade_aluno) ? $aluno->cidade_aluno : null ?>" type="text" placeholder="Insira sua Cidade" class="form-campo">
                    </div>
                    <div class="col-4 mb-3">
                        <label class="label">UF</label>
                        <select name="uf" class="form-campo">
                            <option value="<?php echo isset($aluno->uf) ? $aluno->uf : null ?>">
                                <?php echo isset($aluno->uf) ? $aluno->uf : "Selecione" ?></option>
                            <option value="AC">AC</option>
                            <option value="AL">AL</option>
                            <option value="AP">AP</option>
                            <?php if ($aluno->uf != "AM") {
                                echo "<option value='AM'>AM</option>";
                            } ?>
                            <option value="BA">BA</option>
                            <option value="CE">CE</option>
                            <option value="DF">DF</option>
                            <option value="ES">ES</option>
                            <option value="GO">GO</option>
                            <option value="MA">MA</option>
                            <option value="MS">MS</option>
                            <option value="MT">MT</option>
                            <option value="MG">MG</option>
                            <option value="PA">PA</option>
                            <option value="PB">PB</option>
                            <option value="PR">PR</option>
                            <option value="PE">PE</option>
                            <option value="PI">PI</option>
                            <option value="RJ">RJ</option>
                            <option value="RN">RN</option>
                            <option value="RS">RS</option>
                            <option value="RO">RO</option>
                            <option value="RR">RR</option>
                            <option value="SC">SC</option>
                            <option value="SP">SP</option>
                            <option value="SE">SE</option>
                            <option value="TO">TO</option>
                        </select>
                    </div>

                    <div class="col-4 mb-3">
                        <label class="label">Bairro</label>
                        <input name="bairro_aluno" value="<?php echo isset($aluno->bairro_aluno) ? $aluno->bairro_aluno : null ?>" type="text" placeholder="Insira seu bairro" class="form-campo">
                    </div>

                    <div class="col-4 mb-3">
                        <script type="text/javascript">
                            $(document).ready(function() {
                                $("#matricula").mask("999999999");
                            });
                        </script>
                        <label class="label">Matricula</label>
                        <input name="matricula" id="matricula" value="<?php echo isset($aluno->matricula) ? $aluno->matricula : null ?>" type="text" placeholder="Ex.: 00000000" class="form-campo">
                    </div>
                    <div class="col-4 mb-3">
                        <label class="label">Celular</label>
                        <input type="tel" name="telefone" placeholder="Ex.: (00) 00000-0000" class="form-campo" value="<?php echo isset($aluno->telefone) ? $aluno->telefone : null ?>" id="telefone" />
                        <script type="text/javascript">
                            $("#telefone").mask("(00) 00000-0009");
                        </script>
                    </div>
                    <div class="col-4 mb-3">
                        <label class="label">Email</label>
                        <input name="email" value="<?php echo isset($aluno->email) ? $aluno->email : null ?>" type="text" placeholder="Insira um email" class="form-campo">
                    </div>
                    <div class="col-4 mb-3">
                        <label class="label">Cpf</label>
                        <input id="cpf" name="cpf" value="<?php echo isset($aluno->cpf) ? $aluno->cpf : null ?>" type="text" placeholder="Ex.: 000.000.000-00" class="form-campo">
                        <script type="text/javascript">
                            $(document).ready(function() {
                                $("#cpf").mask("999.999.999-99");
                            });
                        </script>
                    </div>
                    <div class="col-6 mb-3">
                        <label class="label">Data de cadastro</label>
                        <input name="data_cadastro" value="<?php echo isset($aluno->data_cadastro) ? $aluno->data_cadastro : null ?>" type="date" placeholder="Insira sua data" class="form-campo">
                    </div>
                    <div class="col-6 mb-3">
                        <label class="label">Senha</label>
                        <input name="senha" value="<?php echo isset($aluno->senha) ? $aluno->senha : null ?>" type="password" placeholder="Insira sua Senha" class="form-campo">
                    </div>
                    <div class="col-12 mt-3">
                        <input type="hidden" name="id_aluno" value="<?php echo isset($aluno->id_aluno) ? $aluno->id_aluno : 0 ?>" />
                        <input type="submit" value="Cadastrar" class="btn m-auto d-table">
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>