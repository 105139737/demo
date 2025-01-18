<?php  
$reqlevel = 1;
include("membersonly.inc.php");
set_time_limit(0);

$brand=rawurldecode($_REQUEST['brand']);
$sper=rawurldecode($_REQUEST['sper']);


if($brand==""){$brand1="";}else{$brand1=" and cat='$brand'";}
$data12= mysqli_query($conn,"SELECT * FROM main_sptarget where spid='$sper'");
$target_per="";
while ($row12 = mysqli_fetch_array($data12))
{

$target_per=$row12['target_per'];
}

?>

<table width="100%"  class="table table-bordered">
<tr>
<th><b>SL.</b></th>
<th><b>Category</b></th>
<th><b>Target</b></th>
</tr>
<?php 
$cnt=0;
$data11= mysqli_query($conn,"SELECT * FROM main_scat where sl>0 and cat='$brand'");
while ($row11= mysqli_fetch_array($data11))
{	
$cnt++;
$csl=$row11['sl'];
$catnm=$row11['nm'];

		$tgt=0;
	
		$data12= mysqli_query($conn,"SELECT * FROM main_sptarget where cat='$csl' and spid='$sper'");
		while ($row12 = mysqli_fetch_array($data12))
		{

		$tgt=$row12['tgt'];
	
		}

?>
<tr>
<td><?php  echo $cnt;?></td>
<td><?php  echo $catnm;?></td>
<td><input type="text" name="target<?php  echo $csl;?>" id="target<?php  echo $csl;?>" value="<?php  echo $tgt;?>" oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:60%;"></td>
</tr>
<?php  }?>
</table>
<table width="100%"  class="table table-bordered">
<tr>
<td align="left" style="padding-top:30px;">
<b>Over All Target %</b>
<input type="text"  name="targetp" class="form-control" id="targetp" value="<?php  echo $target_per;?>"  oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" >
</td>
</tr>
</table>

<table width="100%"  class="table table-bordered">
<tr>
<td align="right"><input type="submit" value="Submit" class="btn btn-success"></td>
</tr>
</table>