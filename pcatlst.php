<?php
$reqlevel = 3;
include("membersonly.inc.php");
$dt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s');
$cat=$_POST['cat'];
/*$hsn=$_POST['hsn'];
$sun=$_POST['sun'];
$smvlu=$_POST['smvlu'];
$mun=$_POST['mun'];
$mdvlu=$_POST['mdvlu'];
$bun=$_POST['bun'];
$bgvlu=$_POST['bgvlu'];*/
$hsn="NA";
$err="";
if($cat=="" )
{
$err="Please Enter Brand Name...";	
}	
	
$query = "SELECT * FROM ".$DBprefix."catg where cnm='$cat'";
$result = mysqli_query($conn,$query);
$count=mysqli_num_rows($result);
if($count>0)
{
$err="Data Already Exists...";
}
if($err=="")
{
$query2 = "INSERT INTO ".$DBprefix."catg (cnm,hsn) VALUES ('$cat','$hsn')";
$result2 = mysqli_query($conn,$query2)or die (mysqli_error($conn));
$msg="Submit Successfully. Tankn You";
?>
<script language="javascript">
alert('<?=$msg;?>');
document.location="pcat.php";
</script>
<?
}
else
{
?>
<script language="javascript">
alert('<?=$err;?>');
window.history.go(-1);
</script>
<?	
}
?>






