<?php 
include "config.php";
$sl=$_REQUEST['sl'];
$fn=$_REQUEST['fn'];
$fv=rawurldecode($_REQUEST['fv']);
$div=$_REQUEST['div'];
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
$sql =mysqli_query($conn,"UPDATE main_point set $fn='$fv' where sl='$sl'")or die(mysqli_error($conn));
}
?>
<a href="#" onclick="sedt('<?php echo $sl;?>','<?php  echo $fn;?>','<?php echo $fv;?>','<?php  echo $div;?>')"><?php  echo $fv;?></a>
