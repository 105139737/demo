<?php
$reqlevel = 3; 
include("membersonly.inc.php");
set_time_limit(0);

include("function.php");
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$snm=$_REQUEST['snm'];
$brncd=$_REQUEST['brncd'];
$sman=$_REQUEST['sman'];
$val=$_REQUEST['val'];
$dt=$_REQUEST['dt'];
$invto=$_REQUEST['invto'];
$order_by=$_REQUEST['order_by'];
$cat=$_REQUEST['cat'];
$fn=$_REQUEST['fn'];
$tn=$_REQUEST['tn'];

$day=$_REQUEST['day'];

$btyp=rawurldecode($_REQUEST['btyp']);
$btyp=str_replace("@","'",$btyp);
$blno=rawurldecode($_REQUEST['blno']);if($blno!=""){$blno1=" and cbill like '%$blno%' ";}else{$blno1="";}
if($btyp==""){$btyp1="";}else{$btyp1=" and ($btyp)";}
if($brncd==""){$brncd1="";}else{$brncd1=" and brncd='$brncd'";}
if($sman==""){$sman1="";}else{$sman1=" and sman='$sman'";}
if($snm!=""){$snm1=" and cid='$snm'";}else{$snm1="";}
if($refsl!=""){$refsl1=" and refsl='$refsl'";}else{$refsl1="";}

//if($btyp!=""){$btyp1=" and cbill like '$btyp%'";}else{$btyp1="";}



if($order_by!=""){$order_by1="cid,dt";}else{$order_by1="dt";}

if($dt!="" ){$dt=date('Y-m-d', strtotime($dt));$dt_q=date('Y-m-d', strtotime($dt));$date=" and dt<='$dt'";}else{$date="";}

if($fdt!="" and $tdt!=""){$fdt=date('Y-m-d', strtotime($fdt));$tdt=date('Y-m-d', strtotime($tdt));$todts=" and dt between '$fdt' and '$tdt'";$date1="";}else{$todts="";$date1=$date;}


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

if($day!="")
{
  $tskdt=date("Y-")."%";
  $cust="";
  if($sman==""){$spid1="";}else{$spid1=" and spid='$sman'";}
   $data_day = mysqli_query($conn,"Select * from main_task where sl in (select max(sl) from main_task where day='$day' and dt like '$tskdt' $spid1 group by spid) ");
	while ($row1 = mysqli_fetch_array($data_day))
	{
	 $sl=$row1['sl'];
	$cust1=$row1['cust'];
  if($cust=="")
  {
    $cust=$cust1;
  }
  else
  {
    $cust.=",".$cust1; 
  }
  }
  $qury_cust="  and FIND_IN_SET(cid, '$cust')>0";
}


if($invto!='' or $refsl!='' or $todts!='')
{
$val_invto="";
if($invto!='' or $refsl!='')
{
if($invto!=""){$invto1=" and invto='$invto'";}else{$invto1="";}	

$data2= mysqli_query($conn,"select * from  main_billing where sl>0 $invto1 $refsl1 $todts")or die(mysqli_error($conn));
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
}

if($todts!='')
{
$data2= mysqli_query($conn,"select * from  main_drcr where sl>0 $todts  group by cbill ")or die(mysqli_error($conn));
while ($row2 = mysqli_fetch_array($data2))
{
$blno_s=$row2['cbill'];
if($val_invto=="")
{
$val_invto=" and (cbill='$blno_s'";
}
else
{
$val_invto.="or cbill='$blno_s'";	
}
}
}
if($val_invto!="")
{
$val_invto.=")";
}
}



$cdt=$dt;
$dis1=0;
if($val=='1')
{
/*$file="Due_List_".$fn."_To_".$tn.".xls";
header("Content-type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=$file");*/
$jobLink=CreateNewJob('jobs/due_bals_xls.php',$user_currently_loged,'Due List',$conn);
?>
<script language="javascript">
alert('Your request has been accepted. You will get you dwonload link in your home page in a few moments. Thank you...');
window.history.go(-1);
</script>
<?php
die('<b><center><font color="green" size="5">Your request has been accepted. You will get you dwonload link in your home page in a few moments. Thank you...</font></center></b>');
$broder="border='1'";
}

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

