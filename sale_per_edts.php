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
$sl=$_POST['sl'];
$err="";

if($spid=="" or $mob==""  or $brncd=="" )
{
	$err='Please Fill All The Fields...';
	
}
$dsql=mysqli_query($conn,"select * from main_sale_per where spid='$spid' and sl!='$sl' ") or die (mysqli_error($conn));
$drcnt=mysqli_num_rows($dsql);
if($drcnt>0)
	{
	$err='Duplicate Data...';	
	}
	
if($err=="")
{
	$ddsql=mysqli_query($conn,"select * from main_signup where username='$spid'") or die (mysqli_error($conn));
	if((mysqli_num_rows($ddsql))==0)
	{
	mysqli_query($conn,"INSERT INTO main_signup(username,name,mob,addr,password,actnum,userlevel,brncd) VALUES('$spid','$nm','$mob','$addr','123','0','$typ','$brncd')") or die (mysqli_error($conn));
	}
	else
	{
	mysqli_query($conn,"UPDATE main_signup SET name='$nm',mob='$mob',addr='$addr',userlevel='$typ',brncd='$brncd' WHERE username='$spid'")	or die (mysqli_error($conn));
	}
	mysqli_query($conn,"UPDATE main_sale_per SET nm='$nm',mob='$mob',addr='$addr',typ='$typ' ,brncd='$brncd' WHERE sl='$sl'") or die (mysqli_error($conn));
		
		?>
		<Script language="JavaScript">
		alert('Updated Successfully. Thank You...');
		document.location="sale_per_list.php";
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