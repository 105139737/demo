<?
$reqlevel=3; 
include("membersonly.inc.php");

$sl=$_REQUEST['sl'];
$qr=mysqli_query($conn,"update main_recv_credit_note set cstat='1' where sl='$sl'") or die(mysqli_error($conn));

$data1=mysqli_query($conn,"SELECT * FROM main_recv_credit_note where sl='$sl'")or die(mysqli_error($conn));
while($row1=mysqli_fetch_array($data1))
{
$blno=$row1['blno'];

}
if($blno!='')
{

mysqli_query($conn,"DELETE FROM main_drcr WHERE blno='$blno' ") or die(mysqli_error($conn));

}
?>
<script>
show1();
</script>