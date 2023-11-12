<?php
$reqlevel = 1;
include("membersonly.inc.php");
$dt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s a');

$sid=$_REQUEST['cid'];

?>

<select name="addr"  id="addr"  class="form-control" onchange="get_state()">

<?
$query1="Select * from main_suppl_gst where spn='$sid'";
$result1=mysqli_query($conn,$query1);
while($row=mysqli_fetch_array ($result1))
{
$spn=$row['spn'];
$addr=$row['addr'];
$pan=$row['pan'];
$gstin=$row['gstin'];
$x=$row['sl'];
?>
<option value="<?=$x?>"><?=$addr?> <?if($gstin!=""){?>( <?=$gstin;?> )<?}?></option>
<?
}
?>
</select>
<script>
get_state();
</script>