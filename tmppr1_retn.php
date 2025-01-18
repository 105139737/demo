<?php 



/**

 * @author Onnet Solution

 * @copyright 2015

 */
$_REQUEST['blno'] ?? ""


$reqlevel = 3;

include("membersonly.inc.php");

include("Numbers/Words.php");

$sl=1;

$blno=$_REQUEST[blno];

?>

 <table border="0" width="100%" class="advancedtable">

<?php 

 $query100 = "SELECT * FROM  main_purchasedet where blno='$blno' order by sl";

   $result100 = mysqli_query($conn,$query100);

while ($R100 = mysqli_fetch_array ($result100))

{
$tsl=$R100['sl'];
$prsl=$R100['prsl'];
$pnm=$R100['pnm'];
$qnty=$R100['qty'];
$prc=$R100['prc'];
$ttl=$R100['ttl'];
$mrp=$R100['mrp'];

		$query6="select * from  ".$DBprefix."product where sl='$prsl'";
			$result5 = mysqli_query($conn,$query6);
			while($row=mysqli_fetch_array($result5))
				{
					$pnm=$row['pnm'];
					$cat=$row['cat'];
					$bnm=$row['bnm'];
				
				}
$cnm="";				
$data1= mysqli_query($conn,"select * from main_catg where sl='$cat'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{
$cnm=$row1['cnm'];
}
$brand="";
$data2= mysqli_query($conn,"select * from main_brand where sl='$bnm'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data2))
{
$brand=$row1['brand'];
}?>

<tr class="odd">

<td  align="left" width="40%"><b><?php  echo $pnm;?> - <?php  echo $cnm;?> - <?php  echo $brand;?></b></td>
<td align="right" width="10%"><b><?php echo sprintf('%0.2f',$prc);?></b></td>


<td align="right" width="30%" >

<b><b><?php if($qnty>0){?><?php  echo $qnty;?></b><span style="float: right;"><input type="text" name="rqty<?php  echo $tsl;?>" id="rqty<?php  echo $tsl;?>" onblur="if(this.value><?php  echo $qnty;?>){this.focus();this.style.color='red';}else{this.style.color='#0000ff';}" size="10" style="padding:1px;" value="" /><?php }else{$q=$qnty*(-1); echo $q;}?></span></b>

</td>





<td align="right" width="10%"><b><?php echo number_format($ttl,2);?></b></td>

<td align="center" width="10%"><b><?php if($qnty<0){?><font color="red">Return</font><?php }?> </b></td>





</tr>



<?php }?>





</table>



<script>



t();



</script>