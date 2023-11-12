<?php
$reqlevel = 1;
include("membersonly.inc.php");
date_default_timezone_set('Asia/Kolkata');
$edt=date('y-m-d');
$edtm=date('y-m-d H:i:s a');
$fdt3 = date('Y');
$m = date('m');
$fdt=$fdt3."-04-01";
if($m<4)
{ 
$fdt1=$fdt3-1;	
}
else
{
$fdt1=$fdt3;
}
$dt=date('Y-m-d',strtotime($fdt1."-04-01"));


$cat=$_POST['cat'];
$slp=$_POST['slp'];
$sl=$_POST['sl'];
	
if($slp==""  or $sl=="")
{
	?>
	<script>
	alert('Please Fill All The Field');
	history.go(-1);
	</script>
	<?
}
else
{
	$csl="";
	$cnt=count($cat);	
for($i=0;$i<$cnt;$i++)
{
	if($cat[$i]=="ALL")
	{
	$csl="";
$data13 = mysqli_query($conn,"Select * from main_catg");
while ($row13 = mysqli_fetch_array($data13))
	{
	$catsl=$row13['sl'];
	if($csl=="")
	{
	$csl=$catsl;	
	}
	else
	{
	$csl=$csl.",".$catsl;
	}
	}
	break;
	}
	else{
	$csl=$csl.$cat[$i].",";
	}
}
	

		$dsql=mysqli_query($conn,"select * from main_slp_brnd where spsl='$slp' and sl!='$sl'") or die (mysqli_error($conn));
		$drcnt=mysqli_num_rows($dsql);
		if($drcnt==0)
		{
			
		$sql1=mysqli_query($conn,"Update main_slp_brnd set spsl='$slp',catsl='$csl' where sl='$sl'")or die(mysqli_error($conn));	


			?>
			<script>
			alert('Update Successfully. Thank You');
			document.location="brand_assign.php";
			</script>
			<?
		}
		else
		{
			?>
			<script>
			alert('Data Already Exists');
			history.go(-1);
			</script>
			<?
		}
}
	

?>