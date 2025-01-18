<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$cdt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s a');

$dt='2018-12-06';
$stk_dt='2018-12-05';

$query4="Select ((sum((main_stock.stin+main_stock.opst)*stk_rate))/sum(main_stock.stin+main_stock.opst)) as stk_rate,((sum((main_stock.stin+main_stock.opst)*rate))/sum(main_stock.stin+main_stock.opst)) as rate from main_stock where pcd='$pcd' and main_stock.stin+main_stock.opst>0  ";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$stk_rate=round($R4['stk_rate'],2);
$rate=round($R4['rate'],2);
}
echo $stk_rate."@@".$rate;
