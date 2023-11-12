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
if($expdt!="0000-00-00")
{
$expdt=date('d-m-Y', strtotime($expdt));
}

?>
<input type="text" class="sc1" id="expdt"  name="expdt" value="<?=$expdt;?>" readonly="true"  size="12">
