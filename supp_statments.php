<?php
$reqlevel = 3;
include("membersonly.inc.php");
$tiamm=0;
$teamm=0;
$a=$_REQUEST[cid];
$tdt=$_REQUEST[tdt];
$fdt=$_REQUEST[fdt];
if($fdt=="")
{
    if(date('m')>3){
        $fdt=date('Y')."-04-01";
    }
    else
    {
        $fdt=(date('Y')-1)."-04-01";
    }
    
}
if($tdt=="")
{
    $tdt=date('Y-m-d');
}
$i=0;

$gbt=mysqli_query($conn,"select * from main_suppl where sl='$a'");
while($GB=mysqli_fetch_array($gbt))
{
$bto=$GB['spn'];
$baddr=$GB['addr'];
$bmob=$GB['mob1'];

$i=1;
}


$cstp="Whole Saler";
if($fdt==""){
    $fdt='2013-08-01';
}

if($tdt==""){
    $tdt=date('Y-m-d');
    
}
$query11="select sum(amm) as pcrdt from ".$DBprefix."drcr where cldgr='12' and sid='$a' and dt < '$fdt' ";
$result11 = mysqli_query($conn,$query11);
while ($R11 = mysqli_fetch_array ($result11))
{
  
$pcrdt=$R11['pcrdt'];
}
$query11="select sum(amm) as pdbdt from ".$DBprefix."drcr where dldgr='12' and sid='$a' and dt < '$fdt' ";
$result11 = mysqli_query($conn,$query11);
while ($R11 = mysqli_fetch_array ($result11))
{
  
$pdbdt=$R11['pdbdt'];
}
$opbl=$opbl-$pcrdt+$pdbdt;
$pageno=1;
if($i==1)
{
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Statement</title>
<meta name="generator" content="WYSIWYG Web Builder 8 - http://www.wysiwygwebbuilder.com">
<style type="text/css">
div#container
{
   width: 698px;
   position: relative;
   margin-top: 0px;
   margin-left: auto;
   margin-right: auto;
   text-align: left;
}
body
{
   text-align: center;
   margin: 0;
   background-color: #FFFFFF;
   
   color: #000000;
}
  input.sc {
	width: 100%;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 12px;
	color: #666666;
	border: 2px solid #d8d8d8;
	
	padding-right: 0px;
	padding-bottom: 3px;
	padding-left: 3px;
	padding: 3px;
}

input.sc1 {
	width: 100%;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 12px;
	color: #666666;
	border: 1px solid #a7a7ab;
	
	padding-top: 2px;
	padding-right: 0px;
	padding-bottom: 2px;
	padding-left: 4px;
	padding: 4px;
}
</style>
<style type="text/css">
a
{
   color: #000000;
   text-decoration: none;
   cursor: pointer;
}
a:visited
{
   color: #000;
}
a:active
{
   color: #000;
}
a:hover
{
   color: #000;
   text-decoration: underline;
}
@media print
{
    #rem
    {
        display: none !important;
    }
}
</style>
<style type="text/css">

#con
{
   background-color: transparent;
}
</style>
 

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        
   
        <!-- jQuery 2.0.2 -->
       <script type="text/javascript" src="jquery-1.7.2.min.js"></script>

<script type="text/javascript">
function prnt()
{
    document.getElementById('prnt').style.display='none';

    window.print();

}
  

</script>


</head>
<body >
<center>

<div id="prnt" style="position:absolute;left:10px;top:2px;width:320px;height:88px;z-index:2;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:16px;"><a onclick="prnt()">Print</a></span>
</div>


  <table border="0" width="677px">
  <tr>
  <td  align="center" style="font-family: Arial, Helvetica, sans-serif;"><font size="5"> <b><u>Supplier Statement<u></b></font></td>
  </tr>
  </table>
<table   style="border-collapse:collapse;"  cellpadding="0" cellspacing="0" width="800px">
  <tr style="border-bottom: 1px solid #000;" >
  <td valign="top" width="70%"    style="padding-left:5px;cellpadding:5px;font-family: Arial, Helvetica, sans-serif;">
  <font size="5" >
  <b>
<?=$branch_nm;?>
  </b>
  </font>
  <br>
  <font size="2" >
<?=$branch_addr;?>
  <br>
  Mobile : <?=$branch_cnt;?>
  </font>
  </td>
  <td width="50%" valign="top" align="right" style="height:30px;font-family: Arial, Helvetica, sans-serif;" >
 
<font size="2" >
Page No. <?=$pageno;?></br> <br>

</font> </td>
  </tr>
<tr style="border-bottom: 1px solid #000;">
  <td align="center" colspan="2" style="font-family: Arial, Helvetica, sans-serif;" ><b>Statement for the period (From : <? echo date('d-m-Y', strtotime($fdt)); ?>&nbsp; To : <? echo date('d-m-Y', strtotime($tdt)); ?>)</b>
  </td>

  </tr>
  <tr style="border-bottom: 1px solid #000;height:90px" >
  <td align="left" valign="top" colspan="2"><font size="2" >TO :
 <b>  <?=$bto."</b><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$baddr."<br>";

if($bmob!="")
{
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mob : ".$bmob;
}
?>
  
  </font></td>

  </tr>
  </table>
  <table  style="border-collapse:collapse;" width="800px"  cellpadding="0" cellspacing="0">
  <tr  style="height:530px" valign="top" >
  <td>
  <table width="100%" border="0" style="border-collapse:collapse;">
  <tr style="border-bottom: 1px solid #000;">
  <td align="center" ><font size="2" >Date</font></td>
  <td align="left" ><font size="2" >Ref</font></td>
  <td align="left" ><font size="2" >Perticulars</font></td>
  <td align="right"><font size="2" >Debit</font></td>
  <td align="right" ><font size="2" >Credit</font></td>
  <td align="right" ><font size="2" >Balance</font></td>

  </td>
  </tr>
  <?
  if($opbl>0)
  {
	$lvl=" Dr";
	$opbl1=$opbl;
  }
  else if($opbl<0)
  {
	$lvl=" Cr"; 
	$opbl1=$opbl*(-1);
  }

  ?>
    <tr >
  <td align="center" colspan="5" ><font size="2" >Opening Balance</font></td>

  <td align="right" ><font size="2" ><? echo $opbl1.$lvl;?></font></td>

  </td>
  </tr>
  <?
 $nbal=$opbl;
 $tdebt=0;
 $tcredt=0;
 
 $pag=0;
$query1="select *,sum(amm) as amm from ".$DBprefix."drcr where (dldgr='12' or cldgr='12') and sid='$a' and dt between '$fdt' and '$tdt' group by cldgr,edtm,vno order by dt,sl ";
$result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
  $dsl=$R1['sl'];
$bno=$R1['sbill'];
$vno=$R1['vno'];
$pmd=$R1['mtd'];
$amm=Round($R1['amm'],2);
$rd=$R1['dt'];
$cldgr=$R1['cldgr'];
$dldgr=$R1['dldgr'];
$ref=$R1['mtddtl'];
$brncd=$R1['brncd'];
$nrtn=$R1['nrtn'];
$pno=$R1['pno'];
$blnon=$R1['blnon'];
$bb="";
$bb1="";



if($dldgr!='-3' and $cldgr!='12')
{
$bno="";
}
if($bno!="")
{
$gt=mysqli_query($conn,"select * from main_purchase where blno='$bno'");
$ccount=mysqli_num_rows($gt);
if($ccount>0)
{
while($jj=mysqli_fetch_array($gt))
{
$dscrp=$jj['inv'];
}
}
else
{
$gt=mysqli_query($conn,"select * from main_cdnr where refno='$bno'");	
while($jj=mysqli_fetch_array($gt))
{
$dscrp=$jj['note_no'];
}
}
}
else
{
if($blnon!=''){$dscrp=$blnon;}else{$dscrp=$vno;}

}
if($dldgr==12){
    $damm=round($amm,2);
    $camm="";
    $nbal=$nbal+$amm;
    if($nbal<0)
   {
    $nbalf=round($nbal*-1,2);
    $nbalf.=" Cr";
   } 
   else
   {
    $nbalf=round($nbal,2);
    $nbalf.=" Dr";
   }
}
if($cldgr==12){
    $camm=round($amm,2);
    $damm="";
    $nbal=round($nbal-$amm,2);
    if($nbal<0)
   {
    $nbalf=Round($nbal*-1,2);
    $nbalf.=" Cr";
   } 
   else
   {
    $nbalf=round($nbal,2);
    $nbalf.=" Dr";
   }
}

if($colo=='')
{
	$colo="#ededed";
}
else
{
	$colo="";
}
if($nrtn=='S-GST' or $nrtn=='C-GST' or $nrtn=='I-GST')
{
$nrtn='Purscase';
}
if($nrtn!='Sale')
{
	if($user_current_level < 0)
	{
$rd1=$rd;
	}
	else
{
$rd1=$rd;	
}
}
else
{
$rd1=$rd;	
}
$pag++;
if($pag==38)
{
	$pageno++;
	?>
	<tr>
	<td colspan="6" align="">
	
	
	<div style="page-break-after: always;">
	
	
	</div>
	
	<table   style="border-collapse:collapse;"  cellpadding="0" cellspacing="0" width="800px">
  <tr style="border-bottom: 1px solid #000;" >
  <td valign="top" width="70%"    style="padding-left:5px;cellpadding:5px;font-family: Arial, Helvetica, sans-serif;">
  <font size="5" >
  <b>
<?=$branch_nm;?>
  </b>
  </font>
  <br>
  <font size="2" >
<?=$branch_addr;?>
  <br>
  Mobile : <?=$branch_cnt;?>
  </font>
  </td>
  <td width="50%" valign="top" align="right" style="height:30px;font-family: Arial, Helvetica, sans-serif;" >

<font size="2" >
Page No. <?=$pageno;?><br>  <br>

</font> </td>
  </tr>
<tr style="border-bottom: 1px solid #000;">
  <td align="center" colspan="2" style="font-family: Arial, Helvetica, sans-serif;" ><b>Statement for the period (From : <? echo date('d-m-Y', strtotime($fdt)); ?>&nbsp; To : <? echo date('d-m-Y', strtotime($tdt)); ?>)</b>
  </td>

  </tr>
  <tr style="border-bottom: 1px solid #000;height:90px" >
  <td align="left" valign="top" colspan="2"><font size="2" >TO :
  <b>  <?=$bto."</b><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$baddr."<br>";

if($bmob!="")
{
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mob : ".$bmob;
}
?>
  </font></td>

  </tr>
  </table>
 <tr style="border-bottom: 1px solid #000;">
  <td align="center" ><font size="2" >Date</font></td>
  <td align="left" ><font size="2" >Ref</font></td>
  <td align="left" ><font size="2" >Perticulars</font></td>
  <td align="right"><font size="2" >Debit</font></td>
  <td align="right" ><font size="2" >Credit</font></td>
  <td align="right" ><font size="2" >Balance</font></td>

  </td>
  </tr>
 
	<?
	$pag=0;
	?>
</td>
</tr>
<?
	
}
		  ?>
		  <tr bgcolor="<?=$colo;?>">
		  <td align="center" ><font size="2" ><? echo $rd1;?></font></td>
		  <td align="left" ><font size="2" ><?=$dscrp;?></font></td>
		  <td align="left" ><font size="2" ><?=$nrtn;?></font></td>
		  <td align="right"><font size="2" ><?=$camm;?></font></td>
		  <td align="right" ><font size="2" ><?=$damm;?></font></td>
		  <td align="right" title="<?=$dsl;?>" ><font size="2" ><span style="color:<? if($nbal<0){echo "#FF0000";}else{echo "#0034ff";}?>;font-family:Arial;font-size:15px;"><? echo $nbalf;?></span></font></td>
		 
		  </tr>
		  <?
		  $pcs1=$pcs+$pcs1;
		  if($cldgr!=-1 and $dldgr!=-1)
		  {
		  $tdebt=$tdebt+$damm;
		   $tcredt=$tcredt+$camm;
		     }
		  }
		  
		  ?>
		  <tr style="border-top: 1px solid #000;">
		  <td colspan="3" align="right">
		  <b>Total </b>
		  </td>
		  <td align="right">
		 <font size="2" ><b> <?=$tcredt;?></b></font>
		  </td>
		  <td align="right">
		  <font size="2" ><b><?=$tdebt;?></b></font>
		  </td>
		   <td>
		  </td>
		  </tr>
		    <tr style="border-top: 1px solid #000;">
		  <td colspan="3" align="right">
		 
		  </td>
		  <td>
		  </td>
		   <td>
		  </td>
		   <td>
		  </td>
		  </tr>
		  
		  </table>
		  </td>
		  </tr>
		  </table>

</center>
</body>
</html>
<?
}
else
{
echo 'Not Valid Supplier ID ?';
}



