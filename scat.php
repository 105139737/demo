<?php 

include "config.ph$_REQUEST['cat'] ?? ""

$cat=rawurldecode($_REQUEST[cat]);

?>

<select name="tech" size="1" id="tech"  class="form-control"   tabindex="9" >

<?php 

$data1 = mysqli_query($conn,"select * from main_catg where cnm='$cat' order by tnm");

echo "<option value=''>---Select---</option>";

		while ($row1 = mysqli_fetch_array($data1))

	{

	$tnm = $row1['tnm'];

	$sl = $row1['sl'];

	echo "<option value='".$sl."'>".$tnm."</option>";

	}

	

 



?>

</select>

