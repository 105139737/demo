<?php

/**
 * @author Nirmal Biswas
 * @copyright 2013
 */
$reqlevel = 5;
include("membersonly.inc.php");
$tiamm=0;
$teamm=0;
$a=$_REQUEST[cid];
$tdt=$_REQUEST[tdt];
$fdt=$_REQUEST[fdt];
if($fdt=="")
{
    $fdt="2013-09-01";
}
if($tdt=="")
{
    $tdt=date('Y-m-d');
}
$query = "SELECT * FROM ".$DBprefix."suppl where sid='$a'";
   $result = mysqli_query($conn,$query);

while ($R = mysqli_fetch_array ($result))
{
$snm=$R['spn'];
$nm=$R['nm'];
$adr=$R['addr'];
$mob1=$R['mob1'];
$mob2=$R['mob2'];
$eml=$R['email'];
$dbl=$R['dbl'];
$opbl=$R['opbl'];
$rem=$R['rem'];
}
$cstp="Supplier";
if($fdt==""){
    $fdt='2013-08-01';
}

if($tdt==""){
    $tdt=date('Y-m-d');
    
}
$query11="select sum(amm) as pcrdt from ".$DBprefix."drcr where cldgr='$a' and dt < '$fdt'";
$result11 = mysqli_query($conn,$query11);
while ($R11 = mysqli_fetch_array ($result11))
{
  
$pcrdt=$R11['pcrdt'];
}
$query11="select sum(amm) as pdbdt from ".$DBprefix."drcr where dldgr='$a' and dt < '$fdt'";
$result11 = mysqli_query($conn,$query11);
while ($R11 = mysqli_fetch_array ($result11))
{
  
$pdbdt=$R11['pdbdt'];
}
$opbl=$opbl-$pcrdt+$pdbdt;


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
   background-image: url(images/bg.png);
   color: #000000;
}
</style>
<style type="text/css">
a
{
   color: #0000FF;
   text-decoration: underline;
}
a:visited
{
   color: #800080;
}
a:active
{
   color: #FF0000;
}
a:hover
{
   color: #0000FF;
   text-decoration: underline;
}
</style>
<style type="text/css">
#wb_Text1 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
}
#wb_Text1 div
{
   text-align: left;
}
#wb_Text2 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
}
#wb_Text2 div
{
   text-align: left;
}
#wb_Text3 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
}
#wb_Text3 div
{
   text-align: left;
}
#Image1
{
   border: 0px #000000 solid;
}
#Image2
{
   border: 0px #000000 solid;
}
#wb_Text4 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
}
#wb_Text4 div
{
   text-align: right;
}
#wb_Text5 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
}
#wb_Text5 div
{
   text-align: right;
}
#wb_Text6 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
}
#wb_Text6 div
{
   text-align: right;
}
#wb_Text7 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
}
#wb_Text7 div
{
   text-align: center;
}
#con
{
   background-color: transparent;
}
</style>
</head>
<body>
<div id="container">
<div id="wb_Text1" style="position:absolute;left:20px;top:83px;width:320px;height:22px;z-index:0;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:19px;"><strong><u><? echo $snm;?></u></strong></span></div>
<div id="wb_Text2" style="position:absolute;left:20px;top:115px;width:320px;height:18px;z-index:1;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:16px;">Prop : <? echo $nm;?></span></div>
<div id="wb_Text3" style="position:absolute;left:20px;top:145px;width:320px;height:88px;z-index:2;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:16px;">Address: <? echo $adr;?> <br><br><br><br></span></div>
<div id="wb_Image1" style="position:absolute;left:134px;top:3px;width:426px;height:62px;z-index:3;">
<img src="images/logo.gif" id="Image1" alt="" border="0" style="width:426px;height:62px;"></div>
<div id="wb_Image2" style="position:absolute;left:455px;top:83px;width:220px;height:32px;z-index:4;">
<img src="barcode.php?text=<? echo $a;?>" id="Image2" alt="" border="0" style="width:220px;height:32px;"></div>
<div id="wb_Text4" style="position:absolute;left:355px;top:145px;width:320px;height:18px;text-align:right;z-index:5;">
<span style="color:#000000;font-family:Arial;font-size:16px;">Customer Code : <? echo $a;?></span></div>
<div id="wb_Text5" style="position:absolute;left:355px;top:175px;width:320px;height:18px;text-align:right;z-index:6;">
<span style="color:#000000;font-family:Arial;font-size:16px;">Customer Type : <? echo $cstp;?></span></div>
<div id="wb_Text6" style="position:absolute;left:355px;top:205px;width:320px;height:18px;text-align:right;z-index:7;">
<span style="color:#000000;font-family:Arial;font-size:16px;">Currency : INR</span></div>
<div id="wb_Text7" style="position:absolute;left:20px;top:230px;width:655px;height:16px;text-align:center;z-index:8;">
<span style="color:#000000;font-family:Arial;font-size:18px;"><ins>Statement for the period (From : <? echo date('d-m-Y', strtotime($fdt)); ?>&nbsp; To : <? echo date('d-m-Y', strtotime($tdt)); ?>)</ins></span></div>
<div id="con" style="position:absolute;text-align:left;left:20px;top:265px;width:655px;z-index:9;" title="">
<table style="position:absolute;left:0px;top:0px;width:654px;z-index:0;" cellpadding="0" cellspacing="1" id="Table1">
<tr>
<td style="background-color:transparent;border:1px #C0C0C0 solid;text-align:center;vertical-align:top;width:78px;height:18px;">
<div><span style="color:#000000;font-family:Arial;font-size:13px;"> Date</span></div>
</td>
<td style="background-color:transparent;border:1px #C0C0C0 solid;text-align:center;vertical-align:top;width:88px;height:18px;">
<div><span style="color:#000000;font-family:Arial;font-size:13px;"> Ref</span></div>
</td>
<td style="background-color:transparent;border:1px #C0C0C0 solid;text-align:center;vertical-align:top;width:182px;height:18px;">
<div><span style="color:#000000;font-family:Arial;font-size:13px;"> Perticulars</span></div>
</td>
<td style="background-color:transparent;border:1px #C0C0C0 solid;text-align:center;vertical-align:top;width:66px;height:18px;">
<div><span style="color:#000000;font-family:Arial;font-size:13px;"> Debit</span></div>
</td>
<td style="background-color:transparent;border:1px #C0C0C0 solid;text-align:center;vertical-align:top;width:70px;height:18px;">
<div><span style="color:#000000;font-family:Arial;font-size:13px;"> Credit</span></div>
</td>
<td style="background-color:transparent;border:1px #C0C0C0 solid;text-align:center;vertical-align:top;width:74px;height:18px;">
<div><span style="color:#000000;font-family:Arial;font-size:13px;"> Balance</span></div>
</td>
<td style="background-color:transparent;border:1px #C0C0C0 solid;text-align:center;vertical-align:top;height:18px;">
<div><span style="color:#000000;font-family:Arial;font-size:13px;"> Branch</span></div>
</td>
</tr>
<tr>
<td colspan="5" style="background-color:transparent;border:1px #C0C0C0 solid;text-align:center;vertical-align:top;width:70px;height:18px;">
<div><span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Opening Balance</strong></span></div>
</td>
<td style="background-color:transparent;border:1px #C0C0C0 solid;text-align:right;vertical-align:top;width:74px;height:18px;">
<div><span style="color:#000000;font-family:Arial;font-size:13px;"> <? echo $opbl;?></span></div>
</td>
<td style="background-color:transparent;border:1px #C0C0C0 solid;text-align:center;vertical-align:top;height:18px;">
<div><span style="color:#000000;font-family:Arial;font-size:13px;">N/A</span></div>
</td>
</tr>



