<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$sl=$_REQUEST['sl'];
$pno=$_REQUEST['pno'] ?? "";
$cid=$_REQUEST['cid'] ?? "";
$brncd=$_REQUEST['brncd'] ?? "";if($brncd==""){$brncd1="";}else{$brncd1=" and brncd='$brncd'";}
if($cid!="")
{
	$cid1=" and (cid='$cid' or sid='$cid')";
}
else{
	$cid1="";
}
if($sl==4)
{
$dld=" and (dldgr='$sl' or dldgr='$sl')";
$cld=" and (cldgr='$sl' or cldgr='$sl')";
}
else
{
$dld=" and dldgr='$sl'";
$cld=" and cldgr='$sl'";
}	

$T=0;
$t1=0;
$t2=0;
if($pno=='0')
{
$data= mysqli_query($conn,"SELECT sum(amm) as t1 FROM main_drcr where stat='1'".$cid1.$brncd1.$dld);
}
else
{
$data= mysqli_query($conn,"SELECT sum(amm) as t1 FROM main_drcr where  pno='$pno' and stat='1'".$cid1.$brncd1.$dld);
}
while ($row = mysqli_fetch_array($data))
{
$t1 = $row['t1'];
}
		
if($pno=='0')
{
$data1= mysqli_query($conn,"SELECT sum(amm) as t2 FROM main_drcr where  stat='1'".$cid1.$brncd1.$cld);
}
else
{
$data1= mysqli_query($conn,"SELECT sum(amm) as t2 FROM main_drcr where  pno='$pno' and stat='1'".$cid1.$brncd1.$cld);
}
	while ($row1 = mysqli_fetch_array($data1))
		{
			$t2 = $row1['t2'];
		}
		$T=$t1-$t2;
			?>
		 <img src="images\rp.png" height="15px"><input type="text" name="dbal" id="dbal" size="35" value="<?php echo $T;?>" style="background :transparent; color : red;" readonly>
