<?
$reqlevel = 3;
include("membersonly.inc.php");
$prnm=$_REQUEST['prnm'];
$brncd=$_REQUEST['brncd'];
if($brncd==""){$brncd=1;}
?>
<select name="brncd" class="form-control" tabindex="10"  size="1" id="brncd" onchange="getstock()">
<?
$geti=mysqli_query($conn,"select * from main_godown where sl>0 order by gnm") or die(mysqli_error($conn));
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
?>
<option value="<? echo $sl;?>"<?php if($brncd==$sl){echo "selected";}?>><? echo $gnm;?>  (Stock : <?=$stck;?> )</option>
<?
}
?>
</select>
<?

/*
$stk_rate=0;
$rate=0;
$query41="Select sum(stk_rate) as stk_rate,sum(rate) as rate,count(*) as total from main_stock where pcd='$prnm' and stk_rate>0 and rate>0 and (stin+opst)>0";
$result41 = mysqli_query($conn,$query41);
while ($R4 = mysqli_fetch_array ($result41))
{
$stk_rate=$R4['stk_rate'];	
$rate=$R4['rate'];	
$total=$R4['total'];	
if($total>0)
{
$stk_rate=round($stk_rate/$total,4);	
$rate=round($rate/$total,4);	
}
}
*/
$avg_rate=avg_rate($prnm);
$rate_array=explode("@@",$avg_rate);
$stk_rate=$rate_array[0];
$rate=$rate_array[1];

?>

<script>
document.getElementById('rate').value='<?=$rate;?>';
document.getElementById('stk_rate').value='<?=$stk_rate;?>';
getstock();
$('#brncd').chosen({
no_results_text: "Oops, nothing found!",
});	
document.getElementById('brncd').value="<?php echo $brncd;?>";
$('#brncd').trigger("chosen:updated");
</script>
