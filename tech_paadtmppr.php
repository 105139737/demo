<?php 
$reqlevel = 1;
include("membersonly.inc.php");
date_default_timezone_set('Asia/Kolkata');
$edt=date('Y-m-d');
$edtm=date('d-m-Y H:i:s');
include("Numbers/Words.php");

 $pnm=$_REQUEST['pnm'];
$qnty=$_REQUEST['qnty'];

$y=mysqli_query($conn,"select (sum(stin)-sum(stout)) as new4 from main_pstock where pcd='$pnm' and tid=''")or die(mysqli_error($conn));
while($vb=mysqli_fetch_array($y))
{
	$qty=$vb['new4'];
}

if($qty<$qnty)
{
	$err="Stock Not Available";
}
if($pnm=='' or $qnty=='' )
{
	$err="Please Enter Product Name ...";
}
else
{	
	$q45=mysqli_query($conn,"select * from main_tech_trntemp where pcd='$pnm' and eby='$user_currently_loged'")or die(mysqli_error($conn));
	$cnt45=mysqli_num_rows($q45);
	if($cnt45>0)	
	{
		$err="Duplicate Entry..... ";
	}
	if($err=="")
	{
		$result=mysqli_query($conn,"SELECT * FROM main_parts where sl='$pnm'")or die(mysqli_error($conn));
		while($R56=mysqli_fetch_array($result))
		{
			$ppnm=$R56['pnm'];
			$pbnm=$R56['bnm'];
			$pcat=$R56['cat'];
		}
		$result21=mysqli_query($conn,"INSERT INTO main_tech_trntemp (pcd,pnm,qnty,eby,edt,edtm) VALUES ('$pnm','$ppnm','$qnty','$user_currently_loged','$edt','$edtm')")or die(mysqli_error($conn)); 
	}
}
if($err=="")
{
	$err="Added Successfully";
}
?>
 <script>
 alert('<?php  echo $err;?>');
tmppr1();
$('#pnm').trigger('chosen:open');
</script>

<?php 
mysqli_close();
?>