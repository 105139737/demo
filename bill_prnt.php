<?php 
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
?>
<html>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?php 
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
<table border="0" width="100%">
<tr>
<td  align="center" colspan="2">
<font size="7"><b><?php  echo $comp_nm;?></b></font>
<br>
<font size="4"><b><?php  echo $comp_addr;?></b></font>
</td>
</tr>
<tr>
<td  align="right" style="padding-right:10px">

</td>
<td  align="center">
    <font size="3"> <b><a href="bill_typ.php?rv=1" ><u>Back</u></a> || </b></font>
<font size="3"> <b><a href="bill_new_gst.php?blno=<?php echo rawurlencode($blno);?>" target="_blank"><font color="red"><u>Without Header Print</u></font></a> || </b></font>
<font size="3"> <b><a href="bill_new_gst.php?blno=<?php echo rawurlencode($blno);?>&typ=1" target="_blank"><font color="red"><u>With Header Print</u></font></a></b></font>
</td>
</tr>

<tr>
<td align="center"  colspan="2" >
<a href="javascript:sms('<?php  echo $blno;?>')"><font size="3" color="blue"> <b><u>Send SMS</u></b></font></a>
</td>
</tr>

<tr>
<td  align="center"  colspan="2">
<font size="3" color="red"> <b> Bill No. : <?php  echo $blno;?></b></font>
</td>
</tr>
</table>

<div id="sms">
</div>
 </form>      
    </center> 
</body>
</div>
</html>