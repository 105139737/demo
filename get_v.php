<?php 
inclu$_REQUEST['cat'] ?? """;

$cat=$_REQUEST[cat];
$bnm=$_REQUEST[bnm];
$cat1="";
if($cat!="")
{
	$cat1=" and cat='$cat'";
}
$bnm1="";
if($bnm!="")
{
	$bnm1=" and bnm='$bnm'";
}
?>
<select name="pnm" size="1" class="form-control" id="pnm"  >
<option value="">---ALL---</option>
<?php 
$sql="SELECT * FROM main_product WHERE sl>0 $cat1 $bnm1";
$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
while($row=mysqli_fetch_array($result))
{
					$cat=$row['cat'];
					$bnm=$row['bnm'];
					$variant=$row['pnm'];
			
$cnm="";				
$data1= mysqli_query($conn,"select * from main_catg where sl='$cat'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{
$cnm=$row1['cnm'];
}
$brand="";
$data2= mysqli_query($conn,"select * from main_brand where sl='$bnm'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data2))
{
$brand=$row1['brand'];
}
				?>
			<option value="<?php  echo $row['sl'];?>"><?php  echo $cnm;?> - <?php  echo $brand;?> - <?php  echo $variant;?></option>
				<?php 
				}
				?>
</select>
<script>
 $('#pnm').chosen({
  no_results_text: "Oops, nothing found!",

  });
</script>



