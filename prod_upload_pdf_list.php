<?php 
$reqlevel = 1;
include("membersonly.inc.php");

$title=rawurldecode($_REQUEST['ttl']);
$af="%".$title."%";
if($title!=""){$all1=" and title like '$af'";}else{$all1="";}
$get=mysqli_query($conn,"select * from main_prod_prc_pdf where sl>0 $all1 order by sl") or die(mysqli_error($conn));
$total=mysqli_num_rows($get);
if($total>0)
{
?>
<table class="table table-hover table-striped table-bordered">
<tr>
<th style="text-align:center;" width="5%">Sl.No</th>
<th style="text-align:center;" >Brand </th>
<th style="text-align:center;" >Type </th>
<th style="text-align:center;" >Title</th>
<th style="text-align:center;" >Attachments</th>
<th style="text-align:center;" >Action </th>
</tr>
<?php 
$cnt=0;
while($row=mysqli_fetch_array($get))
{
	$cnt++;
	$ssl=$row['sl'];
	$title=$row['title'];
	$cat=$row['cat'];
	$typ=$row['typ'];
	//$path=$row['path'];
	 $path="product_price_pdf/".$ssl.".pdf";

$tpnm="";
$data11 = mysqli_query($conn,"Select * from main_cus_typ where sl='$typ'");
while ($row11 = mysqli_fetch_array($data11))
{
$tpnm=$row11['tp'];
}

$catnm="";
$qrr=mysqli_query($conn,"select * from main_catg WHERE sl='$cat'") or die(mysqli_error($conn));
while($rr=mysqli_fetch_array($qrr))
{
$cnm=$rr['cnm'];
}
/*
$str=explode(',',$cat);
$count=count($str);
for($i=0;$i<$count;$i++)
{
$sbl=$str[$i];

if($catnm=="")
{
$catnm=$cnm;
}
else
{
$catnm=$catnm.', '.$cnm;
}
}
*/	 
?>
<tr>
<td style="text-align:center;"><?php  echo $cnt;?></td>
<td style="text-align:left;"><b><?php  echo $cnm;?></b></td>
<td style="text-align:left;"><b><?php  echo $tpnm;?></b></td>
<td style="text-align:left;"><b><?php  echo $title;?></b></td>
<td style="text-align:left;">
<iframe src="<?php  echo $path;?>" style="width:600px; height:100px;" frameborder="0"></iframe>
</td>
<td style="text-align:left;"><a href="prod_upload_pdf_edt.php?sl=<?php  echo $ssl;?>"><i class="fa fa-edit"></i></a></td>

</tr>
<?php 															
}
?>
</table>
<?php 
}
else
{
	?>
	<table class="table table-hover table-striped table-bordered">
	<tr>
	<td style="text-align:center;"><font size="4" color="red"><b>No Records Available</b></font></td>
	</tr>
	</table>
	<?php 
}
?>