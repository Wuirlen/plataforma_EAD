<?php 
$filename = './ead_report.xlsx';
if(file_exists($filename)){
    unlink("./ead_report.xlsx");
}

$valor = (isset($_POST['valor'])) ? $_POST['valor'] : '';
set_time_limit(500);
exec('start python/ead_bug.exe');
$filename = './ead_report.xlsx';
if(file_exists($filename)){
  
    $saiu["valor"] = 1;
}else{
    $saiu["valor"] = 0;
}
print json_encode($saiu, JSON_UNESCAPED_UNICODE);

