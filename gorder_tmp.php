<?php 

/**
 * @author Onnet Solution
 * @copyright 2013
 */

$reqlevel = 1;
include("membersonly.inc.php");
include("Numbers/Words.php");
$pid=$_REQUEST[prnm];
$qnt=$_REQUEST[qty];
$fbcd=$_REQUEST[fbcd];
$tbcd=$_REQUEST[tbcd];

$err="";

if($pid=='' or $qnt=='' or $qnt=='0' )
{
	$err="Please Fill All Fields....";
}
else
{

 $query6="Select * from main_product where sl='$pid'";
$result6 = mysqli_query($conn,$query6);
  while ($R6 = mysqli_fetch_array ($result6))
{

$prnm=$R6['pnm'];
}


$tot=0;


$query7="Select * from main_gordrtmp where prsl='$pid' and eby='$user_currently_loged'";
$result7 = mysqli_query($conn,$query7);
$rowcount=mysqli_num_rows($result7);
if($rowcount==0)
{
$query21 = "INSERT INTO ".$DBprefix."gordrtmp (prsl,prnm,qty,eby,rmk,fbcd,tbcd) VALUES ('$pid','$prnm','$qnt','$user_currently_loged','$rmk','$fbcd','$tbcd')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn)); 
}
else
{
$err="Product Already Exists....";		
}


}
if($err=="")
{
?>
<script>
temp();
  $('#prnm').trigger('chosen:open');
</script>
<?php 
}
else
{
?>
<script>
alert('<?php  echo $err;?>');
temp();

  $('#prnm').trigger('chosen:open');

</script>
<?php 
}
?>