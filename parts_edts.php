<?php 
$reqlevel = 1;
include("membersonly.inc.php");
date_default_timezone_set('Asia/Kolkata');
$y=date('Y');
$edt=date('y-m-d');
$edtm=date('y-m-d H:i:s a');

$cat=$_POST['cat'];
$bnm=$_POST['bnm'];
$pnm=$_POST['pnm'];
$pcd=$_POST['pcd'];

$pamm=$_POST['pamm'];
$wiamm=$_POST['wiamm'];
$woamm=$_POST['woamm'];
$sl=$_POST['sl'];



$err="";

$acnt1=substr_count($wiamm,".");
$acnt2=substr_count($woamm,".");

if($acnt1>1){$err='Please Check In Warranty Amount';}
if($acnt2>1){$err='Please Check Out Warranty Amount';}


if($err=="")
{
	if($cat=="" or $bnm=="" or  $pnm=="" or $pcd==""   or  ($wiamm=="" and $wiamm<"1") or  ($woamm=="" and $woamm<"1"))
	{
		$err='Please Fill All The Field';
	}
	
	if($err=="")
	{
		$s=mysqli_query($conn,"select * from main_parts where cat='$cat' and bnm='$bnm' and pnm='$pnm' and pcd='$pcd' and pamm='$pamm' and sl!='$sl' ") or die (mysqli_error($conn));
		$c=mysqli_num_rows($s);
		if($c==0)
		{
			

$query2 = "update main_parts set cat='$cat',bnm='$bnm',pnm='$pnm',pcd='$pcd',wiamm='$wiamm',woamm='$woamm' where sl='$sl'";
$result2 = mysqli_query($conn,$query2)or die (mysqli_error($conn));	



	
			?>
			<script>
			alert('Update Successfully. Thank You');
			document.location="parts_show.php";
			</script>
			<?php 
		}
		else
		{
			?>
			<script>
			alert('Data Already Exists');
			history.go(-1);
			</script>
			<?php 
		}	
	}
}
?>
<script>
alert('<?php  echo $err;?>');
history.go(-1);
</script>
<?php 