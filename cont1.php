<?php 
include "config.php";
$cnm=rawurldecode($_REQUEST[cnm]);

        $query = "SELECT * FROM ".$DBprefix."suppl where spn='$cnm'";
   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$c=$R['mob1'];
$d=$R['addr'];
}
?>
<input type="text" id="mob" class="form-control" name="mob" value="<?php  echo $c;?>" tabindex="4" size="35" placeholder ="Enter Supplier Contact No">
