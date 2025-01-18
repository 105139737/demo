<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$prnm=$_REQUEST['prnm'] ?? "";
$brncd=rawurldecode($_REQUEST['brncd'] ?? "");
$brand=rawurldecode($_REQUEST['cat'] ?? "");
$blno=$_REQUEST['blno'] ?? "";
$tsl="";
if($blno=="")
{
$data11= mysqli_query($conn,"SELECT * FROM main_ptemp where sl>0 and eby='$user_currently_loged' order by sl desc limit 0,1") or die(mysqli_error($conn));
while ($row11= mysqli_fetch_array($data11))
{	
$tsl=$row11['bcd'];
}
}
else
{
$data11= mysqli_query($conn,"SELECT * FROM main_purchasedet_edt where sl>0 and blno='$blno' order by sl desc limit 0,1") or die(mysqli_error($conn));
while ($row11= mysqli_fetch_array($data11))
{	
$tsl=$row11['bcd'];
}    
}

?>
<select name="bcd" class="form-control" tabindex="10"  size="1" id="bcd" onchange="gtt_unt();">
<?php  if($tsl==""){?>
<option value="">---Select---</option>
<?php 
}
$brncd1="";
if ($user_current_level > 0)
{
	$brncd1=" and branch = '$brncd'";
}

$geti=mysqli_query($conn,"select * from main_godown where stat=1 order by gnm") or die(mysqli_error($conn));
while($rowi=mysqli_fetch_array($geti))
{
$sl=$rowi['sl'];
$gnm=$rowi['gnm'];

$datag= mysqli_query($conn,"SELECT * FROM main_a_sale_chln where sl>0 and FIND_IN_SET('$sl', bill_godown)>0  and stat='0' $brncd1") or die(mysqli_error($conn));
$count=mysqli_num_rows($datag);
if($count>0){
$stck=0;
$query4="Select sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$prnm' and bcd='$sl'";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$stck=$R4['stck1'];
}	
if($stck==''){$stck=0;}
?>
<option value="<?php  echo $sl;?>"<?php if($sl==$tsl){echo 'selected';}?>><?php  echo $gnm;?>  (Stock : <?php  echo $stck;?> )</option>
<?php 
}
}
?>
</select>

<script>
$('#bcd').chosen({
no_results_text: "Oops, nothing found!",
});	
</script>
