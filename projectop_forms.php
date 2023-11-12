<?php
include("membersonly.inc.php");
//catch the sent data
	$sl=0;
	
	$proj = $_POST['proj'];
	$ldgr = $_POST['ldgr'];
	$obal = $_POST['amm'];
	$nrtn = $_POST['nrtn'];
	$drcr = $_POST['drcr'];
	$cust = $_POST['cust'];
	$sup = $_POST['sup'];
	$brncd = $_POST['brncd'];

	$dldgr="-1";
	
	$sl = $_POST['updt'];
	
	if($sl!=0)
	{
	
if($ldgr=='' or $proj=='' or $obal==0 or $nrtn=='' or $drcr=='')
	{
	?>
<script language="javascript">
alert('Please Fill All The Fields.');
window.history.go(-1);
</script>
<?	}
	else
	{
	
	date_default_timezone_set('Asia/Kolkata');
		$edt = date('d/m/Y h:i:s a', time());
		$yr = date('Y');
		$mnt = date('m');
		if($mnt>=4)
		{
		//$dt = $yr."/04/01";
		$dt = "2018/10/10";
		}
		else
		{
/* 		$yr=$yr-1;
		$dt = $yr."/04/01";
 */	
		$dt = "2018/10/10";

		}
		
		if($drcr==-1)
    {
        $dldgr="-1";
        $cldgr=$ldgr;
    }
    else
    {
        $cldgr="-1";
        $dldgr=$ldgr;
    }

$query31 = "UPDATE main_drcr set nrtn='$nrtn',amm='$obal',cldgr='$cldgr',dldgr='$dldgr',sid='$sup',cid='$cust',pno='$proj',brncd='$brncd' where sl='$sl'";
$result31 = mysqli_query($conn,$query31)or die (mysqli_error($conn));
?>
<script language="javascript">
alert('Updated Successfully. Thank You...');
document.location = "projectop_form.php?brncd=<? echo $brncd;?>";
</script>
<?
	
	}
	}
	else
	{
if($ldgr=='' or $proj=='' or $obal==0 or $nrtn=='' or $drcr=='')
	{
	?>
<script language="javascript">
alert('Please Fill All The Fields.');
window.history.go(-1);
</script>
<?	}
	else
	{	

	$query4 = "SELECT * FROM main_drcr where (cldgr='$ldgr' and dldgr='$dldgr' and sid='$sup' and cid='$cust' and pno='$proj') or (dldgr='$ldgr' and cldgr='$dldgr' and sid='$sup' and cid='$cust' and pno='$proj')";
	$result4 = mysqli_query($conn,$query4)or die (mysqli_error($conn));
		$cnt=0;
	$cnt=mysqli_num_rows($result4);
	$cnt=0;
if($cnt>0)
{
?>
<script language="javascript">
alert('Sorry!! Opening Balance Already Exist.');
window.history.go(-1);
</script>
<?
}
else
{
	
		date_default_timezone_set('Asia/Kolkata');
		$edt = date('d/m/Y h:i:s a', time());
		$yr = date('Y');
		$mnt = date('m');
		if($mnt>=4)
		{
		//$dt = $yr."/04/01";
		$dt = "2018/10/10";
		}
		else
		{
/* 		$yr=$yr-1;
		$dt = $yr."/04/01";
 */	
		$dt = "2018/10/10";

		}
		
		if($drcr==-1)
    {
        $dldgr="-1";
        $cldgr=$ldgr;
    }
    else
    {
        $cldgr="-1";
        $dldgr=$ldgr;
    }
		
$query51="select * from ".$DBprefix."drcr order by sl desc limit 0,1";
$result51 = mysqli_query($conn,$query51);
while($rows=mysqli_fetch_array($result51))
{	
$vnos=$rows['vno'];
}	
$vid1=substr($vnos,2,7);	

	$vid1=$vid1+1;
	$vnoc=str_pad($vid1, 7, '0', STR_PAD_LEFT);
	$vcno="SV".$vnoc;

		$query21 = "INSERT INTO ".$DBprefix."drcr (pno,typ,vno,sid,cid,dt,nrtn,dldgr,cldgr,amm,brncd,eby,edtm) VALUES ('$proj','11','$vcno','$sup','$cust','$dt','$nrtn','$dldgr','$cldgr','$obal','$brncd','$user_currently_loged','$edt')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn));
?>
<script language="javascript">
alert('Added Successfully, Thank You.');
document.location = "projectop_form.php?brncd=<? echo $brncd;?>";
</script>
<?

}}}
?>

