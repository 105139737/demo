<?php 
$reqlevel = 1; 
include("membersonly.inc.php");
$ledgnm=0;
$var="";
setlocale(LC_MONETARY, 'en_IN');
set_time_limit(0);
$fdt=$_REQUEST['fdt'] ?? "";
$tdt=$_REQUEST['tdt'] ?? "";
$ledg=$_REQUEST['ledg'] ?? "";
$cust=$_REQUEST['cust'] ?? "";
$sup=$_REQUEST['sup'] ?? "";
$pno=$_REQUEST['proj'] ?? "";
$brncd=$_REQUEST['brncd'] ?? "";if($brncd==""){$brncd1="";}else{$brncd1=" and brncd='$brncd'";}
if($cust!=""){$cqw=" and cid='$cust'";}else{$cqw="";}
if($sup!=""){$sqw=" and sid='$sup'";}else{$sqw="";}
if($pno!="0"){$pno1=" and pno='$pno'";}else{$pno1="";}

$file="Trail Balance Of ".$ledgnm.$var." (".$fdt." To ".$tdt.") .xls";
header("Content-type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=$file"); 

?>
<input type="hidden" id="ledg" name="ledg" size="5" value="<?php  echo $ledg; ?>" style="font-size: 12pt; text-align: left;color: #008000">
<input type="hidden" id="fdt" name="fdt" size="5" value="<?php  echo $fdt; ?>" style="font-size: 12pt; text-align: left;color: #008000">
<input type="hidden" id="tdt" name="tdt" size="5" value="<?php  echo $tdt; ?>" style="font-size: 12pt; text-align: left;color: #008000">
<?php 

$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));
		
		$prevdt = strtotime ( "- 1 day" , strtotime ( $fdt) ) ;
		$prevdt = date ( 'Y-m-d' , $prevdt );


$amm=0;


?>
<table width="900px" border="1" class="advancedtable">
        
          <tr class="even">
          <th colspan="4" align="center">
         <font color="#000"><b>Dr.</b></font>
          </th>
		  <th colspan="4" align="center">
          <font color="#000"><b>Cr.</b></font>
          </th>
		  </tr>
         
<tr class="odd">
<td align="center" width="50%%" colspan="4" valign="top">
<table border="0" width="100%">
<tr background="">
<td align="center" width="13%"> <font size="4">Date</td>

<td align="center" width="22%" > <font size="4">Ledger</td>
<td align="center" width="25%"> <font size="4">Narration</td>
<td align="center" width="25%"> <font size="4">Particulars</td>
<td align="center" width="15%"> <font size="4">Amount</td>
</tr>
<?php 
$sl=1;

$amm1=0;
$DR=0;
$f=0;

$query = "SELECT sum(amm) as amm1 FROM main_drcr where dt between '1970-01-01' and '$prevdt' and dldgr='$ledg'".$sqw.$cqw.$pno1.$brncd1;
$result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$amm1=$R['amm1'];
}
$DR=$DR+$amm1;

if($f%2==1)
{$clr="#D1A3FF";
 $fclr="#FFFAF0";
}
else
{$clr="#D5D5D2";
 $fclr="#1A4C80";
}
$f++;
if($amm1!=0)
{
							if($pno==0)
							{
								$poj="All";
							}
							else
							{
								
							
	$get = mysqli_query($conn,"SELECT * FROM main_project where sl='$pno'") or die(mysqli_error($conn));
							while($row = mysqli_fetch_array($get))
							{
							$poj=$row['nm'];
							}
							}

$f++;
?>
<tr bgcolor="<?php  echo $clr; ?>">
<td align="center"  valign="top"> <font size="2" color="red">Prev.</font></td>

<td align="center"  valign="top"> <font size="2" color="red"></font></td>
<td align="left"  valign="top"> <font size="2" color="red">Prev.</font></td>
<td align="right"  valign="top" > <font size="2" color="red"><b><?php echo $amm1;?></b></font></td>
</tr>
<?php 
}
$fdt1=date('Y-m-d', strtotime($fdt));
$tdt1=date('Y-m-d', strtotime($tdt));
$c=0;
$a='';
$p='0';
$query = "SELECT * FROM main_drcr where dldgr='$ledg' and dt between '$fdt1' and '$tdt1' $sqw $cqw $pno1 $brncd1 order by dt";
$result = mysqli_query($conn,$query);

