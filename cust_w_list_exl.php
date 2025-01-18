<?php 
$reqlevel = 3;
include("membersonly.inc.php");
include("function.php");
$brand1="";
$brncd1="";

$frmnm='';
date_default_timezone_set('Asia/Kolkata');
$dt = date('d-M-Y');

$cy=date('Y');
$all=rawurldecode($_REQUEST['all']);
$brand=$_REQUEST['brand'];
$brncd=$_REQUEST['brncd'];
$typ=$_REQUEST['typ'];
$sale_per=rawurldecode($_REQUEST['sale_per']);
$al="%".$all."%";
if($all!="")
{
$all1=" and nm LIKE '$al' or addr LIKE '$al' or cont LIKE '$al' or mail LIKE '$al' or gstin LIKE '$al' or nmp LIKE '$al'";
}
else
{
$all1="";	
}
$brand1="";
if($brand!='')
{
$brand1=" and brand='$brand'";
}
if($brncd!='')
{
$brncd1=" and brncd='$brncd'";
}

$typ1="";
if($typ!='')
{
$typ1=" and typ='$typ'";
}
$sale_per1="";
if($sale_per!='')
{
	
$cust=get_value('main_cust_asgn','spid',$sale_per,'cust','');	
$sale_per1="  and FIND_IN_SET(sl, '$cust')>0 ";		
	
}
$file="Customer.xls";
header("Content-type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=$file"); 
?>

<table class="" border="1">	
<tr>
<th>Sl</th>
<th>Brand</th>
<th>Name</th>
<th>Mobile No.</th>
<th>Address</th>
<th>GSTIN</th>
<th>GTM</th>
<th>Sales Person</th>

</tr>
<?php 
$sln=0;
$data=mysqli_query($conn,"select * from main_cust where  sl>0 and typ='2' $all1 $brand1 $typ1 $sale_per1 $brncd1 order by sl desc")or die(mysqli_error($conn));
while($row=mysqli_fetch_array($data))
{
	$x=$row['sl'];
	$nm=$row['nm'];
	$nmp=$row['nmp'];
	$addr=$row['addr'];
	$cont=$row['cont'];
	$email=$row['mail'];
	$vat_no=$row['vat_no'];
	$gstin=$row['gstin'];
	$pan=$row['pan'];
	$typ=$row['typ'];
	$gstdt1=$row['gstdt'];
	$brand=$row['brand'];
	$sale_per=$row['sale_per'];
	$pin=$row['pin'];
	$town=$row['town'];
	$distn=$row['distn'];
	$brncd=$row['brncd'];
	$app=$row['app'];
	$gtm=$row['gtm'];
	$credit_limit=$row['credit_limit'];
	$brncd_nm=get_value('main_branch','sl',$brncd,'bnm','');
	if($gstdt1=='0000-00-00')
	{
	$gstdt="00-00-0000";	
	}
	else
	{
	$gstdt=date('d-m-Y',strtotime($gstdt1));
	}
	$brandnm="";
	$sl=0;
	$sq="SELECT * FROM main_catg WHERE sl='$brand'";
	$res = mysqli_query($conn,$sq) or die(mysqli_error($conn));
	while($ro=mysqli_fetch_array($res))
	{
		$brandnm=$ro['cnm'];
	}		

	if($email==""){$email='NA';}
	if($cont==""){$cont='NA';}
	$sln++;   
	$sl++; 
	$sll=base64_encode($x);
	$err="";
if($gstin!='')
{
if(!preg_match("/[0-9]{2}[a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}[1-9A-Za-z]{1}[Zz1-9A-Ja-j]{1}[0-9a-zA-Z]{1}/", $gstin))
{
$err = "<font color='red'>Invalid GST number</font>";
} 
}
$sale_per="";
$sq1="SELECT * FROM main_cust_asgn WHERE sl>0 and FIND_IN_SET('$x', cust) and typ='0'";
$res1 = mysqli_query($conn,$sq1) or die(mysqli_error($conn));
while($ro=mysqli_fetch_array($res1))
{
$sale_per=$ro['spid'];
}
$brncd_nm=get_value('main_branch','sl',$brncd,'bnm','');
$sale_per_nm=get_value('main_sale_per','spid',$sale_per,'nm','');
?>
<tr>
<td align="center"><?php  echo $sln;?></td>
<td align="left"><?php  echo $brandnm;?></td>
<td align="left"><?php  echo $nm;?></td>
<td align="left"><?php  echo $cont;?></td>
<td align="left"><?php  echo $addr;?></td>
<td align="left"><?php  echo $gstin;?></td>
<td align="left"><?php  echo $gtm;?></td>
<td align="left"><?php  echo $sale_per_nm;?></td>

</tr>	 
<?php 
}
?>
</table>
				