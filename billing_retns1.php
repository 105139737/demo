<?php

/**
 * @author Onnet Solution
 * @copyright 2013
 */

$reqlevel = 1;
include("membersonly.inc.php");
include("Numbers/Words.php");
include "header.php";

$blno=$_REQUEST[blno];
$dt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s a');
date_default_timezone_set('Asia/Kolkata');


?>
<html>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?
            include "left_bar.php";
            ?>
<head>

<style>
.bor{
	
border: 1px solid #000;
  
}
.css{
	border:1px solid #000;
	padding: 0px 0px;

	font-size:14px;
	
	color: #000000;
}
#line{
    border-bottom: 1px black solid;

    height:9px;        
   
}

</style>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="advancedtable.css" rel="stylesheet" type="text/css" />




</head>
<body >
 <center>						
							
<form method="post" action="centrys.php" name="form1"  id="form1">
<table border="0" width="677px">
<tr>
<td  align="center" colspan="2">
<img src="drdc.png">
</td>
</tr>
<tr>
<td  align="right" style="padding-right:10px">
<font size="5"> <b><a href="sale_return.php" ><u>Back</u></a></b></font>
</td>
<td  align="left">
<font size="5"> <b><a href="bill_new_retn11.php?blno=<?=rawurlencode($blno);?>" target="_blank"><font color="red"><u>Print</u></font></a></b></font>
</td>
</tr>

<tr>
<td  align="center" colspan="2" >
<font size="4" color="red"> <b> Bill No. : <?=$blno;?></b></font>
</td>

</tr>

</table>


 </form>      
    </center> 
</body>
</div>
</html>

