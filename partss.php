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

$wiamm=$_POST['wiamm'];
$woamm=$_POST['woamm'];



$err="";

$acnt1=substr_count($wiamm,".");
$acnt2=substr_count($woamm,".");

if($acnt1>1){$err='Please Check In Warranty Amount';}
if($acnt2>1){$err='Please Check Out Warranty Amount';}


if($err=="")
{
	if($cat=="" or $bnm=="" or  $pnm=="" or $pcd==""  or  ($wiamm=="" and $wiamm<"1") or  ($woamm=="" and $woamm<"1"))
	{
		$err='Please Fill All The Field';
	}
	
	if($err=="")
	{
		$s=mysqli_query($conn,"select * from main_parts where cat='$cat' and bnm='$bnm' and pnm='$pnm' and pcd='$pcd'") or die (mysqli_error($conn));
		$c=mysqli_num_rows($s);
		if($c==0)
		{
			
		
$sql=mysqli_query($conn,"insert into main_parts(cat,bnm,pnm,pcd,wiamm,woamm,edt,eby)
 values('$cat','$bnm','$pnm','$pcd','$wiamm','$woamm','$edt','$user_currently_loged')") or die (mysqli_error($conn));
			
			?>
			<script>
			alert('Submitted Successfully. Thank You');
			document.location="parts.php";
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