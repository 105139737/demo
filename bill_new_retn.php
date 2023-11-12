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
 $query111 = "SELECT * FROM ".$DBprefix."billing where blno='$blno'";
   $result111 = mysqli_query($conn,$query111);
while ($R111 = mysqli_fetch_array ($result111))
{
$edt=$R111['ddt'];
$cnm=$R111['cnm'];
$caddr=$R111['caddr'];
$cnt=$R111['cnt'];
$vat=$R111['vat'];
$car1=$R111['car'];
$dis=$R111['dis'];
$fid=$R111['fid'];
$gttlc=$R111['amm'];



if($vat=="")
{
	$vat=0;
}
if($dis=="")
{
	$dis=0;
}
$edt=date("d-m-Y", strtotime($edt));	
}

 $query100 = "SELECT * FROM ".$DBprefix."billdtls where blno='$blno' and qty<0 order by sl";
   $result100 = mysqli_query($conn,$query100);
while ($R100 = mysqli_fetch_array ($result100))
{
    $brmk="";
$csl=$R100['bsl'];   
$prsl=$R100['prsl'];    
$prnm=$R100['prnm'];
$qnty=$R100['qty']*(-1);
$ttl=$R100['ttl']*(-1);
$bprc=$R100['prc'];
$brmk=$R100['rmk'];
$unt=$R100['unt'];
$betno=$R100['betno'];
$expdt=$R100['expdt'];


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

}
$data1= mysqli_query($conn,"select * from main_catg where sl='$csl5'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{
$tech=$row1['tnm'];
}
$ctsl=$ctsl.$csl."<br>";
$ctpr=$ctpr."<b>".number_format($bprc,2)."</b><font size='1'>/".$pkgunt."</font><br><br>";
$cttl=$cttl."<b>".number_format($ttl,2)."</b><br><br>";
$cqnt=$cqnt."<b>".$pret1."</b>/<font size='1'>".$unt."</font><br><br>";
$csl=$csl+1;
$prnm1=$prnm1.$prnm."<br><br>";
$betno1=$betno1.$betno."<br><br>";
$expdt1=$expdt1.$expdt."<br><br>";
$co1=$co1.$co."<br><br>";
$sln++;
$sln1=$sln1.$sln."<br><br>";
$atech=explode("+", $tech);
$count=count($atech);
if($count>0)
{
$aaa=0;
while($aaa<$count)
{
	$tech1.=$atech[$aaa]."<br><br>";
if($aaa>0){
		$ctsl=$ctsl.$csl."<br>";
$ctpr.="<br><br>";
$cttl.="<br><br>";
$cqnt.="<br><br>";
$prnm1.="<br><br>";
$betno1.="<br><br>";
$expdt1.="<br><br>";
$co1.="<br><br>";
$sln1.="<br><br>";
}
	
	$aaa+=1;
}	
}
else
{
$tech1=$tech1.$tech."<br><br>";	
}



}





 $query1 = "SELECT sum(ttl) as gttl, sum(qty) as qttl FROM ".$DBprefix."billdtls where blno='$blno' and qty<0";
   $result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$gttl=$R1['gttl']*(-1);
