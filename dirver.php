<?php 
$reqlevel = 3;
include("membersonly.inc.php");

$cno=$_REQUEST[cno];
?>
	<input type="text"  list="browsers1" id="dnm" class="form-control" onblur="getdet()"  autocomplete="off"  name="dnm" value="" tabindex="4" placeholder="Please Enter Driver Name">
	    
  <datalist id="browsers1">
<?php 
 $data= mysqli_query($conn,"select * from main_dirver where  cno='$cno'")or die(mysqli_error($conn));
 
while ($row = mysqli_fetch_array($data))
{
	$dnm=$row['dnm'];
	$sl=$row['sl'];
?>
  <option value="<?php  echo $dnm;?>"/>
 <?php 
}
 ?>
  </datalist>