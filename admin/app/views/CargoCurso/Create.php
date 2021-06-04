<script src="<?php

use app\crud\service\Service;

echo URL_BASE ?>assets/css/style.css"></script>
<style>
  .titulo i {
    margin-right: 10px !important;
  }

  table {
    width: 300px;
    border-collapse: collapse;
    float: left;
    border: 1px solid #948b8b6e;
    width: 100%;
    background-color: transparent;

  }

  table.table:last-of-type {
    margin: 0 auto;
  }

  table.table th {
    text-align: center;
    padding: 10px;
    font-family: monospace;
    font-size: 14px;
  }

  table.table tr {
    text-align: center;
    display: table-row;
  }

  table.table td {
    padding: 10px;
    font-family: monospace;
  }

  table.table tbody tr.selected {
    background-color: #f0f0f0;

  }

  table.table tbody span.selected {
    background: red;
    width: 10px;
  }
 

  .checkbox {
    --background: #fff;
    --border: #D1D6EE;
    --border-hover: #BBC1E1;
    --border-active: #44d163;
    --tick: #fff;
    position: relative;
  }

  .checkbox input,
  .checkbox svg {
    width: 21px;
    height: 21px;
    display: block;
  }

  .checkbox input {
    -webkit-appearance: none;
    -moz-appearance: none;
    position: relative;
    outline: none;
    background: var(--background);
    border: none;
    margin: 0;
    padding: 0;
    cursor: pointer;
    border-radius: 4px;
    -webkit-transition: box-shadow .3s;
    transition: box-shadow .3s;
    box-shadow: inset 0 0 0 var(--s, 1px) var(--b, var(--border));
  }

  .checkbox input:hover {
    --s: 2px;
    --b: var(--border-hover);
  }

  .checkbox input:checked {
    --b: var(--border-active);
  }

  .checkbox svg {
    pointer-events: none;
    fill: none;
    stroke-width: 2px;
    stroke-linecap: round;
    stroke-linejoin: round;
    stroke: var(--stroke, var(--border-active));
    position: absolute;
    top: 0;

    width: 21px;
    height: 21px;
    -webkit-transform: scale(var(--scale, 1)) translateZ(0);
    transform: scale(var(--scale, 1)) translateZ(0);
  }

  .checkbox.path input:checked {
    --s: 2px;
    -webkit-transition-delay: .4s;
    transition-delay: .4s;
  }

  .checkbox.path input:checked+svg {
    --a: 16.1 86.12;
    --o: 102.22;
  }

  .checkbox.path svg {
    stroke-dasharray: var(--a, 86.12);
    stroke-dashoffset: var(--o, 86.12);
    -webkit-transition: stroke-dasharray .6s, stroke-dashoffset .6s;
    transition: stroke-dasharray .6s, stroke-dashoffset .6s;
  }

  .checkbox.bounce {
    --stroke: var(--tick);
  }

  .checkbox.bounce input:checked {
    --s: 11px;
  }

  .checkbox.bounce input:checked+svg {
    -webkit-animation: bounce .4s linear forwards .2s;
    animation: bounce .4s linear forwards .2s;
  }

  .checkbox.bounce svg {
    --scale: 0;
  }

  @-webkit-keyframes bounce {
    50% {
      -webkit-transform: scale(1.2);
      transform: scale(1.2);
    }

    75% {
      -webkit-transform: scale(0.9);
      transform: scale(0.9);
    }

    100% {
      -webkit-transform: scale(1);
      transform: scale(1);
    }
  }

  @keyframes bounce {
    50% {
      -webkit-transform: scale(1.2);
      transform: scale(1.2);
    }

    75% {
      -webkit-transform: scale(0.9);
      transform: scale(0.9);
    }

    100% {
      -webkit-transform: scale(1);
      transform: scale(1);
    }
  }

  html {
    box-sizing: border-box;
    -webkit-font-smoothing: antialiased;
  }

  * {
    box-sizing: inherit;
  }

  *:before,
  *:after {
    box-sizing: inherit;
  }

  body .grid {

    display: grid;
  }

</style>

