<?
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
include "function.php";

$blno=$_REQUEST['blno'];
if($blno!='')
{
$result21 = mysqli_query($conn,"DELETE FROM main_opening where blno='$blno'")or die(mysqli_error($conn));
$result22 = mysqli_query($conn,"DELETE FROM main_openingdtl where blno='$blno'")or die(mysqli_error($conn));
$result23 = mysqli_query($conn,"DELETE FROM main_stock where pbill='$blno'")or die(mysqli_error($conn));
}
?>

<Script language="JavaScript">
show1();
</script>
