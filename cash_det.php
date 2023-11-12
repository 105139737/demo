<?
$reqlevel=1;
include("membersonly.inc.php");

$pt=$_REQUEST['pt'];
$ledgr=$_REQUEST['ledgr'];
$pno=base64_decode($_REQUEST['pno']);
$mledgr=$_REQUEST['mledgr'];
$pt1=$_REQUEST['pt1']; 
$fdt=$_REQUEST[fdt]; 
$tdt=$_REQUEST[tdt]; 
$qry1=" and (dt between '$fdt' and '$tdt')";
?>
<table border="1" cellspacing="0" width="100%" class="advancedtable" >
    		  <tr>
            <td  align="center" width="30%" ><font size="2" >Date</font></td>
			
			<td  align="center" width="50%"><font size="2" >Narration</font></td>
		
			<td  align="center" width="20%"><font size="2" >Amount(Rs)</font></td>
		 </tr>


<?
$tot=0;
$query33 = "SELECT * FROM main_drcr where $pt='$mledgr' and $pt1='$ledgr' $pno $qry1";

$result33 = mysqli_query($conn,$query33);
while ($R = mysqli_fetch_array ($result33))
{
		$gdt=$R['dt'];
		$gpno=$R['pno'];
		$gnrtn=$R['nrtn'];
		$ldgr=$R['cldgr'];
		$gamm=$R['amm'];
		$sid=$R['sid'];
		$eid=$R['eid'];
		$cid=$R['cid'];
		$cbill=$R['cbill'];
		
		$cnm="";
		if($ldgr==4)
		{
		$query6="select * from  main_cust where sl='$cid'";
		$result5 = mysqli_query($conn,$query6);
		while($Ree4=mysqli_fetch_array($result5))
		{
		
		$cnm="(".$Ree4['nm'].") Bill No.".$cbill;
		}
		}
			if($ldgr==12)
		{
		$query6="select * from  main_suppl where sl='$sid'";
		$result5 = mysqli_query($conn,$query6);
		while($row=mysqli_fetch_array($result5))
		{
		$cnm="<span style=\"float:left\"> From : <b>(".$row['spn'].")</b></span>";
		}
		}
		
		if($ldgr==89)
		{
			$query6="select * from  main_staf where username='$eid'";
		$result5 = mysqli_query($conn,$query6);
		while($row=mysqli_fetch_array($result5))
		{
		$cnm="(".$row['nm'].")";
		}
		}
	if($gamm!=0)
		{
		$query41 = "SELECT * FROM main_ledg where sl='$ldgr'";
		$result41 = mysqli_query($conn,$query41);
		while ($R1 = mysqli_fetch_array ($result41))
		{
		$ldgr1=$R1['nm'];
		}
		
		$query41 = "SELECT * FROM main_project where sl='$gpno'";
		$result41 = mysqli_query($conn,$query41);
		while ($R1 = mysqli_fetch_array ($result41))
		{
		$gpno=$R1['nm'];
		}
		
		$gdt=date('d-m-Y', strtotime($gdt));
?>
		<tr>		
			<td  align="center" TITLE="<?=$ldgr;?>" ><font size="2" color="black"> <?echo $gdt;?></font></td>
			
            <td  align="left" ><font size="2" color="black"><?echo $gnrtn.$cnm;?></font></td>
		
			<td  align="right" ><font  color="black"><?echo sprintf('%0.2f', $gamm);?></font></td>
		 </tr>


<?
	$tot=$tot+$gamm;
	}}
?>
<tr bgcolor="#c1def7">
<td colspan="2" align="right">
Total : 
</td>
<td align="right">
<font size="3"><b><?echo sprintf('%0.2f', $tot);?></b></font>
</td>
</tr>
</table>