while ($R = mysqli_fetch_array ($result))
{
$a=$R['cldgr'];
$c=$R['amm'];
$nrtn1=$R['nrtn'];
$ff1=$R['sl'];
$dndt=$R['dt'];
$pnod=$R['pno'];
$cid= $R['cid'];
$sid= $R['sid'];
		$cunm="";
		$query6="select * from  main_cust where sl='$cid'";
		$result5 = mysqli_query($conn,$query6);
		while($row=mysqli_fetch_array($result5))
		{
		$cnm=$row['nm'];
		}
		$snm="";
		$query6="select * from  main_suppl where sl='$sid'";
		$result5 = mysqli_query($conn,$query6);
		while($row=mysqli_fetch_array($result5))
		{
		$snm=$row['spn'];
		}
		$var1="";
		if($a==12 )
		{
			$var1=" : ".$snm."";
		}
		else
		{
			if($a==4 )
		{
			$var1=" : ".$cnm."";
		}
		else
		{
			$var1="";
		}
			
		}
$query3 = "SELECT * FROM main_ledg where sl='$a'";
$result3 = mysqli_query($conn,$query3);

while ($R3 = mysqli_fetch_array ($result3))
{
$ehnm=$R3['nm'];
}

if($f%2==1)
{$clr="#D1A3FF";
 $fclr="#FFFAF0";
}
else
{$clr="#D5D5D2";
 $fclr="#1A4C80";
}
if($c!=0)
{

								
							
	$get = mysqli_query($conn,"SELECT * FROM main_project where sl='$pnod'") or die(mysqli_error($conn));
							while($row = mysqli_fetch_array($get))
							{
							$poj=$row['nm'];
							}
					
$f++;
?>
<tr bgcolor="<?php  echo $clr; ?>">
<td align="center"  valign="top"><a title="Code : <?php echo $ff1;?>" style="cursor:pointer;"> <font size="2" color="<?php  echo $fclr; ?>"><?php echo $dndt;?></font></td>

<td align="center"  valign="top"> <font size="2" color="<?php  echo $fclr; ?>"><?php echo $ehnm.$var1;?></font></td>
<td align="center"  valign="top"> <font size="2" color="<?php  echo $fclr; ?>"><?php echo $nrtn1;?></font></td>
<td align="left"  valign="top"> <font size="2" color="<?php  echo $fclr; ?>">To. <?php echo $ehnm;?></font></td>
<td align="right"  valign="top"> <font size="2" color="<?php  echo $fclr; ?>"><b><?php echo number_format($c,2);?></b></font></td>
</tr>
<?php 
$DR=$DR+$c;
}
}


?>
</table>
</td>


<td align="center" width="50%%" colspan="4" valign="top">
<table border="0" width="100%">
<tr >
<td align="center" width="13%"> <font size="4">Date</td>

<td align="center" width="22%" > <font size="4">Ledger</td>
<td align="center" width="25%"> <font size="4">Narration</td>
<td align="center" width="25%"> <font size="4">Particulars</td>
<td align="center" width="15%"> <font size="4">Amount</td>
</tr>
<?php 
$sl=1;

$amm1=0;
$CR=0;
$f=0;
$query = "SELECT sum(amm) as amm1 FROM main_drcr where dt between '1970-01-01' and '$prevdt' and cldgr='$ledg'".$sqw.$cqw.$pno1.$brncd1;
$result = mysqli_query($conn,$query);

while ($R = mysqli_fetch_array ($result))
{
$amm1=$R['amm1'] ?? "";
}
$CR=$CR+$amm1;

if($f%2==1)
{$clr="#D1A3FF";
 $fclr="#FFFAF0";
}
else
{$clr="#D5D5D2";
 $fclr="#1A4C80";
}
$f++;
if($amm1!=0)
{
		if($pno==0)
							{
								$poj="All";
							}
							else
							{
								
							
	$get = mysqli_query($conn,"SELECT * FROM main_project where sl='$pno'") or die(mysqli_error($conn));
							while($row = mysqli_fetch_array($get))
							{
							$poj=$row['nm'];
							}
							}
$f++;
?>
<tr bgcolor="<?php  echo $clr; ?>">
<td align="center"  valign="top"> <font size="2" color="red">Prev.</font></td>


<td align="center"  valign="top"> <font size="2" color="red"></font></td>
<td align="left"  valign="top"> <font size="2" color="red">Prev.</font></td>
<td align="right"  valign="top" > <font size="2" color="red"><b><?php echo $amm1;?></b></font></td>
</tr>
<?php 
}
$fdt1=date('Y-m-d', strtotime($fdt));
$tdt1=date('Y-m-d', strtotime($tdt));

