<?
$reqlevel = 3;
include("membersonly.inc.php");
$prnm=$_REQUEST['prnm'];
$brncd=rawurldecode($_REQUEST['brncd']);
$brand=rawurldecode($_REQUEST['cat']);
$data11= mysqli_query($conn,"SELECT * FROM main_godown_tag where sl>0 and brncd='$brncd' and brand='$brand'") or die(mysqli_error($conn));
while ($row11= mysqli_fetch_array($data11))
{	
$tsl=$row11['bcd'];
}
$datag= mysqli_query($conn,"SELECT * FROM main_a_sale_chln where sl>0 and branch='$brncd' and stat='0'") or die(mysqli_error($conn));
$count1=mysqli_num_rows($datag);
?>
<select name="bcd" class="form-control" tabindex="10"  size="1" id="bcd" onchange="gtt_unt();get_betno('');">
<?

$geti=mysqli_query($conn,"select * from main_godown where stat=1 order by gnm") or die(mysqli_error($conn));

while($rowi=mysqli_fetch_array($geti))
{
$sl=$rowi['sl'];
$gnm=$rowi['gnm'];

$stck=0;
$query4="Select sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$prnm' and bcd='$sl'";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$stck=$R4['stck1'];
}	
if($stck==''){$stck=0;}
//echo 
$datag= mysqli_query($conn,"SELECT * FROM main_a_sale_chln where sl>0 and branch='$brncd' and  FIND_IN_SET('$sl', bill_godown)>0  and stat='0'") or die(mysqli_error($conn));
$count=mysqli_num_rows($datag);
$disabled="";
//if($count1>0){$disabled=" selected";}
if($count==0 and $count1>0){$disabled=" disabled";}
?>
<option value="<?php echo $sl;?>"<?php if($sl==$tsl){echo 'selected';}  echo $disabled;?>><? echo $gnm;?>  (Stock : <?=$stck;?> )</option>
<?


}
?>
</select>

<script>
//get_betno('');
$('#bcd').chosen({
no_results_text: "Oops, nothing found!",
});	
</script>
