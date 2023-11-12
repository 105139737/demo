<?php
$reqlevel = 1;
include("membersonly.inc.php");
include("function.php");

$all=$_REQUEST['all'];
$tp1=$_REQUEST['tp1'];
 $brand1=rawurldecode($_REQUEST['brand1']);
$brncd1=$_REQUEST['brncd1'];
$typ=$_REQUEST['typ'];
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

//echo "select * from main_billtype where sl>0 and stat='0' and inv_typ='$typ' $all1 $tp2 $brand2 $brncd2 order by als";
if($typ==44 and ($user_currently_loged!='admin' and $user_currently_loged!='hdadmin'))
{

$get=mysqli_query($conn,"select * from main_billtype where sl>0 and stat='0' and inv_typ='$typ' and user='$user_currently_loged' $all1 $tp2 $brand2 $brncd2 order by als") or die(mysqli_error($conn));
}
else
{
	
$get=mysqli_query($conn,"select * from main_billtype where sl>0 and stat='0' and inv_typ='$typ' $all1 $tp2 $brand2 $brncd2 order by als") or die(mysqli_error($conn));

}
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
<?php if(($user_currently_loged=='admin' or $user_currently_loged=='hdadmin') and $typ==44)
{ ?>
<th style="text-align:center;" >Expenses Ledger </th>
<?php } ?>
<?php if(($user_currently_loged=='admin' or $user_currently_loged=='hdadmin') and $typ==44)
{ ?>
<th style="text-align:center;" >Expenses User </th>
<?php } ?>

</tr>
<?
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
	$exp_ledgr=$row['exp_ledgr'];
	$user=$row['user'];
	
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
<tr style="cursor:pointer;">
<td style="text-align:center;" onclick="submit('<?=$ssl;?>')" >
<?=$cnt;?></td>
<td style="text-align:left;"  onclick="submit('<?=$ssl;?>')" >
<b><?=$als;?></b></td>
<td style="text-align:left;"  onclick="submit('<?=$ssl;?>')" >
<?=$ssn;?></td>
<td style="text-align:left;"  onclick="submit('<?=$ssl;?>')" >
<?=$tps;?></td>
<td style="text-align:left;"  onclick="submit('<?=$ssl;?>')" >
<? echo $val;?></td>
<?php if(($user_currently_loged=='admin' or $user_currently_loged=='hdadmin') and $typ==44)
{ ?>
<td>
<select name="exp_ledgr" id="exp_ledgr" class="form-control"  tabindex="1"  onchange="sedtt('<?echo $ssl;?>','exp_ledgr',this.value,'main_billtype')" >
<option value="">---Select---</option>
<?php 
$getl = mysqli_query($conn,"SELECT * FROM main_ledg where gcd='30'") or die(mysqli_error($conn));
while($rowl = mysqli_fetch_array($getl))
{
?>
<option value="<?=$rowl['sl']?>" <?=$rowl['sl'] == $exp_ledgr ? 'selected' : '' ?>><?=$rowl['nm']?></option>
<?php 
} 
?>
</select>
</td>
<?php } ?>
<?php if(($user_currently_loged=='admin' or $user_currently_loged=='hdadmin') and $typ==44)
{ ?>
<td>
<select name="user" id="user" class="form-control"  tabindex="1"  onchange="sedtt('<?echo $ssl;?>','user',this.value,'main_billtype')" >
<option value="">---Select---</option>
<?php 
$getl1 = mysqli_query($conn,"SELECT * FROM main_signup where actnum='0' and userlevel in (10,5,7,6,-1) order by username") or die(mysqli_error($conn));
while($rowl = mysqli_fetch_array($getl1))
{
?>
<option value="<?=$rowl['username']?>" <?=$rowl['username'] == $user ? 'selected' : '' ?>><?=$rowl['username']?> - <?=$rowl['name']?></option>
<?php 
}
?>
</select>
</td>
<?php } ?>
</tr>
<?															
}
?>
</table>
<?
}
else
{
	?>
	<table class="table table-hover table-striped table-bordered">
	<tr>
	<td style="text-align:center;"><font size="4" color="red"><b>No Records Available</b></font></td>
	</tr>
	</table>
	<?
}
?>