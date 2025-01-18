<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$blno=rawurldecode($_REQUEST['blno']);
$fst="";
$query100 = "SELECT * FROM main_billdtls_edt where eby='$user_currently_loged' and blno='$blno' order by sl";
$result100 = mysqli_query($conn,$query100);
while ($R100 = mysqli_fetch_array ($result100))
{
$fst=$R100['tst'];	
}
$fst1="";
if($fst!=""){$fst1=" and sl='$fst'";}
?>
<select id="tst" data-placeholder="Choose Your Supplier" name="tst" class="form-control" onchange="get_gst()" >

	<?php 
	$sql="SELECT * FROM main_state WHERE sl>0 $fst1 ORDER BY sn";
	$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row=mysqli_fetch_array($result))
		{
	?>
    <option value="<?php  echo $row['sl'];?>"<?php if($row['sl']=='1'){echo 'selected';}?>><?php  echo $row['sn'];?> - <?php  echo $row['cd'];?></option>
<?php }?>
</select>
<script>
  $('#tst').chosen({
  no_results_text: "Oops, nothing found!",

  });
</script>
