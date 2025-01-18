<?php 
$reqlevel = 1;
include("membersonly.inc.php");
$dt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s a');
$sup=$_REQUEST['sup'];
$sql1="SELECT * FROM main_suppl where sl='$sup'";
$result = mysqli_query($conn,$sql1) or die(mysqli_error($conn));
while($row1=mysqli_fetch_array($result))
{
$name=$row1['nm'];
}
$query1="Select * from main_suppl_gst where spn='$sup'";
$result1=mysqli_query($conn,$query1);
$count=mysqli_num_rows($result1);

if($count>0)
{
?>
<select name="sgstin"  id="sgstin"  class="form-control"  required>

<?php 
while($row=mysqli_fetch_array ($result1))
{
$gstin=$row['gstin'];
$addr=$row['addr'];
?>
<option value="<?php  echo $gstin?>"><?php  echo $gstin?> <?php if($addr!=""){?>( <?php  echo $addr;?> )<?php }?></option>
<?php 
}
?>
</select>
<?php }
else
{
?>
<input type="text" name="sgstin" id="sgstin" class="form-control" value="" required>
<?php }?>
<script>
document.getElementById('name').value='<?php  echo $name;?>';
</script>