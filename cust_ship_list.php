<?php 
$reqlevel = 3;
include("membersonly.inc.php");

$frmnm='';
date_default_timezone_set('Asia/Kolkata');
$cid=$_REQUEST['cid'];
?>
<table  class="table table-hover table-striped table-bordered"  >	
<tr>
<th >Action</font></th>
<th >Sl</font></th>
<th >Address</font></th>
<th >Mobile</font></th>
<th >Default</font></th>

</tr>
<?php 
$sl=0;
$sln=0;

$data= mysqli_query($conn,"select * from main_cust_shipping where  sl>0 and cid='$cid' ")or die(mysqli_error($conn)); 
while ($row = mysqli_fetch_array($data))
{
$mob=$row['mob'];
$addr=$row['addr'];
$is_default=$row['is_default'];
$x=$row['sl'];
$is_default1="No";
if($is_default=='1'){$is_default1="Yes";}
$sln++;
?>
<tr  >
<td  align="center" style="cursor:pointer" onclick="edit('<?php  echo $x;?>','<?php  echo $addr;?>','<?php  echo $mob;?>')" >
<i class="fa fa-pencil-square-o"></i>
</td>
<td align="center"><?php  echo $sln;?></td>
<td align="center"><?php  echo $addr;?></td>
<td align="center"><?php  echo $mob;?></td>
<td align="center"><?php  echo $is_default1;?></td>
</tr>	 
<?php 
}
?>
</table>
