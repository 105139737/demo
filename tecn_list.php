<?
$reqlevel = 3;
include("membersonly.inc.php");
$c="";
$data=mysqli_query($conn,"select * from main_technician")or die(mysqli_error($conn));
$cnt=mysqli_num_rows($data);
if($cnt==0)
{
?>
<table border="0" class="table table-hover table-striped table-bordered">
<tr>
<td align="center" style="color:red;font-weight:bold;font-size:150%;">Data Not Found</td>
</tr>
</table>
<?
}
else
{
	?>
<table border="0" class="table table-hover table-striped table-bordered">
<tr>
<td align="center" style="font-weight:bold;">Sl No.</td>
<td align="center" style="font-weight:bold;">Name</td>
<td align="center" style="font-weight:bold;">Contact</td>
<td align="center" style="font-weight:bold;">Address</td>
<td align="center" style="font-weight:bold;">Image</td>
<td align="center" style="font-weight:bold;">Action</td>
</tr>

	<?
while($row = mysqli_fetch_array($data))
{
	$c++;
$sl= $row['sl'];
$nm= $row['nm'];
$cnt= $row['cnt'];
$adrs= $row['adrs'];
$img= $row['img'];

if($img=="")
{
	$img='images/blnk.png';
}
?>
<tr>
<td align="center"><?=$c;?>.</td>
<td align="center"><?=$nm;?></td>
<td align="center"><?=$cnt;?></td>
<td align="center"><?=$adrs;?></td>
<td align="center"><img src="<?=$img;?>" height="60px;" width="60px;"></td>
<td align="center"><a href="tecn_edt.php?sl=<?=$sl;?>" title="Click to Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i><a></td>
</tr>

<?
}
echo "</table>";
}	
?>