<?
$nbal=$opbl;
$query1="select * from ".$DBprefix."drcr where refid='$a' and (dldgr='21' or cldgr='21') and dt between '$fdt' and '$tdt' order by dt";
$result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
  
$bno=$R1['bill'];
$vno=$R1['vno'];
$pmd=$R1['pmd'];
$amm=$R1['amm'];
$rd=$R1['dt'];
$cldgr=$R1['cldgr'];
$dldgr=$R1['dldgr'];
$ref=$R1['rfno'];
$brncd=$R1['brncd'];
$nrtn=$R1['nrtn'];
if($dldgr==$a){
    $damm=$amm;
    $camm="";
    $nbal=$nbal+$amm;
    $dscrp=" Purchase Bill-".$bno;
}
if($cldgr==$a){
    $camm=$amm;
    $damm="";
    $nbal=$nbal-$amm;
    if($nrtn==""){
        $dscrp="By ".$pmd." Payment-".$vno;
    }
}


?>
<tr>
<td style="background-color:transparent;border:1px #C0C0C0 solid;text-align:center;vertical-align:top;width:78px;height:19px;">
<div><span style="color:#000000;font-family:Arial;font-size:13px;"><? echo $rd;?></span></div>
</td>
<td style="background-color:transparent;border:1px #C0C0C0 solid;text-align:center;vertical-align:top;width:88px;height:19px;">
<div><span style="color:#000000;font-family:Arial;font-size:13px;"><? echo $ref;?></span></div>
</td>
<td style="background-color:transparent;border:1px #C0C0C0 solid;text-align:left;vertical-align:top;width:182px;height:19px;">
<div><span style="color:#000000;font-family:Arial;font-size:13px;"><? echo $dscrp;?></span></div>
</td>
<td style="background-color:transparent;border:1px #C0C0C0 solid;text-align:right;vertical-align:top;width:66px;height:19px;">
<div><span style="color:#000000;font-family:Arial;font-size:13px;"><? echo $damm;?></span></div>
</td>
<td style="background-color:transparent;border:1px #C0C0C0 solid;text-align:right;vertical-align:top;width:70px;height:19px;">
<div><span style="color:#000000;font-family:Arial;font-size:13px;"><? echo $camm;?></span></div>
</td>
<td style="background-color:transparent;border:1px #C0C0C0 solid;text-align:right;vertical-align:top;width:74px;height:19px;">
<div><span style="color:#000000;font-family:Arial;font-size:13px;"><? echo $nbal;?></span></div>
</td>
<td style="background-color:transparent;border:1px #C0C0C0 solid;text-align:center;vertical-align:top;height:19px;">
<div><span style="color:#000000;font-family:Arial;font-size:13px;"><? echo get_branch_name($brncd); ?></span></div>
</td>
</tr>
<?
}
?>

</table>

</div>
</div>
</body>
</html>