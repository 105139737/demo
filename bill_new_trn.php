<?
$reqlevel = 1;
include("membersonly.inc.php");
include("Numbers/Words.php");
$blno=rawurldecode($_REQUEST[blno]);

?>
<html>
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
div {
	position: absolute;
    top: 520px;
    right: 20px;
	 
 opacity: 0.2;
z-index:20;
    /* Rotate div */
 -webkit-transform: rotate(-40deg);
    -moz-transform: rotate(-40deg);
    -o-transform: rotate(-40deg);
    -ms-transform: rotate(-40deg);
    transform: rotate(-30deg)
	
	
}

</style>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="advancedtable_bill.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function blprnt(){
    if(confirm('Are You Sure?')){
    
    window.print();
   }
   
}
</script>
</head>
<body onload="blprnt()">
          
	  <center>						
							
<form method="post" action="centrys.php" name="form1"  id="form1">
<?    
$csl=1;
$sln=0;
 $query111 = "SELECT * FROM main_trns where blno='$blno'";
   $result111 = mysqli_query($conn,$query111);
while ($R111 = mysqli_fetch_array ($result111))
{
$fbcd=$R111['fbcd'];
$tbcd=$R111['tbcd'];
$dt=$R111['dt'];
$eby=$R111['eby'];
$dt=date("d-m-Y", strtotime($dt));	
}
$datasss= mysqli_query($conn,"select * from main_signup where  username='$eby'")or die(mysqli_error($conn)); 
while ($row = mysqli_fetch_array($datasss))
{
$brncd=$row['brncd'];
}
 
$data= mysqli_query($conn,"select * from main_godown where  sl='$fbcd'")or die(mysqli_error($conn)); 
while ($row = mysqli_fetch_array($data))
{
$bnm=$row['gnm'];
$addr=$row['addr'];
$bcnt=$row['bcnt'];
}

$data= mysqli_query($conn,"select * from main_godown where  sl='$tbcd'")or die(mysqli_error($conn)); 
while ($row = mysqli_fetch_array($data))
{
$tbnm=$row['gnm'];
$taddr=$row['addr'];
$tbcnt=$row['bcnt'];
}

?>

	

<div class="bg" >
	<font size="6"><b><?=$comp_nm;?></b></font>
	</div>
	
<table border="0" width="677px">
<tr>
<td  align="center">
<font size="5"><b><?=$comp_nm;?></b></font>
<br>
<font size="4"><b><?=$comp_addr;?></b></font>
<br>
<font size="4"><b>Mob. <?=$cont;?></b></font>
</td>
</tr>
<tr>
<td  align="center" style="font-family: Arial, Helvetica, sans-serif;">
<font size="4" color="#114f2a"> <b>Transfer</b></font>
</td>
</tr>
</table>

<table border="1"  class="advancedtable"  cellpadding="0" cellspacing="0" width="800px">
<tr>
<td valign="top" width="50%" height="130px"  rowspan="2" style="padding-left:5px;cellpadding:5px;font-family: Arial, Helvetica, sans-serif;">
<b>To :- </b><br>
Godown Name & Address :-<br><br>
<b><font size="2"><?=$tbnm;?></font><br>
<font size="2"><?=$taddr;?>
</b>

</font>


</td>
<td width="50%" valign="top" style="padding-left:5px;height:30px;font-family: Arial, Helvetica, sans-serif;" >
<b>Trn. No. :<font size="2"> <?=$blno;?></b> <span style="padding-left:5px;font-family: Arial, Helvetica, sans-serif;"><b>Date : <?=$dt;?></b></span></font>
<tr>
<td valign="middle" style="padding-left:5px; font-family: Arial, Helvetica, sans-serif;">

</font>
</b>
</td>
</tr>
</td>
</tr>

</table>
<table  class="advancedtable" width="800px">
<tr style="height:560px">
<td valign="top">

<table  width="100%"  id="a"  >

<tr >	

<td align="left" id="t" >
<b>Sl</b>
</td>
<td align="left" >
<b>Product</b>
</td>
<td align="left" >
<b>Sl No.</b>
</td>
<td align="right">
<b>QTY </b>
</td>

</tr>	
<?
$sln=0;
 $query100 = "SELECT * FROM main_trndtl where blno='$blno' and qty>0 order by sl";
   $result100 = mysqli_query($conn,$query100);
while ($R100 = mysqli_fetch_array ($result100))
{
    $brmk="";
$csl=$R100['bsl'];   
$prsl=$R100['prsl'];    
$prnm=$R100['prnm'];
$qnty=$R100['qty'];
$brmk=$R100['rmk'];
$betno=$R100['betno'];


$sln++;
$query6="select * from  ".$DBprefix."product where sl='$prsl'";
$result5 = mysqli_query($conn,$query6);
while($row=mysqli_fetch_array($result5))
{
$pnm=$row['pnm'];
$cat=$row['cat'];
$bnm=$row['bnm'];
$mnm=$row['mnm'];
$pcd=$row['pcd'];
}

?>
<tr   style="line-height: 14px;" >	

<td align="left" style="font-family: Arial, Helvetica, sans-serif;" >
<font size="2"><?=$sln;?>.</font>
</td>
<td align="left" style="font-family: Arial, Helvetica, sans-serif;" >
<font size="2"><?=$pnm;?> - <?php echo $pcd;?> </font>
</td>
<td align="left" style="font-family: Arial, Helvetica, sans-serif;" >
<font size="2"><?=$betno;?> </font>
</td>
<td align="right" style="font-family: Arial, Helvetica, sans-serif;">
<font size="2"><?=$qnty;?></font>
</td>

</tr>
<?
}
?>
</table>
</td>
</tr>

</table>
<table border="1"  class="advancedtable"  cellpadding="0" cellspacing="0" width="800px">
<tr>
<td valign="top" width="50%" align="center" height="60px" valign="top" style="padding-left:5px;cellpadding:5px;font-family: Arial, Helvetica, sans-serif;">
<br>
<img src="stmp/<?php echo $brncd;?>.png" width="72" height="70">
<br>
----------------------------<br>
<b>Receiver From </b><br>

</td>
<td width="50%" valign="top" align="center" style="padding-left:5px;height:30px;font-family: Arial, Helvetica, sans-serif;" >
<br>
<br><br><br><br>
----------------------------<br>
<b>Receiver By</b>


</td>
</tr>

</table>



 </form>      
    </center> 
    </body>
</html>