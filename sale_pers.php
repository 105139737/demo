<?PHP 
$reqlevel = 3; 
include("membersonly.inc.php");
date_default_timezone_set('Asia/Kolkata');
$dt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s');

$spid=$_POST['spid'];
$nm=$_POST['nm'];
$mob=$_POST['mob'];
$addr=$_POST['addr'];
$typ=$_POST['typ'];
$brncd=$_POST['brncd'];
$err="";

if($spid=="" or $mob==""  or $brncd=="" )
{
	$err='Please Fill All The Fields...';
	
}
$dsql=mysqli_query($conn,"select * from main_sale_per where spid='$spid'") or die (mysqli_error($conn));
$drcnt=mysqli_num_rows($dsql);
if($drcnt>0)
	{
	$err='Duplicate Data...';	
	}
	
if($err=="")
{

	$sql=mysqli_query($conn,"insert into main_sale_per(spid,nm,mob,addr,typ,brncd) values('$spid','$nm','$mob','$addr','$typ','$brncd')") or die (mysqli_error($conn));
	$sqll=mysqli_query($conn,"insert into main_signup(username,name,mob,addr,password,actnum,userlevel,brncd) values('$spid','$nm','$mob','$addr','123','0','$typ','$brncd')") or die (mysqli_error($conn));
		
		?>
		<Script language="JavaScript">
		alert('Submitted Successfully. Thank You...');
		document.location="sale_per.php";
		</script>
		<?
}
else
{
	?>
	<script>
	alert('<?php echo $err;?>');
	history.go(-1);
	</script>
	<?
}

?>