<script src="<?php

              use app\crud\service\Service;

              echo URL_BASE ?>assets/css/style.css"></script>
<style>
  .button {
    color: #aaa;
    cursor: pointer;
    vertical-align: middle;
    margin-top: -4px;
  }

  .data {
    text-align: right;
    padding-right: 20px;
  }

  .box-ruim {
    border-right: 5px solid green;
    
  }
</style>

<div class="caixa-home">

  <h1 class="titulo"><i class="fas fa-list-alt"></i>Alunos Cadastrados para <?php echo $desempenho_curso->nome_curso; ?></h1>
  <div class="base-lista">
    <?php
    $this->verErro();
    $this->verMsg();
    ?>
     <div class="col-12 d-flex text-justify mb-2">
                <a href="<?php echo URL_BASE."desempenhocurso/index"?>" class="btn d-inline-block mx-1">Voltar</a>
            
            </div>
    <div class="col-12">
      <?php
      $this->verMsg();
      ?>
      <table data-page-length='5' cellpadding="0" cellspacing="0" border="0" id="dataTable">
        <thead>
          <tr>
            <th align="left">Nome</th>
            <th align="center">Progressão %</th>
            <th align="center">Status</th>
            <th align="center">Total de Aulas</th>
          </tr>
        </thead>
        <tbody>
          <?php $cont = 0;  
          foreach($lista as $aluno) { ?>
            <tr>
              <td align="left"><?php echo $aluno->nome_aluno ?></td>
                  <?php $progressaoo = count($aulas_assistidas[$cont]);
                  foreach ($count as $contador) {
                    $progressao = number_format(($progressaoo / $contador->qtd) * 100);
                    if ($contador->id_curso == $id) {
                      if ($progressao == 0) {
                        echo" <td align='center'><a class='btn btn-outline-vermelho'>";
                        echo "$progressao%";
                        echo "<td align='center'><a style='background-color: #e20e0ebf!important' class='btn btn-primary-vermelho'>Não Inicializado</a></td>";
                        echo "<td align='center'><a class='btn btn-outline-vermelho'>0/$contador->qtd</a></td>";
                      
                      } else {
                        echo" <td align='center'><a class='btn btn-outline-azul'>";
                        echo "$progressao%";
                        if($progressao == 100)
                        echo "<td align='center'><a class='btn btn-primary-verde'>Concluído</a></td>";
                        else echo "<td align='center'><a style='background-color: #0000008a!important' class='btn btn-primary'>Em andamento</a></td>";
                        if($aulas_assistidas[$cont][0]->id_aluno == $aluno->id_aluno){
                          $valor = count($aulas_assistidas[$cont]);
                          echo "<td align='center'><a class='btn btn-outline-azul'>$valor/$contador->qtd</a></td>";
                        }
                       
                      }
                  ?>
                </a></td>
              
            </tr>
          <?php  } ?>
        <?php  } ?>

      <?php $cont++;
          } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>