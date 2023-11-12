<?php
include('config.php');
    $prnm = $_REQUEST['prnm'];
    $pri = $_REQUEST['pri'];
    $qnty = $_REQUEST['qnty'];
	
	
$bpri=$pri*$qnty;
$vat=$bpri*14.5/100;
$tot=$bpri+$vat;
    echo $bpri."@".$vat."@".$tot;


    



?>