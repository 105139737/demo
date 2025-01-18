<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$sl=$_REQUEST['sl'];
$fn=$_REQUEST['fn'];
$fv=rawurldecode($_REQUEST['fv']);
$div=$_REQUEST['div'];
$tblnm=$_REQUEST['tblnm'];
$cd='';
if($fv=="")
{
?>
<script>
alert('Please Fill Up!!');
location.reload();
</script>
<?php 
}
	else
	{
		
	
	$sql1=mysqli_query($conn,"select * from  $tblnm where $fn='$fv' and sl!='$sl'")or die(mysqli_error($conn));
	$rcnt=mysqli_num_rows($sql1);
	if($rcnt=='0')
	{
		$sql=mysqli_query($conn,"UPDATE  $tblnm set $fn='$fv' where sl='$sl'")or die(mysqli_error($conn));
	}
	else
	{
		?>
		<script>
		alert('Duplicate Entry!!');
		location.reload();
		</script>
		<?php 
	}
	}








/*
else
{
$sql1 =mysqli_query($conn,"select * from  $tblnm where $fn='$fv' and sl!='$sl'")or die(mysqli_error($conn));


$sql =mysqli_query($conn,"UPDATE  $tblnm set $fn='$fv' where sl='$sl'")or die(mysqli_error($conn));


}*/
										
?>
<a onclick="sedt('<?php echo $sl;?>','<?php  echo $fn;?>','<?php echo $fv;?>','<?php  echo $div;?>','<?php  echo $tblnm;?>')"><b><font size="" color="red"><?php  echo $fv;?></font></b></a>
