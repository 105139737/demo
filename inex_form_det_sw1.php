<?
$reqlevel=1;
include("membersonly.inc.php");

$gcd=$_REQUEST['cc'];
$dt=$_REQUEST['dt'];
$dt1=$_REQUEST['dt1'];
$pno=$_REQUEST['pno'];


if($pno!="0")
{
$qry=" pno='$pno' and dt between '$dt' and '$dt1' order by dt ";
}
else
{

$qry=" sl>0 and dt between '$dt' and '$dt1' order by dt";
}


if($dt!="")
{
if($pno==0)
{
?>
<table border="1" cellspacing="0" width="100%" background="images/inactive-header.png" >
          <tr>
            <td align="right" colspan="5"><a href="#" onclick="show3('<? echo $gcd;?>','','','')"><font size="3" color="red">Close ( x )</font></a></td>
			</tr>
		  <tr>
            <td  align="center" ><font size="2" >Date</font></td>
			<td  align="center"><font size="2" >Project</font></td>
			<td  align="center"><font size="2" >Narration</font></td>
			<td  align="center" ><font size="2" >By.</font></td>
			<td  align="center" ><font size="2" >Amount(Rs)</font></td>
		 </tr>


<?
$query33 = "SELECT * FROM main_drcr where dldgr='$gcd' and".$qry."";
$result33 = mysqli_query($conn,$query33);
while ($R = mysqli_fetch_array ($result33))
{
		$gdt=$R['dt'];
		$gpno=$R['pno'];
		$gnrtn=$R['nrtn'];
		$ldgr=$R['cldgr'];
		$gamm=$R['amm'];
		
	if($gamm!=0)
		{
		$query41 = "SELECT * FROM main_ledg where sl='$ldgr'";
		$result41 = mysqli_query($conn,$query41);
		while ($R1 = mysqli_fetch_array ($result41))
		{
		$ldgr=$R1['nm'];
		}
		
		$query41 = "SELECT * FROM main_project where sl='$gpno'";
		$result41 = mysqli_query($conn,$query41);
		while ($R1 = mysqli_fetch_array ($result41))
		{
		$gpno=$R1['nm'];
		}
?>
		<tr>		
			<td  align="center" ><font size="2" color="black"><?echo $gdt;?></font></td>
			<td  align="center" ><font size="2" color="black"><?echo $gpno;?></font></td>
            <td  align="center" ><font size="2" color="black"><?echo $gnrtn;?></font></td>
			<td  align="center" ><font size="2" color="black"><?echo $ldgr;?></font></td>
			<td  align="center" ><font size="3" color="black"><?echo $gamm;?></font></td>
		 </tr>


<?
	}}


}
else
{

?>
<table border="1" cellspacing="0" width="100%" id="AutoNumber2" background="images/inactive-header.png">
          <tr>
            <td align="right" colspan="5"><font size="3" color="red"><a href="#" onclick="show3('<? echo $gcd;?>','','','')">Close ( x )</font></a></td>
			</tr>
		  <tr>
            <td align="center" ><font size="2" >Date</font></td>
			<td  align="center" ><font size="2" >Narration</font></td>
			<td  align="center" ><font size="2" >By.</font></td>
			<td align="center" ><font size="2" >Amount(Rs)</font></td>
		 </tr>


<?
$query33 = "SELECT * FROM main_drcr where dldgr='$gcd' and".$qry."";
$result33 = mysqli_query($conn,$query33);


		while ($R = mysqli_fetch_array ($result33))
{
		$gdt=$R['dt'];
		$gpno=$R['pno'];
		$gnrtn=$R['nrtn'];
		$gdldgr=$R['dldgr'];
		$gamm=$R['amm'];
		
	if($gamm!=0)
		{
		$query41 = "SELECT * FROM main_ledg where sl='$gdldgr'";
		$result41 = mysqli_query($conn,$query41);
		while ($R1 = mysqli_fetch_array ($result41))
		{
		$gdldgr=$R1['nm'];
		}
		
		$query41 = "SELECT * FROM main_project where sl='$gpno'";
		$result41 = mysqli_query($conn,$query41);
		while ($R1 = mysqli_fetch_array ($result41))
		{
		$gpno=$R1['nm'];
		}
?>
<tr>
            <td  align="center" ><font size="2" color="black"><?echo $gdt;?></font></td>
			<td  align="center" ><font size="2" color="black"><?echo $gnrtn;?></font></td>
			<td  align="center" ><font size="2" color="black"><?echo $gdldgr;?></font></td>
			<td  align="center" ><font size="3" color="black"><?echo $gamm;?></font></td>
		 </tr>


<?
				
		}
}}}?>
