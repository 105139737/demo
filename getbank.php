<?php 
include "config.php";
?>
<select name="bnm" size="1" id="bnm"  class="sc1"  tabindex="12" >
<?php 
$data1 = mysqli_query($conn,"select * from main_ledg where gcd='16'");
echo "<option value=''>Select</option>";
		while ($row1 = mysqli_fetch_array($data1))
	{
	$bn = $row1['nm'];
	$bnsl = $row1['sl'];
	echo "<option value='".$bnsl."'>".$bn."</option>";
	}
	
 

?>
</select>
