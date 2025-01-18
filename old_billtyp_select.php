<?php 
$reqlevel = 1;
include("membersonly.inc.php");
include("function.php");

$all=$_REQUEST['all'];
$tp1=$_REQUEST['tp1'];
$brand1=$_REQUEST['brand1'];
$brncd1=$_REQUEST['brncd1'];
$af="%".$all."%";
if($all!=""){$all1=" and (als like '$af' or tp like '$af' or adrs like '$af' or ssn like '$af')";}else{$all1="";}
$tp2="";
if($tp1!='')
{
$tp2=" and tp='$tp1'";	
}
$brand2="";
if($brand1!='')
{
$brand2=" and find_in_set('$brand1',brand)>0";		
}
$brncd2="";
if($brncd1!='')
{
$brncd2=" and brncd='$brncd1'";	
}

$get=mysqli_query($conn,"select * from main_billtype where sl>0 and stat='0' and inv_typ='1' $all1 $tp2 $brand2 $brncd2 order by als") or die(mysqli_error($conn));
$total=mysqli_num_rows($get);
if($total!=0)
{
?>
<table class="table table-hover table-striped table-bordered">
<tr>
<th style="text-align:center;" width="5%">Sl.No</th>
<th style="text-align:center;" >Alise</th>
<th style="text-align:center;" >Session</th>
<th style="text-align:center;" >Type</th>
<th style="text-align:center;" >Brand </th>


</tr>
<?php 
$cnt="";
while($row=mysqli_fetch_array($get))
{
	$cnt++;
	$ssl=$row['sl'];
	$als=$row['als'];
	$tp=$row['tp'];
	$adrs=$row['adrs'];
	$ssn=$row['ssn'];
	$stat=$row['stat'];
	$brncd=$row['brncd'];
	$brand=$row['brand'];
	
if($tp=='1')
{
$tps="Retail";
}
elseif($tp=='2')
{
$tps = "Wholesale";
}
$val="";
$rr=explode(',',$brand);
for($i=0;$i<count($rr);$i++)
{
	$tagg=$rr[$i];
	$cnm=get_val('main_catg',$tagg,'cnm','sl');
	if($val=="")
	{
	 $val=$cnm;
	}
	else
	{
	 $val=$val.','.$cnm;	
	}
}		
?>
<tr onclick="submit('<?php  echo $ssl;?>')" style="cursor:pointer;">
<td style="text-align:center;"><?php  echo $cnt;?></td>
<td style="text-align:left;"><b><?php  echo $als;?></b></td>
<td style="text-align:left;"><?php  echo $ssn;?></td>
<td style="text-align:left;"><?php  echo $tps;?></td>
<td style="text-align:left;"><?php  echo $val;?></td>

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