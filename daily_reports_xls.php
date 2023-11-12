<?php 
$reqlevel = 1;
include("membersonly.inc.php");

set_time_limit(0);

$brncd=$_REQUEST[brncd];if($brncd==""){$brncd1="";}else{$brncd1=" and brncd='$brncd'";$bcd=" and bcd='$brncd'";}
$fdt=$_REQUEST[fdt];
$tdt=$_REQUEST[tdt];

if($fdt=="" or $tdt=="")
{ 
echo 'Please Enter Valid Date Range.';
}
else
{
date_default_timezone_set('Asia/Kolkata');
$dt3 = date('y-m-d');
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));
$qry1=" and (dt between '$fdt' and '$tdt')";
}
$m=date('m', strtotime($fdt));

$y=date('y', strtotime($fdt));;
if($m>=4)
{
$ssn="%/".$y."-".($y+1)."%";	
	
}
elseif($m<=3)
{
$ssn="%/".($y-1)."-".$y."%";	
}
$ssn1=" and ssn like '$ssn'";


$jobLink=CreateNewJob('jobs/daily_reports_xls.php',$user_currently_loged,'Brand  Wise Daily Report ',$conn);
    ?>
    <script language="javascript">
    alert('Your request has been accepted. You will get you dwonload link in your home page in a few moments. Thank you...');
    window.history.go(-1);
    </script>
    <?php
    die('<b><center><font color="green" size="5">Your request has been accepted. You will get you dwonload link in your home page in a few moments. Thank you...</font></center></b>');
   

$file="Daily report as $fdt To $tdt.xls";
header("Content-type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=$file"); 
?>

<table width="100%" border="1">

<tr>
<th colspan="5" align="left" >
<font color="#000000" size="3">
Report 1 <?echo $dt?> As On  <?echo $fdt?> to <?echo $tdt?>
</font>
</th>
</tr>
<tr>
  <td  >
 <font color="#000000"><b>BRAND
</b></font>
  </td>
    <td >
  <font color="#000000"><b>DISTRIBUTION SALE</b></font>
  </td> 
   <td >
  <font color="#000000"><b>DISTRIBUTION COLLECTION</b></font>
  </td>
 
  <td  >
  <font color="#000000"><b>RETAIL SALE</b></font>
  </td>  
  <td  >
  <font color="#000000"><b>TOTAL</b></font>
  </td>
</tr>  

<?php 
 
