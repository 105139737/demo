<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set("memory_limit", "-1");
set_time_limit(0);
include("../config.php");
include("../function.php");
include("../Numbers/Words.php");
date_default_timezone_set('Asia/Kolkata');
$tiamm=0;
$teamm=0;
$brncd=$_REQUEST['brncd'];if($brncd==""){$brncd1="";}else{$brncd1=" and brncd='$brncd'";}
$tdt=$_REQUEST['tdt'];
$fdt=$_REQUEST['fdt'];
$proj=$_REQUEST['proj'];
$amm=$_REQUEST['amm']; 
ob_start();
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
<script type="text/javascript">
function prnt()
{
    document.getElementById('prnt').style.display='none';
    window.print();
}
</script>
</head>
<body>
<div id="container">

<div id="prnt" style="position:absolute;left:10px;top:2px;width:315px;height:88px;z-index:2;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:16px;"><a onclick="prnt()">Print</a></span>
</div>

<div id="con" style="position:absolute;text-align:left;left:0px;top:20px;width:800px;z-index:9;" title="">
<table border="1" style="position:absolute;left:0px;top:0px;width:800px;z-index:0;" cellpadding="0" cellspacing="1" id="Table1">
<tr>
<td colspan="6" align="center">
<span style="color:#000000;font-family:Arial;font-size:20px;"><strong><u>Supplier Summary</u></strong></span>
</td>
</tr>

<tr>
<td width="7%" align="center"><span style="color:#000000;font-family:Arial;font-size:15px;"><strong>Sl.</strong></span></td>
<td width="5%" align="center"><span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Branch</strong></span></td>
<td width="33%" align="center"><span style="color:#000000;font-family:Arial;font-size:15px;"><strong>Supplier</strong></span></td>

<td width="10%" align="center"><span style="color:#000000;font-family:Arial;font-size:15px;"><strong>Due</strong></span></td>
<td width="10%" align="center"><span style="color:#000000;font-family:Arial;font-size:15px;"><strong>Advance</strong></span></td>
</tr>
<?

$i=0;
$DTOT=0;
$ATOT=0;
$proj=0;
if($proj!=0)
{
$qry=" and pno='$proj'";
$get = mysqli_query($conn,"SELECT * FROM main_project where sl='$proj'") or die(mysqli_error($conn));
while($row = mysqli_fetch_array($get))
{
$pno=$row['nm'];
}	
}
else
{
$qry=" and sl>0";
$pno='NA';
}	
$query = "SELECT * FROM main_suppl order by spn";
$result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$a=$R['sl'];
$snm=$R['spn'];
$nm=$R['nm'];
$adr=$R['addr'];
$mob1=$R['mob1'];
$mob2=$R['mob2'];
$eml=$R['email'];

$query11="select SUM(IF(dldgr='12', amm, 0))- SUM(IF(cldgr='12', amm, 0)) as pcrdt,cid,brncd,sid from ".$DBprefix."drcr where (cldgr='12' or dldgr='12') ".$qry." and sid='$a' and (dt between '2000-01-01' and '$tdt')".$brncd1;
$result11 = mysqli_query($conn,$query11);
while ($R11 = mysqli_fetch_array ($result11))
{

$a=$R11['sid']; 
if($a=='')
{
$a=$R11['cid']; 
}
$pcrdt=$R11['pcrdt'];
$brncd=$R11['brncd'];
$show=0;

if($pcrdt>0)
{
$due=$pcrdt;
$adv=0;	
}
else
{
$due=0;
$adv=$pcrdt*-1;		
}

if($due>= $amm or $adv>= $amm)
{
	
$show=1;
$DTOT+=$due;
$ATOT+=$adv;



}
}

if($show==1)
{
if($a!="")
{
$i++;
?>
<tr>
<td align="center"><span style="color:#000000;font-family:Arial;font-size:15px;"><?=$i;?></span></td>
<td align="center"><span style="color:#000000;font-family:Arial;font-size:15px;"><? echo get_branch_name_($brncd);?></span></td>
<td align="left"><span style="color:#000000;font-family:Arial;font-size:15px;">
<a href="supp_statments.php?cid=<?=$a;?>&fdt=<?=$fdt;?>&tdt=<?=$tdt;?>&proj=0&brncd=<?=$brncd;?>" target="_blank"><? echo $snm;?> - (<?=$mob1;?>)</a>
</span></td>
<td align="right"><span style="color:#000000;font-family:Arial;font-size:15px;"><? echo number_format($adv,2);?></span></td>
<td align="right"><span style="color:#000000;font-family:Arial;font-size:15px;"><? echo number_format($due,2);?></span></td>

</tr>

<?
}
}
}

?>
<tr>
<td ><span style="color:#000000;font-family:Arial;font-size:15px;"></span></td>
<td ><span style="color:#000000;font-family:Arial;font-size:15px;"></span></td>
<td ><span style="color:#000000;font-family:Arial;font-size:15px;"></span></td>
<td align="right"><span style="color:#000000;font-family:Arial;font-size:17px;"><? echo number_format($ATOT,2);?></span></td>
<td align="right"><span style="color:#000000;font-family:Arial;font-size:17px;"><? echo number_format($DTOT,2);?></span></td>

</tr>
</table>

</div>
</div>
</body>
</html>
<?php
$imgbinary = ob_get_clean();
$filename="jobs_report/".$_GET['file_name'].".xls";
file_put_contents($filename, $imgbinary);




