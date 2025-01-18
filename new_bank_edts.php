<?php  
$reqlevel = 3; 
include("membersonly.inc.php");
date_default_timezone_set('Asia/Kolkata');
$edt=date('Y-m-d');
$edtm=date('d-m-Y H:i:s');

$brncd=$_POST['brncd'];
$bnm=$_POST['bnm'];
$ac=$_POST['ac'];
$ifsc=$_POST['ifsc'];
$branch=$_POST['branch'];
$sl=$_POST['sl'];
$err="";

if($brncd=="" or $bnm=="" or $ac=="" or $ifsc=="" or $branch=="" )
{
	$err='Please Fill All The Fields...';
	
}
$dsql=mysqli_query($conn,"select * from main_bank where ac='$ac' and sl!='$sl' ") or die (mysqli_error($conn));
$drcnt=mysqli_num_rows($dsql);
if($drcnt>0)
	{
	$err='Duplicate Data...';	
	}
	
if($err=="")
{
	mysqli_query($conn,"UPDATE main_bank SET bnm='$bnm',ac='$ac',ifsc='$ifsc',branch='$branch',brncd='$brncd' WHERE sl='$sl'") or die (mysqli_error($conn));
		
		?>
		<Script language="JavaScript">
		alert('Updated Successfully. Thank You...');
		document.location="new_bank_list.php";
		</script>
		<?php 
}
else
{
	?>
	<script>
	alert('<?php  echo $err;?>');
	history.go(-1);
	</script>
	<?php 
}

?>