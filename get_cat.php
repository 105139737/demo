<?php 
$reqlevel = 1;
include("membersonly.inc.php");
$cat=$_REQUEST['cat'] ?? "";
?>
<select name="scat" class="form-control" size="1" id="scat" tabindex="8"  required>
<Option value="">---Select---</option>
<?php 
$data1 = mysqli_query($conn,"Select * from main_scat where cat='$cat'");

		while ($row1 = mysqli_fetch_array($data1))
	{
	$sl=$row1['sl'];
	$nm=$row1['nm'];
?>
<Option value="<?php  echo $sl;?>"><?php  echo $nm;?></option>
	<?php }?>
</select>
