<?
$reqlevel = 1;
include("membersonly.inc.php");
include("function.php");

$all=$_REQUEST['all'];
$tp1=$_REQUEST['tp1'];
$brand1=$_REQUEST['brand1'];
$brncd1=$_REQUEST['brncd1'];
$inv_typ1=$_REQUEST['inv_typ1'];
$stat=$_REQUEST['stat'];

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
$inv_typ2="";
if($inv_typ1!='')
{
$inv_typ2=" and inv_typ='$inv_typ1'";	
}

$stat2="";
if($stat!='')
{
$stat2=" and stat='$stat'";	
}

$get=mysqli_query($conn,"select * from main_billtype where sl>0 $all1 $tp2 $brand2 $brncd2 $inv_typ2 $stat2 order by sl") or die(mysqli_error($conn));
$total=mysqli_num_rows($get);
if($total!=0)
{
?>
<table class="table table-hover table-striped table-bordered">
<tr>
<th style="text-align:center;" width="5%">Sl.No</th>
<th style="text-align:center;" >Branch </th>
<th style="text-align:center;" >Address</th>
<th style="text-align:center;" >Type</th>
<th style="text-align:center;" >Brand </th>
<th style="text-align:center;" >Alise</th>
<th style="text-align:center;" >Session</th>
<th style="text-align:center;" >Starting No.</th>
<th style="text-align:center;" >Invoice Type</th>
<th style="text-align:center;" width="5%">Action</th>
<th >Status</font></th>
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
	$start_no=$row['start_no'];
	$inv_typ=$row['inv_typ'];
	
if($tp=='1')
{
$tps="Retail";
}
elseif($tp=='2')
{
$tps = "Wholesale";
}
$inv_typp="";
if($inv_typ=='0')
{
$inv_typp="Invoice";
}
elseif($inv_typ=='1')
{
$inv_typp = "Return";
}
elseif($inv_typ=='2')
{
$inv_typp = "Service";
}
elseif($inv_typ=='33')
{
$inv_typp = "Income";
}
elseif($inv_typ=='44')
{
$inv_typp = "Expense";
}
elseif($inv_typ=='J01')
{
$inv_typp = "Journal";
}
elseif($inv_typ=='CN01')
{
$inv_typp = "Contra";
}
elseif($inv_typ=='77')
{
$inv_typp = "Customer Received";
}
elseif($inv_typ=='88')
{
$inv_typp = "Supplier Payment";
}
elseif($inv_typ=='C01')
{
$inv_typp = "Debit Note";
}
elseif($inv_typ=='CC01')
{
$inv_typp = "Customer Credit Note";
}
	
if($stat==1)
{
$stat1="<input type=\"button\" class=\"btn btn-block btn-danger btn-xs\" value=\"Deactivate\" onclick=\"act('".$ssl."','0')\" name=\"B2\">";
}
else
{
$stat1="<input type=\"button\" value=\"Active\" class=\"btn btn-block btn-success btn-xs\" onclick=\"act('".$ssl."','1')\" name=\"B1\">";
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
$get1=mysqli_query($conn,"select * from main_billing where bill_typ='$ssl'") or die(mysqli_error($conn));
$countt=mysqli_num_rows($get1);
	
?>
<tr>
<td style="text-align:center;"><?=$cnt;?></td>
<td style="text-align:left;"><?=get_val('main_branch',$brncd,'bnm','sl');?></td>
<td style="text-align:left;"><?=$adrs;?></td>
<td style="text-align:left;"><?=$tps;?></td>
<td style="text-align:left;"><? echo $val;?></td>
<td style="text-align:left;"><?=$als;?></td>
<td style="text-align:left;"><?=$ssn;?></td>
<td style="text-align:left;"><?=$start_no;?></td>
<td style="text-align:left;"><?=$inv_typp;?></td>


<td style="text-align:center;">

<a href="billtyp_edit.php?sl=<?=$ssl;?>" target="_blank" title="Click to Update"><i class="fa fa-pencil-square-o"></i></a>

</td>
<td align="center"><? echo $stat1;?></td>
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