$qttl=$R1['qttl'];
}
if($car1!="" or $car1!=0)
{
	$car=($car1*$gttl)/$gttlc;
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

	


	
<table border="0" width="677px">
<tr>
<td  align="center">
<img src="drdc1.png" height="140" width="800" >
</td>
</tr>
<tr>
<td  align="center" style="font-family: Arial, Helvetica, sans-serif;">
<font size="4"> <b>RETURN INVOICE</b></font>
</td>
</tr>
</table>

<table border="1"  class="advancedtable"  cellpadding="0" cellspacing="0" width="800px">
<tr>
<td valign="top" width="50%" height="130px"  rowspan="2" style="padding-left:5px;cellpadding:5px;font-family: Arial, Helvetica, sans-serif;">
Name & Address :-<br><br>
<b><font size="3"><?=$cnm;?></font><br><br>
<font size="2"><?=$caddr;?><br><br>
Contact No. <?=$cnt;?><br><br>
<?if($fid!=""){?>
Fertilizer ID : <?=$fid;}?>

</b>

</font>


</td>
<td width="50%" valign="top" style="padding-left:5px;height:30px;font-family: Arial, Helvetica, sans-serif;" >
<b>Invoice No : <?=$blno;?></b> <span style="padding-left:5px;font-family: Arial, Helvetica, sans-serif;"><b>Date : <?=$edt;?></b></span>
<tr>
<td valign="middle" style="padding-left:5px; font-family: Arial, Helvetica, sans-serif;">
<b>
FERTILIZER Lic No.-25100106/11-12/00001/N<br>
PESTICIDES Lic NO. 25/10/2013/1000301/I/NL<br>
SEEDS Lic NO.. KRI-1/N/103<br>
VAT. NO. 19772552072

</b>
</td>
</tr>
</td>
</tr>

</table>


<table  class="advancedtable" border="1"    width="800px">
<tbody>
<tr >	

<td align="center" >
Sl
</td>
<td align="center" >
Product Name 
</td>
<td align="center">
Tech Name
</td>
<td align="center">
Co. Name
</td>
<td align="center">
Batch No.
</td>
<td align="center">
Expiry <br> Date
</td>
<td align="center">
QTY <br> in Units
</td>
<td align="center">
Rate <br> Per Unit
</td>
<td align="center">
Amount <br> Rs.
</td>
</tr>	

<tr height="460px" valign="top"  >	

<td align="left" style="font-family: Arial, Helvetica, sans-serif;" >
<?=$sln1;?>
</td>
<td align="left" style="font-family: Arial, Helvetica, sans-serif;" >
<?=$prnm1;?>
</td>
<td align="left" style="font-family: Arial, Helvetica, sans-serif;">
<?=$tech1;?>
</td>
<td align="left" style="font-family: Arial, Helvetica, sans-serif;">
<?=$co1;?>
</td>

<td align="left" style="font-family: Arial, Helvetica, sans-serif;">
<?=$betno1;?>
</td>
<td align="left" style="font-family: Arial, Helvetica, sans-serif;">
<?=$expdt1;?>
</td>
<td align="right" style="font-family: Arial, Helvetica, sans-serif;">
<?=$cqnt;?>
</td>
<td align="right" style="font-family: Arial, Helvetica, sans-serif;">
<?=$ctpr;?>
</td>
<td align="right" style="font-family: Arial, Helvetica, sans-serif;">
<?=$cttl;?>
</td>
</tr>
<tr>
<td>
</td>
<td align="right" style="font-family: Arial, Helvetica, sans-serif;">
<b>Sub Total </b> 
</td>
<td colspan="5">
</td>
<td>
</td>
<td align="right" style="font-family: Arial, Helvetica, sans-serif;">
<b><?=number_format($gttl,2);?></b>
</td>
</tr>
</tbody>	
</table>	
<br>
<table border="1"  class="advancedtable"  cellpadding="0" cellspacing="0" width="800px">
<tr>
<td valign="top" width="60%" height="140px" style="padding-left:5px;">
Delivery At 
</td>
<td width="40%" valign="top" style="padding-left:5px;height:30px" >
<table width="100%" cellpadding="4" border="0">
<tr>
<td style="font-family: Arial, Helvetica, sans-serif;">
Add Vat. @
</td>
<td align="right" style="font-family: Arial, Helvetica, sans-serif;">
<?=number_format($vat1,2);?>
</td>
</tr>
<tr>
<td>
Add Freight
</td>
<td align="right" style="font-family: Arial, Helvetica, sans-serif;">
<?=number_format($car,2);?>
</td>
</tr>
<tr>
<td>

</td>
<td align="right">

</td>
</tr>
<tr>
<td colspan="2" >
<p style="border:1px solid #000000;"></p>
</td>
</tr>
<tr >
<td >

<b>Grand Total </b>
</td>
<td align="right" style="font-family: Arial, Helvetica, sans-serif;">
<b><?=number_format($gttl1,2);?></b>
</td>
</tr>

</table>
</td>
</tr>
<tr>
<td colspan="2" height="20px" valign="center" style="font-family: Arial, Helvetica, sans-serif;">
Rupees :- <b><font size="3"><?echo $aiw;?> only </font></b>
</td>
</tr>
</table>
<table cellpadding="0" cellspacing="0" width="800px">	
<tr>
<td align="left" style="font-family: Arial, Helvetica, sans-serif;">
<b>E. & O. E</b>
</td>
<td align="right" style="font-family: Arial, Helvetica, sans-serif;">
<br>
For GUHA & CO<br><br><br>
Authorized Signatory
</td>
</tr>
<tr>
<td colspan="2" align="center" style="font-family: Arial, Helvetica, sans-serif;">
<font size="5"><b>*For Agricultural Use Only*</b></font>
</td>
</tr>
</table>
 </form>      
    </center> 
    </body>
</html>