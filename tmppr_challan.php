<?php 

/**
 * @author Onnet Solution
 * @copyright 2013
 */

$reqlevel = 3;
include("membersonly.inc.php");
include("Numbers/Words.php");
$sl=1;
?>
 <table border="0" width="100%" class="advancedtable">
 <?php 
 $query100 = "SELECT * FROM main_ctemp where eby='$user_currently_loged' order by sl";
   $result100 = mysqli_query($conn,$query100);
while ($R100 = mysqli_fetch_array ($result100))
{
$tsl=$R100['sl'];
$prnm=$R100['prnm'];
$qnty=$R100['qty'];
$prc=$R100['prc'];
$ttl=$R100['ttl'];
$unt=$R100['unt'];
$betno=$R100['betno'];
$expdt=$R100['expdt'];
$usl=$R100['usl'];
$prc1="";
$un="";
if($expdt!="0000-00-00")
{
$expdt=date('d-m-Y', strtotime($expdt));
}
$log="";

$unit=mysqli_query($conn,"select * from main_unit where sl='$usl'");
while($pr=mysqli_fetch_array($unit))
{
$punt=$pr['pkgunt'];
$upkg=$pr['untpkg'];
$ptu1=$pr['tunt'];	
}


if($punt==$unt)
{	
$log=0;

$qnt1=$qnty/$ptu1;
}
else
{
$qnt1=$qnty;		
$log=1;
}




?>


<tr class="odd">
<td  align="left" width="20%"><b><?php  echo $prnm;?></b></td>
<td align="center" width="13%"><b><?php  echo $betno;?></b></td>
<td align="center" width="10%"><b><?php  echo $expdt;?></b></td>

<td align="center" width="10%" ><b><?php  echo $qnt1;?></b></td>
<td align="center" width="10%" ><b><?php  echo $unt;?></b></td>
<td align="center" width="10%" ><b><?php echo number_format($prc,2);?></b></td>
<td align="center" width="10%" ><b><?php  echo $unt;?></b></td>
<td align="center" width="10%" ><b><?php echo number_format($ttl,2);?></b></td>

<td align="center" width="7%"><b><a onclick="if(confirm('Are you Sure?')){deltpr('<?php  echo $tsl;?>')}"><font color="red">Delete</font></a> </b></td>


</tr>
<?php }?>
</table>
<script>

	
t();

</script>