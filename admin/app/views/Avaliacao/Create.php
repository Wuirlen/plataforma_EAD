<script src="<?php echo URL_BASE."assets/js/js_aula.js"?>"></script>
<div class="caixa-home">
    <h1 class="titulo"><i class="fas fa-list-alt"></i> CADASTRO DE Avaliacao</h1>
    <div class="base-form">
        <?php 
				$this->verErro();
				$this->verMsg();					
			?>
             <div class=" d-flex text-justify-end">
                <a href="<?php echo URL_BASE."modulo/edit/$avaliacao->id_modulo"?>" class="btn d-inline-block mx-1">Voltar</a>
            </div>
        <ul class="tabs alt">
            <li class="current" data-tab="tab-1">Dados</li>
        </ul>
        <div id="tab-1" class="tab-content current">
        <div class="p-3">
            <span class="titulo2 h5 text-uppercase pt-3 mb-3">Dados Da Avaliação</span>
            <form action="<?php echo URL_BASE."avaliacao/salvar"?>" method="Post" enctype="multipart/form-data">
            <div class="rows">
         
            <input style="display: none;" placeholder="Informa um Título" type="text" id="id_modulo" name="id_modulo" value="<?php echo isset($avaliacao->id_modulo) ? $avaliacao->id_modulo : null ?>" class="form-campo">
            <input style="display: none;" placeholder="Informa um Título" type="text" id="id_avaliacao" name="id_avaliacao" value="<?php echo isset($avaliacao->id_avaliacao) ? $avaliacao->id_avaliacao : null ?>" class="form-campo">
           <!-- <div class="col-12 mb-3">
                    <label class="label">Título da Avaliação</label> <input placeholder="Informa um Título para Avaliação" type="text" id="titulo_avaliacao" name="titulo_avaliacao" class="form-campo">

            </div> -->
            <div class="col-12 mb-3">
                    <label class="label">Titulo da Questão</label> <input placeholder="Informa um Título" type="text" id="titulo_pergunta" name="titulo_pergunta" value="<?php echo isset($avaliacao->titulo_pergunta) ? $avaliacao->titulo_pergunta : null ?>" class="form-campo">
                    
                </div>
            <table cellpadding="0" cellspacing="0" border="0" class="tabela width-100">
            <thead>
                <tr>
                <th>Questão</th>
                <th>Resposta Certa</th>
                </tr>
            </thead>
             <tdbody id="tabela_input">
                 <tr >
                     <th style="padding: 10px!important;"> <input placeholder="Alternativa A" type="text" id="questao_a" name="questao_a" value="<?php echo isset($avaliacao->questao_a) ? $avaliacao->questao_a : null ?>"  class="form-campo"></th>
                     <th><input  type="radio" name='radio' id='radio_1' value="questao_a"></th>
                 </tr>
                 <tr >
                     <th style="padding: 10px!important;"><input placeholder="Alternativa B" type="text" id="questao_b" name="questao_b" value="<?php echo isset($avaliacao->questao_b) ? $avaliacao->questao_b : null ?>"  class="form-campo"></th>
                     <th><input type="radio" name='radio' id='radio_2' value="questao_b"></th>
                 </tr>
                 <tr >
                     <th style="padding: 10px!important;"><input placeholder="Alternativa C" type="text" id="questao_c" name="questao_c" value="<?php echo isset($avaliacao->questao_c) ? $avaliacao->questao_c : null ?>" class="form-campo"></th>
                     <th><input type="radio" name='radio' id='radio_3' value="questao_c"></th>
                 </tr>
                 <tr >
                     <th style="padding: 10px!important;"><input placeholder="Alternativa D" type="text" id="questao_d" name="questao_d" value="<?php echo isset($avaliacao->questao_d) ? $avaliacao->questao_d : null ?>" class="form-campo"></th>
                     <th><input type="radio" name='radio' id='radio_4' value="questao_d"></th>
                 </tr>
             </tdbody>
            </table>
            <input  type="text" style="display: none;" id="resposta" name="resposta" value="<?php echo isset($avaliacao->resposta) ? $avaliacao->resposta : null ?>">
                <div style="margin: auto!important;" class="mt-4 col-2">
                <input type="submit" name="cadastrar" value="cadastrar"  class="btn d-table m-auto">                </div>
            </div>
            </form>
        </div>
        </div>
    </div>
</div>
<script>
    $(function() {
       b = document.getElementById('resposta').value;
       if($('#radio_1').val() == b){
        $("#radio_1").prop("checked", true);
       }
       if($('#radio_2').val() == b){
        $("#radio_2").prop("checked", true);
       }
       if($('#radio_3').val() == b){
        $("#radio_3").prop("checked", true);
       }
       if($('#radio_4').val() == b){
        $("#radio_4").prop("checked", true);
       }
    $('input[name=radio]').click(function() {
        if($('#radio_1').is(':checked')){
            var a = $('input[name=radio]:checked').val();
             $('#resposta').val(a);
        }
        if($('#radio_2').is(':checked')){
            var a = $('input[name=radio]:checked').val();
             $('#resposta').val(a);
        }
        if($('#radio_3').is(':checked')){
            var a = $('input[name=radio]:checked').val();
             $('#resposta').val(a);
        }
        if($('#radio_4').is(':checked')){
            var a = $('input[name=radio]:checked').val();
             $('#resposta').val(a);
        }
    });
});
</script>