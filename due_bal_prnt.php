<?
$reqlevel = 3; 
include("membersonly.inc.php");
include("function.php");
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$snm=$_REQUEST['snm'];
$brncd=$_REQUEST['brncd'];
$sman=$_REQUEST['sman'];
$val=$_REQUEST['val'];
$dt=$_REQUEST['dt'];
$dt_show=$_REQUEST['dt'];
$invto=$_REQUEST['invto'];
$order_by=$_REQUEST['order_by'];
$cat=$_REQUEST['cat'];

$btyp=rawurldecode($_REQUEST['btyp']);
$btyp=str_replace("@","'",$btyp);
$refsl=$_REQUEST['refsl'];
$blno=rawurldecode($_REQUEST['blno']);if($blno!=""){$blno1=" and cbill like '%$blno%' ";}else{$blno1="";}
if($btyp==""){$btyp1="";}else{$btyp1=" and ($btyp)";}
if($brncd==""){$brncd1="";}else{$brncd1=" and brncd='$brncd'";}
if($sman==""){$sman1="";}else{$sman1=" and sman='$sman'";}
if($snm!=""){$snm1=" and cid='$snm'";}else{$snm1="";}
if($refsl!=""){$refsl1=" and refsl='$refsl'";}else{$refsl1="";}
if($order_by!=""){$order_by1="cid,dt";}else{$order_by1="dt";}
//if($btyp!=""){$btyp1=" and cbill like '$btyp%'";}else{$btyp1="";}
$qury="";
if($cat!='')
{
$query="select * from main_cust WHERE sl>0 and brand='$cat' and typ='2' order by nm";
$result=mysqli_query($conn,$query);
while($rw=mysqli_fetch_array($result))
{
$cid=$rw['sl'];
if($qury=="")
{
$qury=" and (cid='$cid'	";
}
else
{
$qury.=" or cid='$cid'";	
}
}
if($qury!=""){$qury.=")";}
}

$qury_cust="";
if($sman!='')
{
$query="select * from main_cust_asgn WHERE sl>0 and spid='$sman'";
$result=mysqli_query($conn,$query);
while($rw=mysqli_fetch_array($result))
{
$cust=$rw['cust'];
if($cust!="")
{
$qury_cust="  and FIND_IN_SET(cid, '$cust')>0";
}

}

}



if($invto!='' or $refsl!='')
{
if($invto!=""){$invto1=" and invto='$invto'";}else{$invto1="";}		
$val_invto="";
$data2= mysqli_query($conn,"select * from  main_billing where sl>0 $invto1 $refsl1")or die(mysqli_error($conn));
while ($row2 = mysqli_fetch_array($data2))
{
$blno_s=$row2['blno'];
if($val_invto=="")
{
$val_invto=" and (cbill='$blno_s'";
}
else
{
$val_invto.="or cbill='$blno_s'";	
}
}
if($val_invto!="")
{
$val_invto.=")";
}
}



if($dt!="" ){$dt=date('Y-m-d', strtotime($dt));$date=" and dt<='$dt'";}else{$date="";}
$cdt=$dt;
$dis1=0;


$due_stat=$_REQUEST['due_stat'];

$gbt=mysqli_query($conn,"select * from main_cust where sl='$snm'");
while($GB=mysqli_fetch_array($gbt))
{
$bto=$GB['nm'];
$nmp=$GB['nmp'];
$baddr=$GB['addr'];
$bmob=$GB['cont'];
$i=1;
}

$data11= mysqli_query($conn,"select * from  main_drcr where sl>0  and cbill!='' and retn_stat!='1'  and paid='0' $brncd1  $snm1 $qury_cust $btyp1 $date $blno1 $val_invto $qury group by cbill order by $order_by1 ") or die(mysqli_error($conn));
$count=mysqli_num_rows($data11);
?>
<style>
table {
    border-collapse: collapse;
	font-size:75%;
}
</style>
<table  width="100%" border="1"  cellspacing="0">
<thead>
	<tr bgcolor="#e8ecf6">
	<td align="left" valign="top" colspan="9"><font size="2" >
	<font size="3"><b>Due List Up To <?=$dt_show;?></b></font><br>
	  <?=$bto."<br>".$baddr."<br>";
	if($bmob!="")
	{
	echo "Mob : ".$bmob;
	}
	?>
	</font></td>
	</tr>
	<tr bgcolor="#e8ecf6">
	<td  align="center" >Sl</td>
	<td  align="center">BRAND</td>
	<td  align="center">Date</td>
	<td  align="center" >Ref. No.</td>
	<td  align="center" >Party's Name</td>
	<td  align="center" >Bill Value</td>
	<td  align="center" >Pending</td>
	<td  align="center" >Overdue</td>	
	<td  align="center" >SALES PERSON</td>
	</tr>	
</thead>
<tbody>
<?
$tot=0;
$tot_over_due=0;
$tot_bill_amm=0;
/*$data11= mysqli_query($conn,"select * from  main_drcr where sl>0  and cbill!='' and retn_stat!='1'  $brncd1  $snm1 $sman1 $btyp1 group by cbill order by dt")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data11))
{*/
	
