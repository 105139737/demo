<?php
include("membersonly.inc.php");
$sl=$_REQUEST[sl];
$pno=$_REQUEST[pno];
$sid=$_REQUEST[sid1];
$brncd=$_REQUEST[brncd];if($brncd==""){$brncd1="";}else{$brncd1=" and brncd='$brncd'";}
if($sid!="")
{
	$sid1=" and sid='$sid' ";
}
else{
	$sid1="";
}
if($sl==12)
{
$dld=" and dldgr='12'";
$cld=" and  cldgr='12'";
}
else
{
$dld=" and dldgr='$sl'";
$cld=" and cldgr='$sl'";
}

if($pno=='0')
{
$data= mysqli_query($conn,"SELECT sum(amm) as t1 FROM main_drcr where stat='1'".$sid1.$brncd1.$dld);
}
else
{
$data= mysqli_query($conn,"SELECT sum(amm) as t1 FROM main_drcr where  pno='$pno' and stat='1'".$sid1.$brncd1.$dld);
}
		while ($row = mysqli_fetch_array($data))
		{
			$t1 = $row['t1'];
		}
		
if($pno=='0')
{
$data1= mysqli_query($conn,"SELECT sum(amm) as t2 FROM main_drcr where stat='1'".$sid1.$brncd1.$cld);
}
else
{
$data1= mysqli_query($conn,"SELECT sum(amm) as t2 FROM main_drcr where pno='$pno' and stat='1'".$sid1.$brncd1.$cld);
}
	while ($row1 = mysqli_fetch_array($data1))
		{
			$t2 = $row1['t2'];
		}
		$T=$t2-$t1;
		?>
		 <img src="images\rp.png" height="15px"><input type="text" name="dbal" id="dbal" size="35" value="<?echo $T;?>" style="background :transparent; color : red;" readonly>
