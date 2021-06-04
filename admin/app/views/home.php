<div class="caixa-home">

    <span class="titulo"> <i class="fas fa-home"></i> SEJA BEM VINDO A SUA ÁREA ADMINISTRATIVA</span>
    
    <div class="base-inicial">
        <div class="rows">
            <div class="col-4 mb-3">
                <a href="<?php echo URL_BASE."aluno/Index"?>" class="caixa">
                    <i class="ico cat"></i>
                    <h2>Alunos</h2>
                    <small>lista de Alunos</small>
                </a>
            </div>
            <div class="col-4 mb-3">
                <a href="<?php echo URL_BASE."curso/Index"?>" class="caixa">
                    <i class="ico curso"></i>
                    <h2>Cursos</h2>
                    <small>lista de cursos</small>
                </a>
            </div>
            <div class="col-4 mb-3">
                <a href="<?php echo URL_BASE."aula/Index"?>" class="caixa">
                    <i class="ico aula"></i>
                    <h2>Aulas</h2>
                    <small>lista de aulas</small>
                </a>
            </div>
        </div>
        <div class="rows opacidade">
            <div class="col-4 mb-3">
                <div class="caixa">
                    <i class="ico cat"></i>
                    <h2><?php if($totalAluno > 1){ $carcter = "s"; }; 
                    echo isset($totalAluno) ? $totalAluno . " Aluno" . $carcter : "Nenhum Aluno"?> </h2>
                    <small>Adicionada</small>
                </div>
            </div>
            <div class="col-4 mb-3">
                <div class="caixa">
                    <i class="ico curso"></i>
                    <h2><?php if($totalCurso > 1){ $carcter = "s"; };
                    echo isset($totalCurso) ? $totalCurso . " Curso" . $carcter :  "Nenhum Curso"?></h2>
                    <small>Adicionada</small>
                </div>
            </div>
            <div class="col-4 mb-3">
                <div class="caixa">
                    <i class="ico aula"></i>
                    <h2><?php if($totalAula > 1){ $carcter = "s"; }; 
                    echo isset($totalAula) ? $totalAula . " Aula" . $carcter :  "Nenhuma Aula"?></h2>
                    <small>Adicionada</small>
                </div>
            </div>
        </div>
    </div>
</div>