$c=0;
$a='';
$p='0';
$query = "SELECT * FROM main_drcr where  cldgr='$ledg' and dt between '$fdt' and '$tdt' $sqw $cqw $pno1 $brncd1 order by dt";
$result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{

$a=$R['dldgr'];
$c=$R['amm'];
$nrtn1=$R['nrtn'];
$ff1=$R['sl'];
$dndt=$R['dt'];
$pnod1=$R['pno'];
		$cid= $R['cid'];
		$sid= $R['sid'];
		$cunm="";
		$query6="select * from  main_cust where sl='$cid'";
		$result5 = mysqli_query($conn,$query6);
		while($row=mysqli_fetch_array($result5))
		{
		$cnm=$row['nm'];
		}
		$snm="";
		$query6="select * from  main_suppl where sl='$sid'";
		$result5 = mysqli_query($conn,$query6);
		while($row=mysqli_fetch_array($result5))
		{
		$snm=$row['spn'];
		}
		$var="";
		if($a==12)
		{
			$var=" : ".$snm."";
		}
		else
		{
			if($a==4)
		{
			$var=" : ".$cnm."";
		}
		else
		{
			$var="";
		}
			
		}
$query3 = "SELECT * FROM main_ledg where sl='$a'";
$result3 = mysqli_query($conn,$query3);

while ($R3 = mysqli_fetch_array ($result3))
{
$ehnm=$R3['nm'];
}

if($f%2==1)
{$clr="#D1A3FF";
 $fclr="#FFFAF0";
}
else
{$clr="#D5D5D2";
 $fclr="#1A4C80";
}
if($c!=0)
{
	
								
							
	$get = mysqli_query($conn,"SELECT * FROM main_project where sl='$pnod1'") or die(mysqli_error($conn));
							while($row = mysqli_fetch_array($get))
							{
							$poj=$row['nm'];
							}
						
$f++;
?>
<tr bgcolor="<?php  echo $clr; ?>">
<td align="center"  valign="top"><a title="Code : <?php echo $ff1;?>" style="cursor:pointer;"> <font size="2" color="<?php  echo $fclr; ?>"><?php echo $dndt;?></font></td>

<td align="center"  valign="top"> <font size="2" color="<?php  echo $fclr; ?>"><?php echo $ehnm.$var;?></font></td>
<td align="center"  valign="top"> <font size="2" color="<?php  echo $fclr; ?>"><?php echo $nrtn1;?></font></td>
<td align="left"  valign="top"> <font size="2" color="<?php  echo $fclr; ?>">By. <?php echo $ehnm;?></font></td>
<td align="right"  valign="top"> <font size="2" color="<?php  echo $fclr; ?>"><b><?php echo number_format($c,2);?></b></font></td>
</tr>
<?php 
$CR=$CR+$c;
}
}

$NT=0;
$Dfrd=0;
$CFrd=0;
$TOT=0;
$NT=$CR-$DR;
if($NT>=0)
{
$DFrd=$NT;
$TOT=$CR;
}
else
{
$CFrd=$NT*-1;
$TOT=$DR;
}


?>
</table>
</td>
</tr>
<?php 
if($DFrd==0)
{
?>
<tr class="odd">
<td width="50%" align="left" colspan="4"> </td>
<td width="37%" align="right" colspan="3"> <font size="4">By Balance c/d </font></td>
<td width="13%" align="right"> <font size="4"><b><?php echo number_format($CFrd,2);?></b></font></td>
</tr>
<?php 
}
else
{
?>
<tr class="odd">
<td width="37%" align="right" colspan="3"> <font size="4">By Balance f/d </font></td>
<td width="13%" align="right"> <font size="4"><b><?php echo number_format($DFrd,2);?></b></font></td>
<td width="50%" align="right" colspan="4"> </td>
</tr>
<?php 
}
?>

<tr class="odd">
<td width="50%" align="right" colspan="4"> <font size="3" color="red"><?php echo number_format($TOT,2);?></font></td>
<td width="50%" align="right" colspan="4"> <font size="3" color="red"><?php echo number_format($TOT,2);?></font></td>
</tr>

</table>
