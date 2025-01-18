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

<input type="tex" class="form-control" id="addr" name="addr" value="<?php  echo $d;?>" tabindex="4" size="158" placeholder ="Enter Supplier Address">
