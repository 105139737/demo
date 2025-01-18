<?php 

$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
date_default_timezone_set('Asia/Kolkata');

$fbcd=$_REQUEST['fbcd'];
$tbcd=$_REQUEST['tbcd'];
$blno=$_REQUEST['blno'];
$dt=$_REQUEST['dt'];
$transDistance=$_REQUEST['transDistance'];

$edtm=date('d-m-Y H:i:s a');



$err="";

if($err=="")
{


$query211 = "Update main_trns set tbcd='$tbcd',transDistance='$transDistance' where blno='$blno'";
$result211 = mysqli_query($conn,$query211)or die (mysqli_error($conn)); 


$query1 = "SELECT  sum(qty) as qttl FROM ".$DBprefix."trndtl where blno='$blno'";
$result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$qttl=$R1['qttl'];
}


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
<table border="0" width="677px">
<tr>
<td  align="center" colspan="2">
<img src="drdc.png">
</td>
</tr>
<tr>
<td  align="right" style="padding-right:10px">
<font size="5"> <b><a href="stock_recv.php" ><u>Back</u></a></b></font>
</td>
<td  align="left">
<font size="5"> <b><a href="bill_new_trn.php?blno=<?php echo rawurlencode($blno);?>" target="_blank"><font color="red"><u>Print</u></font></a></b></font>
</td>
</tr>

<tr>
<td  align="center" colspan="2" >
<font size="4" color="red"> <b> Transfer No. : <?php  echo $blno;?></b></font>
</td>

</tr>


</table>


 </form>      
    </center> 
</body>
</div>
</html>
<?php 
}
else
{
    ?>
<Script language="JavaScript">
alert('<?php  echo $err;?>');
document.location="stock_recv.php";
</script>
<?php 
}
?>
