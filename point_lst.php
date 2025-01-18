<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$pcd=$_REQUEST['pcd'];

	$qr=mysqli_query($conn,"select * from main_point where sl>0 $q ")or die(mysqli_error($conn));
	$cnt=mysqli_num_rows($qr);

	if($cnt==0)
	{
echo " <table border='0'  class='table table-hover table-striped table-bordered' >
	<tr><td style='font-size:150%;color:red;font-weight:bold;text-align:center;'>
	Data not Found</td></tr></table> ";
		
	}
	else
	{
?>
 <table border="0"  class="table table-hover table-striped table-bordered" >
    <tr>
        <td style="font-weight:bold;text-align:center;">
		Sl No.
        </td>
        <td style="font-weight:bold;text-align:left;">
		Product Name
        </td>
        <td style="font-weight:bold;text-align:center;">
		Piece per Point
        </td> 
		<td style="font-weight:bold;text-align:center;">
		Edit
        </td>
    </tr>
<?php 
$c="";
while($r=mysqli_fetch_array($qr))
{
	$c++;
	$sl=$r['sl'];
	$pcd=$r['pcd'];
	$query6=mysqli_query($conn,"select * from main_product where sl='$pcd'");
	while($row=mysqli_fetch_array($query6))
		{
		$pnm=$row['pnm'];
		}
	$point=$r['point'];
?>
    <tr>
        <td style="text-align:center;">
		<?php  echo $c;?>
        </td>
        <td style="text-align:left;">
		<?php  echo $pnm;?>
        </td>
        <td style="text-align:center;">
		<?php  echo $point;?>
        </td> 
		<td style="text-align:center;"><a href="point_edt.php?sl=<?php  echo $sl;?>">
		<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
        </td>
    </tr>

<?php 
}
?>	
 </table>
	<?php  } ?>