$bslar=array();
$da1= mysqli_query($conn,"SELECT * FROM main_billtype where sl>0 and inv_typ='0' and tp='1' $ssn1 $brncd1");
while ($rw1 = mysqli_fetch_array($da1))
{	
$bsl1=$rw1['sl'];
$bslar[]=$bsl1;
}
$ld=implode(",",$bslar);
$blno=array();
$data1232= mysqli_query($conn,"SELECT * FROM main_billing where sl>0 and cstat='1' $qry1 $bcd  ");
while ($row123= mysqli_fetch_array($data1232))
{	
$blno[]=$row123['blno'];
}
$blno1="";
if(count($blno)>0)
{
$blno1=implode(",",$blno);	
}
$amnt1=0;
$data1= mysqli_query($conn,"SELECT * FROM main_catg where sl>0 and sl!='3'");
while ($row1 = mysqli_fetch_array($data1))
{	

$cnm1=$row1['cnm'];
$catsl=$row1['sl'];
	
		$als="";
		$bsl=array();
		$data11= mysqli_query($conn,"SELECT * FROM main_billtype where sl>0 and inv_typ='77' and tp='2' and find_in_set('$catsl',brand)>0 $ssn1");
		while ($row11= mysqli_fetch_array($data11))
		{	
			$bsl[]=$row11['sl'];
			$als=$row11['als'];
		}
		$bsl=implode(",",$bsl);
		$amnt1=0;
		$data12= mysqli_query($conn,"SELECT sum(amm) as amnt1 FROM main_drcr where sl>0 and typ='77' and (cldgr='4' or cldgr='7') and dldgr!='5' and dldgr!='7'  and find_in_set(bill_typ,'$bsl')>0 $qry1 $brncd1");
		while ($row12= mysqli_fetch_array($data12))
		{	
		$amnt1=$row12['amnt1'];
		}
		if($amnt1==''){$amnt1=0;}
		$amnt2=0;
		$data123= mysqli_query($conn,"SELECT sum(net_am) as amnt2 FROM main_billdtls where sl>0 $qry1  and cat='$catsl' and find_in_set(bill_typ,'$ld')>0 and find_in_set(blno,'$blno1')=0");
		while ($row123= mysqli_fetch_array($data123))
		{	
		$amnt2=$row123['amnt2'];
		}
		if($amnt2==''){$amnt2=0;}
		$sbsl="";
		$sbsl=array();
		$data11s= mysqli_query($conn,"SELECT * FROM main_billtype where sl>0 and inv_typ='0' and tp='2' and find_in_set('$catsl',brand)>0 $ssn1");
		while ($row11= mysqli_fetch_array($data11s))
		{	
		$sbsl[]=$row11['sl'];		
		}
		$sbsl=implode(",",$sbsl);
		$dis_sale=0;
		$data1232= mysqli_query($conn,"SELECT sum(payam) as amnt2 FROM main_billing where sl>0 and find_in_set(bill_typ,'$sbsl')>0 and tp='2' and cstat='0' $qry1 $bcd  ");
		while ($row123= mysqli_fetch_array($data1232))
		{	
		$dis_sale=$row123['amnt2'];
		}
		if($dis_sale==''){$dis_sale=0;}
$TotAmnt=0;
$TotAmnt=$amnt1+$amnt2;
?>

<tr>
  <td ><?php echo $cnm1;?></td>
  <td align="right"><?php echo $dis_sale;?></td>  
  <td align="right"><?php echo $amnt1;?></td>  
  <td align="right"><?php echo $amnt2;?></td>  
  <td align="right"><?php echo $TotAmnt;?></td>
</tr>  
<?php 
 $Mtotamnt1=$Mtotamnt1+$amnt1;
 $Mtotamnt2=$Mtotamnt2+$amnt2;
 $Mtotamnt3=$Mtotamnt3+$TotAmnt;
 $tdis_sale=$dis_sale+$tdis_sale;
}
?>
<tr>
<td align="right">Total:</td>
<td align="right"><?php echo $tdis_sale;?></td>
<td align="right"><?php echo $Mtotamnt1;?></td>
<td align="right"><?php echo $Mtotamnt2;?></td>
<td align="right"><?php echo $Mtotamnt3;?></td>
</tr>
</table>
<br/>
<br/>
<br/>



<table width="50%" border="1">

<tr>
<th colspan="3" align="left" >
<font color="#000000" size="3">
Report 2 <?php echo $dt?> As On  <?php echo $fdt?> to <?php echo $tdt?>
</font>
</th>
</tr>
<tr>
  <td  >
 <font color="#000000"><b>SUPPLIER
</b></font>
  </td>
  <td >
  <font color="#000000"><b>DONE PAYMENT</b></font>
  </td>  
  <td >
  <font color="#000000"><b>SUPPLIER OS</b></font>
  </td>  

</tr>  

<?php 
$TT=0;
$data8= mysqli_query($conn,"SELECT * FROM main_suppl where sl>0");
while ($row8 = mysqli_fetch_array($data8))
{	
$supnm=$row8['spn'];
$supsl=$row8['sl'];
	

		
		$amnt4=0;
		$data12= mysqli_query($conn,"SELECT sum(amm) as amnt1 FROM main_drcr where sl>0 and sid='$supsl' and typ='88' $qry1 $brncd1");
		while ($row12= mysqli_fetch_array($data12))
		{	
		$amnt4=$row12['amnt1'];
		}
		if($amnt4==''){$amnt4=0;}

$data= mysqli_query($conn,"SELECT sum(amm) as t1 FROM main_drcr where stat='1' and dldgr='12' and sid='$supsl' and dt<='$tdt'".$brncd1);
while ($row = mysqli_fetch_array($data))
{
$t1 = $row['t1'];
}
$data1= mysqli_query($conn,"SELECT sum(amm) as t2 FROM main_drcr where stat='1' and  cldgr='12' and sid='$supsl' and dt<='$tdt' ".$brncd1);
while ($row1 = mysqli_fetch_array($data1))
{
$t2 = $row1['t2'];
}
$T=round($t2-$t1,2);

?>

<tr>
  <td ><?php echo $supnm;?></td>
  <td align="right"><?php echo $amnt4;?></td>  
  
  <td align="right"><?php echo $T;?></td>  

</tr>  
<?php 
$Mtotamnt4=$Mtotamnt4+$amnt4;
$TT+=$T;
}
?>
<tr>
<td align="right">Total:</td>
<td align="right"><?php echo $Mtotamnt4;?></td>
<td align="right"><?php echo $TT;?></td>
</tr>
</table>