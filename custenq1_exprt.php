<?
$reqlevel = 3;
include("membersonly.inc.php");
$tiamm=0;
$teamm=0;
$brncd=$_REQUEST[brncd];if($brncd==""){$brncd1="";}else{$brncd1=" and brncd='$brncd'";}
$tdt=$_REQUEST[tdt];
$fdt=$_REQUEST[fdt];
$proj=$_REQUEST[proj];
$amm=$_REQUEST[amm];

$jobLink=CreateNewJob('jobs/custenq1_exprt.php',$user_currently_loged,'Customer Summary',$conn);
?>
<script language="javascript">
alert('Your request has been accepted. You will get you dwonload link in your home page in a few moments. Thank you...');
window.history.go(-1);
</script>
<?php
die('<b><center><font color="green" size="5">Your request has been accepted. You will get you dwonload link in your home page in a few moments. Thank you...</font></center></b>');


$file="Customer Summary".".xls";
header("Content-type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=$file"); 
$cat=$_REQUEST[cat];
$qury="";
if($cat!='')
{
$query="select * from main_cust WHERE sl>0 and brand='$cat' and typ='2' order by nm";
$result=mysqli_query($conn,$query);
while($rw=mysqli_fetch_array($result))
{
$cid=$rw['sl'];
if($qury=="")
{
$qury=" and (sl='$cid'	";
}
else
{
$qury.=" or sl='$cid'";	
}
}
if($qury!=""){$qury.=")";}
}
?>
<body>
<div id="container">
<div id="con" style="position:absolute;text-align:left;left:0px;top:20px;width:800px;z-index:9;" title="">
<table border="1" style="position:absolute;left:0px;top:0px;width:800px;z-index:0;" cellpadding="0" cellspacing="1" id="Table1">
<tr>
<td colspan="6" align="center">
<span style="color:#000000;font-family:Arial;font-size:20px;"><strong><u>Customer Summary</u></strong></span>
</td>
</tr>

<tr>
<td width="7%" align="center"><span style="color:#000000;font-family:Arial;font-size:15px;"><strong>Sl.</strong></span></td>
<td width="5%" align="center"><span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Branch</strong></span></td>
<td width="33%" align="center"><span style="color:#000000;font-family:Arial;font-size:15px;"><strong>Customer</strong></span></td>

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

$query = "SELECT * FROM main_cust  where sl>0 $qury order by nm";
$result = mysqli_query($conn,$query);

while ($R = mysqli_fetch_array ($result))
{
$a=$R['sl'];
$snm=$R['nm'];
$nm=$R['nm'];
$adr=$R['addr'];
$mob1=$R['cont'];
$mob2=$R['mob2'];
$eml=$R['email'];
$dbl=$R['dbl'];
$opbl=$R['opbl'];
$trnm=$R['trnm'];
$tradd=$R['tradd'];
$trcon=$R['trcon'];
$rem=$R['rem'];
$sid=$R['sid'];

$query11="select SUM(IF(dldgr='4', amm, 0))- SUM(IF(cldgr='4', amm, 0)) as pcrdt,cid,brncd,sid from ".$DBprefix."drcr where (cldgr='4' or dldgr='4') ".$qry." and cid='$a' and (dt between '2000-01-01' and '$tdt')".$brncd1;
$result11 = mysqli_query($conn,$query11);
while ($R11 = mysqli_fetch_array ($result11))
{

$a=$R11['cid']; 
if($a=='')
{
$a=$R11['sid']; 
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
$T=0;
$t1=0;
$t2=0;
$data= mysqli_query($conn,"SELECT sum(amm) as t1 FROM main_drcr where stat='1' and cid='$a' and dldgr='7' ".$brncd1);
while ($row = mysqli_fetch_array($data))
{
$t1 = $row['t1'];
}
$data1= mysqli_query($conn,"SELECT sum(amm) as t2 FROM main_drcr where stat='1' and cid='$a' and cldgr='7'".$brncd1);
while ($row1 = mysqli_fetch_array($data1))
{
$t2 = $row1['t2'];
}
$T=$t2-$t1;
$adv+=$T;


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
<td align="center"><span style="color:#000000;font-family:Arial;font-size:15px;"><? echo get_branch_name($brncd);?></span></td>
<td align="left"><span style="color:#000000;font-family:Arial;font-size:15px;">
<? echo $snm;?>
</span></td>

<td align="right"><span style="color:#000000;font-family:Arial;font-size:15px;"><? echo number_format($due,2);?></span></td>
<td align="right"><span style="color:#000000;font-family:Arial;font-size:15px;"><? echo number_format($adv,2);?></span></td>
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

<td align="right"><span style="color:#000000;font-family:Arial;font-size:17px;"><? echo number_format($DTOT,2);?></span></td>
<td align="right"><span style="color:#000000;font-family:Arial;font-size:17px;"><? echo number_format($ATOT,2);?></span></td>
</tr>
</table>

</div>
</div>
</body>
</html>




