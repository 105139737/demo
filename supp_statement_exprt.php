<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$tiamm=0;
$teamm=0;
$brncd=$_REQUEST['brncd'];if($brncd==""){$brncd1="";}else{$brncd1=" and brncd='$brncd'";}
$tdt=$_REQUEST['tdt'];
$fdt=$_REQUEST['fdt'];
$proj=$_REQUEST['proj'];
$amm=$_REQUEST['amm']; 

$file="Supplier Summary".".xls";
header("Content-type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=$file"); 

?>
<table border="1" cellpadding="0" cellspacing="1">
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
$dbl=$R['dbl'];
$opbl=$R['opbl'];
$trnm=$R['trnm'];
$tradd=$R['tradd'];
$trcon=$R['trcon'];
$rem=$R['rem'];
$sid=$R['sid'];

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
<td align="center"><span style="color:#000000;font-family:Arial;font-size:15px;"><? echo get_branch_name($brncd);?></span></td>
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





