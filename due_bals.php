<?php 
$reqlevel = 3; 
include("membersonly.inc.php");
include("function.php");
set_time_limit(0);
$fdt=$_REQUEST['fdt'] ?? "";
$tdt=$_REQUEST['tdt'] ?? "";
$snm=$_REQUEST['snm'] ?? "";
$brncd=$_REQUEST['brncd'] ?? "";
$sman=$_REQUEST['sman'] ?? "";
$val=$_REQUEST['val'] ?? "";
$dt=$_REQUEST['dt'] ?? "";
$invto=$_REQUEST['invto'] ?? "";
$order_by=$_REQUEST['order_by'] ?? "";
$cat=$_REQUEST['cat'] ?? "";
$refsl=$_REQUEST['refsl'] ?? "";
$gt=$_REQUEST['gt'] ?? "";
$paid=$_REQUEST['paid'] ?? "";
$fdt=$_REQUEST['fdt'] ?? "";
$tdt=$_REQUEST['tdt'] ?? "";
$day=$_REQUEST['day'] ?? "";

$btyp=rawurldecode($_REQUEST['btyp']);
$blno=rawurldecode($_REQUEST['blno']);if($blno!=""){$blno1=" and cbill like '%$blno%' ";}else{$blno1="";}
$btyp=str_replace("@","'",$btyp);

if($btyp==""){$btyp1="";}else{$btyp1=" and ($btyp)";}
if($brncd==""){$brncd1="";}else{$brncd1=" and brncd='$brncd'";}
if($sman==""){$sman1="";}else{$sman1=" and sman='$sman'";}
if($snm!=""){$snm1=" and cid='$snm'";}else{$snm1="";}
if($refsl!=""){$refsl1=" and refsl='$refsl'";}else{$refsl1="";}
if($order_by!=""){$order_by1="cid,dt";}else{$order_by1="dt";}
if($paid=="1"){$paid1="";}else{$paid1=" and paid='0'";}
//if($btyp!=""){$btyp1=" and cbill like '$btyp%'";}else{$btyp1="";}