/*
$ALLT=0;
$ALLTOD=0;
$ALLTB=0;
$data1yn= mysqli_query($conn,"select * from  main_drcr where sl>0  and cbill!='' and retn_stat!='1'  $brncd1  $snm1 $sman1 $btyp1 group by cbill order by dt")or die(mysqli_error($conn));
while ($row1yn = mysqli_fetch_array($data1yn))
{
$blnon=$row1yn['cbill'];
$dtn=$row1yn['dt'];
$brncdn=$row1yn['brncd'];
$cidn=$row1yn['cid'];
$bill_ammn=0;
$data2n= mysqli_query($conn,"select * from  main_billing where blno='$blnon'")or die(mysqli_error($conn));
while ($row2nn = mysqli_fetch_array($data2n))
{
$bill_ammn=$row2nn['amm'];

}
$ALLTB+$ALLTB+$bill_ammn;

$Tn=0;
$t1n=0;
$t2n=0;
$data21n= mysqli_query($conn,"select * from  main_drcr where cbill='$blnon' and cid='$cidn' and nrtn='Sale' and dldgr='4' and cldgr='-2'  ")or die(mysqli_error($conn));
while ($row2n = mysqli_fetch_array($data21n))
{
$bill_dtn=$row2n['dt'];
}
if($bill_dtn=='')
{
$data21n= mysqli_query($conn,"select * from  main_drcr where cbill='$blnon' and cid='$cidn' and nrtn='Sale Return' and dldgr='-2' and cldgr='4' ")or die(mysqli_error($conn));
while ($row2n = mysqli_fetch_array($data21n))
{
$bill_dtn=$row2n['dt'];
}
}
$datan= mysqli_query($conn,"SELECT sum(amm) as t1 FROM main_drcr where stat='1' and cbill='$blnon' and cid='$cidn' and dldgr='4'");
while ($rown = mysqli_fetch_array($datan))
{
$t1n = $rown['t1'];
}
$data1n= mysqli_query($conn,"SELECT sum(amm) as t2 FROM main_drcr where  stat='1' and cbill='$blnon' and cid='$cidn'  and cldgr='4'");
while ($row16n = mysqli_fetch_array($data1n))
{
$t2n = $row16n['t2'];
}
$Tn=$t1n-$t2n;

$ALLT=$ALLT+$Tn;
$cdtn=date('Y-m-d');
if($Tn<1)
{
$data21n= mysqli_query($conn,"select * from  main_drcr where cbill='$blnon' and cid='$cidn' and cldgr='4' order by dt desc limit 0,1")or die(mysqli_error($conn));
while ($row2n = mysqli_fetch_array($data21n))
{
$cdtn=$row2n['dt'];
}	
}
$diffn = (strtotime($bill_dtn) - strtotime($cdtn));
$over_duen = (abs(floor($diffn / (60*60*24))));

$ALLTOD=$ALLTOD+$over_duen;
}
*/





/* 
$pno=$_REQUEST['pno'];
$ps=$_REQUEST['ps'];
if($ps==""){$ps=40;}
if($pno==""){$pno=1;}
$start=($pno-1)*$ps;


$c1=0;
$sl=$start;
$sln=0;
$c2="odd"; */

$data11= mysqli_query($conn,"select * from  main_drcr where sl>0  and cbill!='' and retn_stat!='1'  and paid='0' and dldgr='4'  $brncd1  $snm1 $qury_cust $btyp1 $date $blno1 $val_invto $qury group by cbill order by $order_by1 limit $fn,$tn") or die(mysqli_error($conn));
$count=mysqli_num_rows($data11);
?>


