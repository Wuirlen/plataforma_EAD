<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>EAD TUTIPLAST ADMNISTRATIVO</title>
    <link rel="shortcut icon" href="" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href="<?php echo URL_BASE?>assets/css/DataTables_boot.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo URL_BASE?>assets/css/grade.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo URL_BASE?>assets/css/auxiliar.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo URL_BASE?>assets/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo URL_BASE?>assets/css/style-m.css"/>
    <link rel="stylesheet" href="<?php echo URL_BASE?>assets/js/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="<?php echo URL_BASE?>assets/js/css/responsive.dataTables.min.css"/>
    <script src="<?php echo URL_BASE ?>assets/js/jquery.min.js"></script>
    <script src="<?php echo URL_BASE ?>assets/js/jquery-3.3.1.min.js"></script>
    
    <!--font icones-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <script>
            var url_img = "<?php echo URL_IMAGEM ?>";
            var base_url = "<?php echo URL_BASE ?>";
        </script>
</head>

<body>
    <div class="site">
        <?php include 'cabecalho.php' ?>

        <div class="conteudo">
            <?php include 'menu.php' ?>
            <div class="base-direita">
                <?php $this->load($view, $viewData); ?>
                
            </div>
        </div>
    </div>
</body>
    <!--<script src="<?php echo URL_BASE ?>assets/js/jquery-ui.js"></script> -->
    <script src="<?php echo URL_BASE ?>assets/js/jquery.min.js"></script>
    <script src="<?php echo URL_BASE ?>assets/js/jquery-3.3.1.min.js"></script> -->
	<script src="<?php echo URL_BASE ?>assets/js/datatables/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo URL_BASE ?>assets/js/datatables/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo URL_BASE ?>assets/js/datatables/js/jquery.base64.js"></script>
    <script src="<?php echo URL_BASE ?>assets/js/datatables/js/jquery.btechco.excelexport.js"></script>
	<script src="<?php echo URL_BASE ?>assets/js/jquery.form.js"></script>
	<script src="<?php echo URL_BASE ?>assets/js/jquery.mask.js"></script>
    <script src="<?php echo URL_BASE ?>assets/js/js.js"></script>
    <script src=" https://cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js "> </script>
     
</html>