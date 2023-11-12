<?php

/**
 * @author Nirmal Biswas
 * @copyright 2015
 */

include "config.php";


    $cc=0;
    $g1=mysqli_query($conn,"select cbill,sl from main_drcr where nrtn='Sale' GROUP BY vno,cbill HAVING ( COUNT(vno) > 1 and  COUNT(cbill) > 1) ");
    while($x=mysqli_fetch_array($g1))
    {
        $cbill=$x['cbill'];
		$sl=$x['sl'];
       
            echo $sl."----".$cbill."<br>";
        $cc++;
    }
	echo $cc."<br>";

        $cc=0;
    $g1=mysqli_query($conn,"select cbill,sl from main_drcr where nrtn='Sale' GROUP BY vno,cbill HAVING ( COUNT(vno) = 1 and  COUNT(cbill) = 1) ");
    while($x=mysqli_fetch_array($g1))
    {
        $cbill=$x['cbill'];
		$sl=$x['sl'];
       
            echo $sl."----".$cbill."<br>";
        $cc++;
    }
	echo $cc;


?>