if($fdt!="" and $tdt!=""){$fdt=date('Y-m-d', strtotime($fdt));$tdt=date('Y-m-d', strtotime($tdt));$todts=" and dt between '$fdt' and '$tdt'";}else{$todts="";}

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
$val_invto="";
if($invto!='' or $refsl!='' or $todts!='')
{

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
$broder="";
if($dt!="" ){$dt=date('Y-m-d', strtotime($dt));$dt_q=date('Y-m-d', strtotime($dt));$date=" and dt<='$dt'";}else{$date="";}
$cdt=$dt;
$dis1=0;
if($val=='1')
{
$file="Due_List.xls";
header("Content-type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=$file"); 	
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







$pno=$_REQUEST['pno'] ?? "";
$ps=$_REQUEST['ps'] ?? "";
if($ps==""){$ps=50;}
if($pno==""){$pno=1;}
$start=($pno-1)*$ps;

$c1=0;
$sl=$start;
$sln=0;
$c2="odd";
$datatt= mysqli_query($conn,"select * from  main_drcr where sl>0 and cbill!='' and retn_stat!='1' and dldgr='4'  $paid1  $brncd1 $snm1 $qury_cust $btyp1 $date $blno1 $val_invto $qury  group by cbill order by $order_by1")or die(mysqli_error($conn));
$rcntttl=mysqli_num_rows($datatt);
$datar= mysqli_query($conn,"select * from  main_drcr where sl>0  and cbill!='' and retn_stat!='1' and dldgr='4'  $paid1 $brncd1  $snm1 $qury_cust $btyp1 $date $blno1 $val_invto $qury  group by cbill order by $order_by1")or die(mysqli_error($conn));
$rcnt=mysqli_num_rows($datar);
$data11= mysqli_query($conn,"select * from  main_drcr where sl>0  and cbill!='' and retn_stat!='1' and dldgr='4'   $paid1 $brncd1  $snm1 $qury_cust $btyp1 $date $blno1 $val_invto $qury  group by cbill order by $order_by1  limit $start,$ps") or die(mysqli_error($conn));
$count=mysqli_num_rows($data11);
if($count>0)
{ 
?>
<div align="left">
<input type="text" name="ps" id="ps" value="<?php  echo $ps;?>" style="width:50px;" onblur="pagnt1()">
</div>

<?php if($val=='1')
{?>
<table  width="100%" border='1' >
<thead>
	<tr bgcolor="#e8ecf6">
	<td align="left" valign="top" colspan="9"><font size="2" >
	<b>  <?php  echo $bto."</b><br>".$baddr."<br>";
	if($bmob!="")
	{
	echo "Mob : ".$bmob;
	}
	?>
	</font></td>
	</tr>
<?php }
else {?>
<table  width="100%" <?php  echo $broder;?> class="advancedtable"  >
<?php }?>
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
<?php 
$tot=0;
$tot_over_due=0;
$tot_bill_amm=0;
$slno=0;
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
if($bill_dt=='')
{
$data22= mysqli_query($conn,"select * from  main_billing where blno='$blno' and cstat='0'")or die(mysqli_error($conn));
while ($row2 = mysqli_fetch_array($data22))
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
if($T==0)
{
$qr=mysqli_query($conn,"update main_drcr set paid='1' where cbill='$blno'") or die(mysqli_error($conn));
}
else
{
$qr=mysqli_query($conn,"update main_drcr set paid='0' where cbill='$blno'") or die(mysqli_error($conn));	
}


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
<td  align="center" ><b><?php  echo $slno;?></b></td>
<td  align="left"><b><?php  echo $als;?></b></td>
<td  align="center"><b><?php  echo $bill_dt;?></b></td>

<td  align="left" ><a onclick="vwdtl('<?php  echo $blno;?>')" title="Click Here To View "><b><?php  echo $blno;?></b></a></td>
<td  align="left" ><b><?php  echo $nm;?> <?php  echo $invnm;?> <?php  echo $sfno;?></b></td>
<td  align="right" ><b><?php  echo $bill_amm;?></b></td>
<td  align="right" ><b><?php echo round($T,2);?></b></td>
<td  align="center" ><b><?php  echo $over_due;?></b></td>

<td  align="left" ><b><?php  echo $sale_per;?></b></td>
</tr>
<?php 
$tot+=$T;
$tot_over_due+=$over_due;
$tot_bill_amm+=$bill_amm;
}
if($due_stat=="0")
{
$slno++;
?>	
	
<tr>
<td  align="center" ><b><?php  echo $slno;?></b></td>
<td  align="left"><b><?php  echo $als;?></b></td>
<td  align="center"><b><?php  echo $bill_dt;?></b></td>

<td  align="left" ><a onclick="vwdtl('<?php  echo $blno;?>')" title="Click Here To View "><b><?php  echo $blno;?></b></a></td>
<td  align="left" ><b><?php  echo $nm;?> <?php  echo $invnm;?> <?php  echo $sfno;?></b></td>
<td  align="right" ><b><?php  echo $bill_amm;?></b></td>
<td  align="right" ><b><?php echo round($T,2);?></b></td>
<td  align="center" ><b><?php  echo $over_due;?></b></td>

<td  align="left" ><b><?php  echo $sale_per;?></b></td>
</tr>
<?php 	
$tot+=$T;
$tot_over_due+=$over_due;
$tot_bill_amm+=$bill_amm;

}
}
?>
</tbody>
<tr bgcolor="#faf9e0">
<td  align="right" colspan="5"><b>Total : - </b></td>
<td  align="right" ><b><?php echo round($tot_bill_amm,2);?></b></td>
<td  align="right" ><b><?php echo round($tot,2);?></b></td>
<td  align="center" ><b></b></td>
<td></td>
</tr>

<?php 
if($gt=='1')
{
$gtotal=0;
$gbilltotal=0;
$data11= mysqli_query($conn,"select * from  main_drcr where sl>0  and cbill!='' and retn_stat!='1' and paid='0'  $brncd1  $snm1 $qury_cust $btyp1 $date $blno1 $val_invto $qury group by cbill order by dt") or die(mysqli_error($conn));
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
/*
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
*/
$T=0;
$result416 = mysqli_query($conn,"SELECT  (SUM(IF(dldgr='4', amm, 0)) - SUM(IF(cldgr='4', amm, 0))) AS amm FROM main_drcr where  cbill='$blno' and cid='$cid' and  stat='1' $date")or die(mysqli_error($conn));
while ($R16 = mysqli_fetch_array ($result416))
{
$T=$R16['amm'];
}


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

?>
<tr bgcolor="#e8ecf6">
<td  align="right" colspan="5"><b>Grand Total : - </b></td>
<td  align="right" ><b><?php echo round($gbilltotal,2);?></b></td>
<td  align="right" ><b><?php echo round($gtotal,2);?></b></td>
<td  align="center" ><b></b></td>
<td></td>
</tr>
<?php  }?>
</table>


<?php 
$tp=$rcnt/$ps;
if(($rcnt%$ps)>0)
{
    $tp=floor($tp)+1;
}
if($pno==1)
{
    $prev=1;
}
else
{
$prev=$pno-1;    
}
if($pno==$tp)
{
 $next=$tp;   
}
else
{
$next=$pno+1;
}
$flt="";
if($rcnt!=$rcntttl)
{
    $flt="(filtered from ".$rcntttl." total entries)";
}
$to=$start+$cnt;
if($rcnt<$ps)
{
	$to=$rcnt;
}
	
?>
<font color="#FF0000"><center><b>Showing <?php  echo $start+1;?> to <?php  echo $to;?> of <?php  echo $rcnt;?> entries <?php  echo $flt?></b></center></font>

<center>
 <div align="center"><input type="text" size="10" id="pgn" name="pgn" value="<?php  echo $pno;?>"><input Type="button" value="Go" onclick="pagnt1('')"></div>

<div class="pagination pagination-centered" style="cursor:pointer;">
<ul class="pagination pagination-sm inline">
<li <?php   if($pno==1){?>class="disabled"<?php  }?>><a onclick="pagnt('1')"><i class="icon-circle-arrow-left"></i>First</a></li>
<li <?php   if($pno==1){?>class="disabled"<?php  }?>><a onclick="pagnt('<?php  echo $prev;?>')"><i class="icon-circle-arrow-left"></i>Previous</a></li>
                            <?php  
                            
                            if($tp<=5)
                            {
                              $n=1;  
                              while($n<=$tp)
                              {
                                ?>
                         <li <?php   if($pno==$n){?>class="active";<?php  }?>><a onclick="pagnt('<?php  echo $n;?>')"><?php  echo $n;?></a></li>   
                                <?php  
                                $n+=1;
                              }  
                            }
                            else
                            {
                                if($pno<4)
                                {
                                  $n=1;
                                  while($n<=5)
                              {
                                ?>
                         <li <?php   if($pno==$n){?>class="active";<?php  }?>><a onclick="pagnt('<?php  echo $n;?>')"><?php  echo $n;?></a></li>   
                                <?php  
                                $n+=1;
                              }     
                                }
                                elseif($pno>$tp-3)
                                {
                                    $n=$tp-5;
                                    while($n<=5)
                              {
                                ?>
                         <li <?php   if($pno==$n){?>class="active";<?php  }?>><a onclick="pagnt('<?php  echo $n;?>')"><?php  echo $n;?></a></li>   
                                <?php  
                                $n+=1;
                              }   
                                }
                                else
                                {
                                $n=$pno-2; 
                                 while($n<=$pno+2)
                              {
                                ?>
                         <li <?php   if($pno==$n){?>class="active";<?php  }?>><a onclick="pagnt('<?php  echo $n;?>')"><?php  echo $n;?></a></li>   
                                <?php  
                                $n+=1;
                              }     
                                }
                                 
                            }
                            ?>
<li <?php   if($pno==$tp){?>class="disabled"<?php  }?>><a onclick="pagnt('<?php  echo $next;?>')">Next<i class="icon-circle-arrow-right"></i></a></li>
<li <?php   if($pno==$tp){?>class="disabled"<?php  }?>><a onclick="pagnt('<?php  echo $tp;?>')">Last<i class="icon-circle-arrow-right"></i></a></li>
</ul>
</div>
<?php  
} else {?><center><b><h2><font color="#FF0000"><b>NO RECORD AVAILABLE</b></font></h2></b></center><?php  }
?>
</center>
