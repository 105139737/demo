<?php$reqlevel = 3;include("membersonly.inc.php");?><table border="0" width="100%" class="advancedtable"> <?$query100 = "SELECT * FROM ".$DBprefix."slt where eby='$user_currently_loged' order by sl";$result100 = mysqli_query($conn,$query100);while ($R100 = mysqli_fetch_array ($result100)){$tsl=$R100['sl'];$prsl=$R100['prsl'];
$prnm=$R100['prnm'];$qnty=$R100['qty'];$prc=$R100['prc'];$ttl=$R100['ttl'];$pslno=$R100['pslno'];		$query6="select * from  ".$DBprefix."product where sl='$prsl'";			$result5 = mysqli_query($conn,$query6);			while($row=mysqli_fetch_array($result5))				{					$pnm=$row['pnm'];					$cat=$row['cat'];					$bnm=$row['bnm'];					$mnm=$row['mnm'];				}				$cnm="";				$data1= mysqli_query($conn,"select * from main_catg where sl='$cat'")or die(mysqli_error($conn));while ($row1 = mysqli_fetch_array($data1)){$cnm=$row1['cnm'];}$brand="";$data2= mysqli_query($conn,"select * from main_brand where sl='$bnm'")or die(mysqli_error($conn));while ($row1 = mysqli_fetch_array($data2)){$brand=$row1['brand'];}?><tr class="even"><td  align="left" width="30%"><b><?=$pnm;?> - <?=$cnm;?> - <?=$brand;?> - <?=$mnm;?></b></td><td align="center" width="10%"><b></b></td><td align="center" width="15%"><b><?=$pslno;?></b></td><td align="center" width="10%" ><b><?=$qnty;?></b></td><td align="right" width="10%" ><b><?=sprintf('%0.2f',$prc);?></b></td><td align="right" width="15%" ><b><?=sprintf('%0.2f',$ttl);?></b></td><td align="center" width="10%"><b><a onclick="if(confirm('Are you Sure?')){deltpr('<?=$tsl;?>')}"><font color="red">Delete</font></a> </b></td></tr>
<?}?>
</table>
<script>

	
t();

</script>