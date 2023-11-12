<?
$reqlevel = 1;
include("membersonly.inc.php");
$sl=$_REQUEST[sl];

?>

<?

 $query3="Select * from ".$DBprefix."stock where sl='$sl'";
$result3 = mysqli_query($conn,$query3);
  while ($R3 = mysqli_fetch_array ($result3))
{
$expdt=$R3['expdt'];
}
?>
<input type="text" class="form-control" id="expdt"  name="expdt" value="<?=$expdt;?>" readonly  size="12">