<?if($val=='1')
{?>
<table  width="100%" border='1' >
<thead>
	<tr bgcolor="#e8ecf6">
	<td align="left" valign="top" colspan="9"><font size="2" >
	<b>  <?=$bto."</b><br>".$baddr."<br>";
	if($bmob!="")
	{
	echo "Mob : ".$bmob;
	}
	?>
	</font></td>
	</tr>
<?}
else {?>
<table  width="100%" <?=$broder;?> class="advancedtable"  >
<?}?>
	<tr bgcolor="#e8ecf6">
	<td  align="center" ><b>Sl</b></td>
	<td  align="center"><b>BRAND</b></td>
	<td  align="center"><b>Date</b></td>
	<td  align="center" ><b>Ref. No.</b></td>
	<td  align="center" ><b>Party's Name</b></td>
	<td  align="center" ><b>Bill Value</b></td>
	<td  align="center" ><b>Pending</b></td>
	<td  align="center" ><b>Overdue</b></td>	
	<td  align="center" ><b>SALES PERSON</b></td>
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
/*
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
*/
$T=0;
$result416 = mysqli_query($conn,"SELECT  (SUM(IF(dldgr='4', amm, 0)) - SUM(IF(cldgr='4', amm, 0))) AS amm FROM main_drcr where  cbill='$blno' and cid='$cid' and  stat='1' $date")or die(mysqli_error($conn));
while ($R16 = mysqli_fetch_array ($result416))
{
$T=$R16['amm'];
}

$T=round($T);

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


$bll=explode("/",$blno);
if(round($T,0)!=0 and $due_stat=="1")
{
$slno++;	
?>	


		
<tr>
<td  align="center" ><b><?=$slno;?></b></td>
<td  align="left"><b><?=$als;?></b></td>
<td  align="center"><b><?=$bill_dt;?></b></td>

<td  align="left" ><a onclick="vwdtl('<?=$blno;?>')" title="Click Here To View "><b><?=$blno;?></b></a></td>
<td  align="left" ><b><?=$nm;?>  <?=$invnm;?> <?=$sfno;?></b></td>
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

if($T==0)
{
$qr=mysqli_query($conn,"update main_drcr set paid='1' where cbill='$blno'") or die(mysqli_error($conn));
}
else
{
$qr=mysqli_query($conn,"update main_drcr set paid='0' where cbill='$blno'") or die(mysqli_error($conn));	
}
}
?>
</tbody>
<tr bgcolor="#faf9e0">
<td  align="right" colspan="5"><b>Total : - </b></td>
<td  align="right" ><b><?=round($tot_bill_amm,2);?></b></td>
<td  align="right" ><b><?=round($tot,2);?></b></td>
<td  align="center" ><b></b></td>
<td></td>
</tr>

<?
/*
$gtotal=0;
$gbilltotal=0;
$data11= mysqli_query($conn,"select * from  main_drcr where sl>0  and cbill!='' and retn_stat!='1'  $brncd1  $snm1 $qury_cust $btyp1 $date $blno1 $val_invto $qury group by cbill order by $order_by1") or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data11))
{
$cnt++;			
$blno=$row1['cbill'];
$cid=$row1['cid'];
$bill_amm=0;
$data2= mysqli_query($conn,"select * from  main_billing where blno='$blno'")or die(mysqli_error($conn));
while ($row2 = mysqli_fetch_array($data2))
{
$bill_amm=$row2['amm'];
}
$T=0;
$t1=0;
$t2=0;

$data= mysqli_query($conn,"SELECT sum(amm) as t1 FROM main_drcr where stat='1' and cbill='$blno' and cid='$cid' and dldgr='4' $date");
while ($row = mysqli_fetch_array($data))
{
$t1 = $row['t1'];
}
$data1= mysqli_query($conn,"SELECT sum(amm) as t2 FROM main_drcr where  stat='1' and cbill='$blno' and cid='$cid'  and cldgr='4' $date");
while ($row16 = mysqli_fetch_array($data1))
{
$t2 = $row16['t2'];
}
$T=$t1-$t2;
if(round($T,0)!=0 and $due_stat=="1")
{
$gtotal+=$T;
$gbilltotal+=$bill_amm;
}
if($due_stat=="0")
{
$gtotal+=$T;
$gbilltotal+=$bill_amm;	
}

}
*/
/*
?>
<tr bgcolor="#e8ecf6">
<td  align="right" colspan="5"><b>Grand Total : - </b></td>
<td  align="right" ><b><?=round($gbilltotal,2);?></b></td>
<td  align="right" ><b><?=round($gtotal,2);?></b></td>
<td  align="center" ><b></b></td>
<td></td>
</tr>
*/?>
</table>