<div class="caixa-home">
  <section>
    <h1 class="titulo"><i class="fas fa-list-alt"></i> cadastro de Cargos e Cursos</h1>
    <div class="base-form">
      <?php
      $this->verErro();
      $this->verMsg();
      ?>
      <form action="<?php echo URL_BASE . "cargocurso/seleciona" ?>" method="POST" enctype="multipart/form-data">
        <div class="rows">
          <div class="col-6 mb-3">
            <h1 class="titulo"><i class="fas fa-list-alt"></i>Cargos</h1>
            <label class="label" style="color: #44d163; font-weight:bold;">Escolha um Cargo</label>

            <select name="id_cargo" id="id_cargo" class="form-campo">
              <?php foreach ($cargos as $cargo) {
                $selecionado = ($cargo_curso->id_cargo == $cargo->id_cargo) ? "selected" : "";

                echo "<option value='$cargo->id_cargo ' $selecionado> $cargo->nome_cargo</option>
                ";
              } ?>

            </select>

          </div>

          <div class="col-6 mb-3">
            <h1 class="titulo"><i class="fas fa-list-alt"></i>Cursos</h1>
            <label class="label" style="color: #44d163; font-weight:bold;">Escolha um Curso</label>
            <!-- Table-->
          
            <table  data-page-length='5' style="width:100%!important;"class="table" cellpadding="0" cellspacing="0" border="0" id="dataTable">
              <thead>
                <tr>
                  <th>
                  </th>
                  <th style="font-size:14pt;color:aliceblue;">Nome do Curso</th>
                  <th style="font-size:10pt;color:aliceblue;">Excluir</th>
                  <th style="font-size:10pt;color:aliceblue;">Obrigatório</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                 $cont = 0;
                 foreach ($cursos as $cargo_curso) { ?>
                 <?php 
                 
                  $array = (array) $cargo;
                  
                  if($array[$cont]->id_curso == $cargo_curso->id_curso){ ?>
                 <?php  
                    echo " <tr role='row'>
                  
                    <td> 
                     
                         
                     <div class='grid'>
  
      <label class='checkbox path'>
      <div class='form-group options'>
     
      <input id='checkbox' type='checkbox' name='checkbox_curso[]' value='$cargo_curso->id_curso' checked required disabled='disabled' />
                        
  
          <svg viewBox='0 0 21 21'>
              <path d='M5,10.75 L8.5,14.25 L19.4,2.3 C18.8333333,1.43333333 18.0333333,1 17,1 L4,1 C2.35,1 1,2.35 1,4 L1,17 C1,18.65 2.35,20 4,20 L17,20 C18.65,20 20,18.65 20,17 L20,7.99769186'></path>
          </svg>
          </div>
      </label>
                    </td>
                  <td>
                  
                  $cargo_curso->nome_curso</td> "; ?>
                  <td align="center"><a href="javascript:if(confirm('Deseja Realmente excluir?')){ window.location.href = '<?php echo URL_BASE . "cargocurso/excluir/" . $array[$cont]->id_cargo_curso ?>'}" class="btn btn-vermelho">Excluir</a></td>
                  </tr> 
                  <?php $cont++; }  else{ ?>
                 <?php   
                  echo " <tr role='row'>
                
                  <td> 
                   
                       
                   <div class='grid'>

    <label class='checkbox path'>
    <div class='form-group options'>
   
    <input id='checkbox' type='checkbox' name='checkbox_curso[]' value='$cargo_curso->id_curso' required />
    

        <svg viewBox='0 0 21 21'>
            <path d='M5,10.75 L8.5,14.25 L19.4,2.3 C18.8333333,1.43333333 18.0333333,1 17,1 L4,1 C2.35,1 1,2.35 1,4 L1,17 C1,18.65 2.35,20 4,20 L17,20 C18.65,20 20,18.65 20,17 L20,7.99769186'></path>
        </svg>
        </div>
    </label>
                  </td>
                <td>
                $cargo_curso->nome_curso</td>  ";?>
                
                <td align="center"><a style="display:none;" href="javascript:if(confirm('Deseja Realmente excluir?')){ window.location.href = '<?php echo URL_BASE . "cargocurso/excluir/" . $cargo_curso->id_cargo ?>'}" class="btn btn-vermelho">Excluir</a></td>
                <td><input type="checkbox" name="" id=""></td>
                </tr>
                <?php  } ?>
              <?php }  ?>
              <input style="display: none;" type='text' name="id" value='<?php echo $id?>' />   
              </tbody>
            </table>
            <!-- Table FIM-->
          </div>
          <div class="col-12 mt-3">
            <input type="hidden" name="id_cargo_curso" value="<?php  echo isset($cargo_curso->id_cargo_curso) ? $cargo_curso->id_cargo_curso : 0 ?>" />
            <input id="submit" type="submit" value="Cadastrar" class="btn m-auto d-table">
          </div>

      </form>
    </div>
  </section>

</div>

<script>
  $(document).ready(function() {
    $('.checkAll').on('click', function() {
      $(this).closest('table').find('tbody :checkbox')
        .prop('checked', this.checked)
        .closest('tr').toggleClass('selected', this.checked);
    });

    $('tbody :checkbox').on('click', function() {
      $(this).closest('tr').toggleClass('selected', this.checked);

      //Classe de seleção na row

      $(this).closest('table').find('.checkAll').prop('checked', ($(this).closest('table').find('tbody :checkbox:checked').length == $(this).closest('table').find('tbody :checkbox').length)); //Tira / coloca a seleção no .checkAll
    });
  });

  $(function(){
    var requiredCheckboxes = $('.options :checkbox[required]');
    requiredCheckboxes.change(function(){
        if(requiredCheckboxes.is(':checked')) {
         
            requiredCheckboxes.removeAttr('required');
        } else {
            requiredCheckboxes.attr('required', 'required');
        }
    });
});

$(document).ready(function() {
    var elements = document.getElementsByTagName("INPUT");
    for (var i = 0; i < elements.length; i++) {
        elements[i].oninvalid = function(e) {
            e.target.setCustomValidity("");
            if (!e.target.validity.valid) {
                e.target.setCustomValidity("Escolha no mínimo um curso =)");
            }
        };
        elements[i].oninput = function(e) {
            e.target.setCustomValidity("");
        };
    }
})


</script>
