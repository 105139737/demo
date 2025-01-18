<?php 
$reqlevel = 1;
include("membersonly.inc.php");
include("Numbers/Words.php");
$blno=rawurldecode($_REQUEST['blno'] ?? "");

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
<?php     
$csl=1;
$sln=0;
 $query111 = "SELECT * FROM main_chnl where blno='$blno'";
   $result111 = mysqli_query($conn,$query111);
while ($R111 = mysqli_fetch_array ($result111))
{
$edt=$R111['edt'];

$vat=$R111['vat'];
$car=$R111['car'];
$dis=$R111['dis'];
$fid=$R111['fid'];
$cid=$R111['cid'];

$edt=date("d-m-Y", strtotime($edt));	
}

 
 $data= mysqli_query($conn,"select * from main_dirver where  sl='$cid'")or die(mysqli_error($conn));
 
while ($row = mysqli_fetch_array($data))
{
$x=$row['sl'];
$cno=$row['cno'];
$cdet=$row['cdet'];
$cnm=$row['dnm'];
$caddr=$row['addr'];
$cnt=$row['mob1'];
$mob2=$row['mob2'];
$lno=$row['lno'];
$ltyp=$row['ltyp'];
}

if($h!="Cash"){
    $ctpr=$ctpr."<p align=\"left\">".$h."<br>";
    $ctpr.=$cbnm."</p>";
}
$ctpr.="<br>".$slprs;

 $query1 = "SELECT sum(ttl) as gttl, sum(qty) as qttl FROM main_chnldtl where blno='$blno' and qty>0";
   $result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$gttl=$R1['gttl'];
$qttl=$R1['qttl'];
}
if($vat!=0)
{
	$vat1=($gttl*$vat)/100;
	$gttl1=($gttl+$vat1+$car)-$dis;
}
else
{
	$gttl1=($gttl+$car)-$dis;
}

$nw = new Numbers_Words();
$aiw=$nw->toWords($gttl1);

?>

	

<div class="bg" >
	<font size="7"><b><?php  echo $comp_nm;?></b></font>
	</div>
	
<table border="0" width="677px">
<tr>
<td  align="center">
<font size="7"><b><?php  echo $comp_nm;?></b></font>
<br>
<font size="4"><b><?php  echo $comp_addr;?></b></font>
</td>
</tr>
<tr>
<td  align="center" style="font-family: Arial, Helvetica, sans-serif;">
<font size="4" color="#114f2a"> <b>TAX INVOICE</b></font>
</td>
</tr>
</table>

<table border="1"  class="advancedtable"  cellpadding="0" cellspacing="0" width="800px">
<tr>
<td valign="top" width="50%" height="130px"  rowspan="2" style="padding-left:5px;cellpadding:5px;font-family: Arial, Helvetica, sans-serif;">
Name & Address :-<br><br>
<b><font size="3"><?php  echo $cnm;?></font><br><br>
<font size="2"><?php  echo $caddr;?><br><br>
Contact No. <?php  echo $cnt;?><br><br>
<?php if($fid!=""){?>
Fertilizer ID : <?php  echo $fid;}?>

</b>

</font>


</td>
<td width="50%" valign="top" style="padding-left:5px;height:30px;font-family: Arial, Helvetica, sans-serif;" >
<b>Invoice No : <?php  echo $blno;?></b> <span style="padding-left:5px;font-family: Arial, Helvetica, sans-serif;"><b>Date : <?php  echo $edt;?></b></span>
<tr>
<td valign="middle" style="padding-left:5px; font-family: Arial, Helvetica, sans-serif;">
<b>
Vat No. <?php  echo $comp_plicno;?>


</b>
</td>
</tr>
</td>
</tr>

</table>
<table  class="advancedtable" width="800px">
<tr style="height:460px">
<td valign="top">

<table  width="100%"  id="a"  >

<tr >	

<td align="center" id="t" >
Sl
</td>
<td align="left" >
Product
</td>
<td align="left">
Tech Name
</td>
<td align="left">
Co. Name
</td>
<td align="left">
Batch No.
</td>
<td align="left">
Expiry <br> Date
</td>
<td align="right">
QTY 
</td>

</tr>	
<?php 
$sln=0;
 $query100 = "SELECT * FROM main_chnldtl where blno='$blno' and qty>0 order by sl";
   $result100 = mysqli_query($conn,$query100);
while ($R100 = mysqli_fetch_array ($result100))
{
    $brmk="";
$csl=$R100['bsl'];   
$prsl=$R100['prsl'];    
$prnm=$R100['prnm'];
$qnty=$R100['qty'];
$ttl=$R100['ttl'];
$bprc=$R100['prc'];
$brmk=$R100['rmk'];
$unt=$R100['unt'];
$betno=$R100['betno'];
$expdt=$R100['expdt'];

$sln++;
if($expdt!="0000-00-00")
{
$expdt=date("d-m-Y", strtotime($expdt));
}
$untpkg='';
$queryu = "SELECT * FROM main_unit where pkgunt='$unt'";
   $resultu = mysqli_query($conn,$queryu);
while ($Ru = mysqli_fetch_array ($resultu))
{
$untpkg=$Ru['untpkg'];
}
if($untpkg=='')
{
$untpkg=$unt;
}

$unit=mysqli_query($conn,"select * from main_unit where pkgunt='$unt'");
while($pr=mysqli_fetch_array($unit))
{
	$su=$pr['tunt'];

$pret1=$qnty/$su;
}
$unit1=mysqli_query($conn,"select * from main_unit where untpkg='$unt'");
while($pr1=mysqli_fetch_array($unit1))
{
	
$ret1=$ret;
$pret1=$qnty;
$log=1;
}
$query1="Select * from ".$DBprefix."unit where untpkg='$unt' or pkgunt='$unt'";
   $result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$ptu=$R1['tunt'];
$pkgunt=$R1['pkgunt'];
}




$query = "SELECT * FROM ".$DBprefix."product where sl='$prsl'";
$result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$csl5=$R['csl'];
$co=$R['co'];
$tech=$R['tech'];

}

$aaa+=1;
	

?>
<tr   style="line-height: 14px;" >	

<td align="left" style="font-family: Arial, Helvetica, sans-serif;" >
<?php  echo $sln;?>
</td>
<td align="left" style="font-family: Arial, Helvetica, sans-serif;" >
<?php  echo $prnm;?>
</td>
<td align="left" style="font-family: Arial, Helvetica, sans-serif;">
<?php  echo $tech;?>
</td>
<td align="left" style="font-family: Arial, Helvetica, sans-serif;">
<?php  echo $co;?>
</td>

<td align="left" style="font-family: Arial, Helvetica, sans-serif;">
<?php  echo $betno;?>
</td>
<td align="left" style="font-family: Arial, Helvetica, sans-serif;">
<?php  echo $expdt;?>
</td>
<td align="right" style="font-family: Arial, Helvetica, sans-serif;">
<?php  echo $qnty;?>
</td>

</tr>
<?php 
}
?>
</table>
</td>
</tr>

</table>




 </form>      
    </center> 
    </body>
</html>