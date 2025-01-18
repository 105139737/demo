<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$gdn11=$_REQUEST['gdn'];
$prd11=$_REQUEST['prd'];

if($gdn11!="")
{
	$q=" and bcd='$gdn11'";
}
else
{
$q="";	
}
if($prd11!="")
{
	$r=" and pcd='$prd11'";
}
else
{
$r="";	
}
$data=mysqli_query($conn,"select * from main_reorder where sl>0 $q $r")or die(mysqli_error($conn));
$cnt=mysqli_num_rows($data);
if($cnt==0)
{
?>
<table border="0" class="table table-hover table-striped table-bordered">
<tr>
<td align="center" style="color:red;font-weight:bold;font-size:150%;">Data Not Found</td>
</tr>
</table>
<?php 
}
else
{
	?>
<table border="0" class="table table-hover table-striped table-bordered">
<tr>
<td align="center" style="font-weight:bold;">Sl No.</td>
<td align="center" style="font-weight:bold;">Godown</td>
<td align="center" style="font-weight:bold;">Product</td>
<td align="center" style="font-weight:bold;">Reorder</td>
<td align="center" style="font-weight:bold;">Edit</td>
</tr>

	<?php 
while($row = mysqli_fetch_array($data))
{
$c++;
$sl= $row['sl'];
$gdn1= $row['bcd'];
			$qr1=mysqli_query($conn,"select * from main_branch where sl='$gdn1'")or die(mysqli_error($conn));
			while($r1=mysqli_fetch_array($qr1))
			{
					$gdn=$r1['bnm'];
			}

$prd1= $row['pcd'];
			$qr=mysqli_query($conn,"select * from main_product  where sl='$prd1'")or die(mysqli_error($conn));
			while($r=mysqli_fetch_array($qr))
			{
					$prd=$r['pnm'];
			}

$reord= $row['re'];


if($reord=="")
{
	$reord='images/blnk.png';
}
?>
<tr>
<td align="center"><?php  echo $c;?>.</td>
<td align="center"><?php  echo $gdn;?></td>
<td align="center"><?php  echo $prd;?></td>
<td align="center"><?php  echo $reord;?></td>
<td align="center"><a href="reord_edit.php?sl=<?php  echo $sl;?>" title="Click to Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
</tr>

<?php 
}
echo "</table>";
}	
?>