$cnt=0;	 
while ($row1 = mysqli_fetch_array($data11))
{
$cnt++;	
$bill_dt="";		
$blno=$row1['cbill'];
$dt=$row1['dt'];
$bill_dt=$row1['dt'];
$brncd=$row1['brncd'];
$cid=$row1['cid'];

$dt=date('d-m-Y', strtotime($dt));
$invto="";

$als="";
$sale_per="";
$bill_amm=0;
$sale_per="";
$sfno="";
$data2= mysqli_query($conn,"select * from  main_billing where blno='$blno' and cstat='0'")or die(mysqli_error($conn));
while ($row2 = mysqli_fetch_array($data2))
{
$invto=$row2['invto'];
$als=$row2['als'];
$sale_per=$row2['sale_per'];
$bill_amm=$row2['amm'];
$sfno=$row2['sfno'];
}
if($als=="")
{
$btyp=substr($blno,0,7);
$als = preg_replace('/[0-9]+/', '', $btyp);
if($als=="")
{
$als=$btyp;
}
$data2= mysqli_query($conn,"select * from  bills_receivable where Ref_No='$blno'")or die(mysqli_error($conn));
while ($row2 = mysqli_fetch_array($data2))
{
$sale_per=$row2['SALES_PERSON'];
}
}


$data21= mysqli_query($conn,"select * from  main_drcr where cbill='$blno' and cid='$cid' and nrtn='Sale' and dldgr='4' and (cldgr='-2' or cldgr='-1') $date ")or die(mysqli_error($conn));
while ($row2 = mysqli_fetch_array($data21))
{
$bill_dt=$row2['dt'];
}
if($bill_dt=='')
{
$data21= mysqli_query($conn,"select * from  main_drcr where cbill='$blno' and cid='$cid' and nrtn='Sale Return' and dldgr='-2' and cldgr='4' $date ")or die(mysqli_error($conn));
while ($row2 = mysqli_fetch_array($data21))
{
$bill_dt=$row2['dt'];
}
}
$nm="";
$query1="select * from main_cust  WHERE sl='$cid'";
$result1=mysqli_query($conn,$query1);
while($rw=mysqli_fetch_array($result1))
{
$nm=$rw['nm'];
}
$invnm="";
$query="select * from main_cust  WHERE sl='$invto'";
$result=mysqli_query($conn,$query);
while($rw=mysqli_fetch_array($result))
{
$invnm="(".$rw['nm'].")";
}
$T=0;
$t1=0;
$t2=0;
$data= mysqli_query($conn,"SELECT sum(amm) as t1 FROM main_drcr where stat='1' and cbill='$blno' and cid='$cid' and dldgr='4'  $date");
while ($row = mysqli_fetch_array($data))
{
$t1 = $row['t1'];
}
$data1= mysqli_query($conn,"SELECT sum(amm) as t2 FROM main_drcr where  stat='1' and cbill='$blno' and cid='$cid'  and cldgr='4' $date ");
while ($row16 = mysqli_fetch_array($data1))
{
$t2 = $row16['t2'];
}
$T=$t1-$t2;
$cdt=date('Y-m-d');
if($T<1)
{
$data21= mysqli_query($conn,"select * from  main_drcr where cbill='$blno' and cid='$cid' and cldgr='4' order by dt desc limit 0,1")or die(mysqli_error($conn));
while ($row2 = mysqli_fetch_array($data21))
{
$cdt=$row2['dt'];
}	
}
$diff = (strtotime($bill_dt) - strtotime($cdt));
$over_due = (abs(floor($diff / (60*60*24))));

$slno++;
$bll=explode("/",$blno);
if($T!=0 and $due_stat=="1")
{
?>	


		
<tr>
<td  align="center" ><?=$slno;?></td>
<td  align="left"><?=$als;?></td>
<td  align="center"><?=$bill_dt;?></td>

<td  align="left" ><a onclick="vwdtl('<?=$blno;?>')" title="Click Here To View "><?=$blno;?></a></td>
<td  align="left" ><?=$nm;?> <?=$invnm;?> <?=$sfno;?></td>
<td  align="right" ><?=$bill_amm;?></td>
<td  align="right" ><?=round($T,2);?></td>
<td  align="center" ><?=$over_due;?></td>

<td  align="center" ><?=$sale_per;?></td>
</tr>
<?
$tot+=$T;
$tot_over_due+=$over_due;
$tot_bill_amm+=$bill_amm;
}
if($due_stat=="0")
{
?>
<tr>
<td  align="center" ><b><?=$slno;?></b></td>
<td  align="left"><b><?=$als;?></b></td>
<td  align="center"><b><?=$bill_dt;?></b></td>

<td  align="left" ><a onclick="vwdtl('<?=$blno;?>')" title="Click Here To View "><b><?=$blno;?></b></a></td>
<td  align="left" ><b><?=$nm;?> <?=$invnm;?> <?=$sfno;?></b></td>
<td  align="right" ><b><?=$bill_amm;?></b></td>
<td  align="right" ><b><?=round($T,2);?></b></td>
<td  align="center" ><b><?=$over_due;?></b></td>

<td  align="left" ><b><?=$sale_per;?></b></td>
</tr>
<?	
$tot+=$T;
$tot_over_due+=$over_due;
$tot_bill_amm+=$bill_amm;

}
}
?>
</tbody>
<tr bgcolor="#faf9e0">
<td  align="right" colspan="5">Total : - </td>
<td  align="right" ><?=round($tot_bill_amm,2);?></td>
<td  align="right" ><?=round($tot,2);?></td>
<td  align="center" ></td>
<td></td>
</tr>

</table>

<script>
window.print();
</script>