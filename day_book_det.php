<?php 
$reqlevel=1;
include("membersonly.inc.php");
set_time_limit(0);
$pno='0';
$dt=$_REQUEST['fdt'];
$dt1=$_REQUEST['fdt'];
$pno=$_REQUEST['pno'] ?? "";$brncd=$_REQUEST['brncd'] ?? "";if($brncd==""){$brncd1="";}else{$brncd1=" and brncd='$brncd'";}

if($dt=="" or $dt1=="")
{
echo 'Please Enter Valid Date Range.'; 
}
else
{
date_default_timezone_set('Asia/Kolkata');
$dt3 = date('y-m-d');
$pdt=date('Y-m-d', strtotime($dt));
$pdt1=date('Y-m-d', strtotime($dt1));

if($pno!='0')
{
$data22= mysqli_query($conn,"SELECT * FROM main_project where sl='$pno'");
while ($row22 = mysqli_fetch_array($data22))
	{
	$wrknm = $row22['nm'];
	}
$qry1="  dt between '$pdt' and '$pdt1' $brncd1";

}
else
{	$wrknm="All";
	$qry1=" sl!='0' and dt between '$pdt' and '$pdt1' $brncd1";
	
}



?>

<input type="hidden" id="pno" name="pno" size="5" value="<?php  echo $pno; ?>" style="font-size: 12pt; text-align: left;color: #008000">
<input type="hidden" id="fdt" name="fdt" size="5" value="<?php  echo $dt; ?>" style="font-size: 12pt; text-align: left;color: #008000">
<input type="hidden" id="tdt" name="tdt" size="5" value="<?php  echo $dt1; ?>" style="font-size: 12pt; text-align: left;color: #008000">

<input type="hidden" id="ck" name="ck" size="5" value="" style="font-size: 12pt; text-align: left;color: #008000"></td>


 
        <table width="100%" border="1" class="advancedtable" align="center">
          <tr style="height: 30px;">
          <td colspan="4" align="center"><font>
         Day Book of <?php  echo $wrknm; ?><br> As On <?php echo $dt?></font>
          </td>
		  </tr>
    
		<tr class="even">
            
            <td width="50%"  align="center" ><font size="4" color="#000">I n c o m e</font></td>
			<td width="50%"  align="center" ><font size="4" color="#000">E x p e n d i t u r e </font></td>
		</tr>
<tr class="odd">
  <td align="center" width="50%" valign="top"><div id="sdtl1">
<table border="0"  width="100%">			
<?php 
$gtot1=0;
$cnt7=0;
$data32= mysqli_query($conn,"SELECT * FROM main_group where  pcd='7'");
while ($row32 = mysqli_fetch_array($data32))
	{
	$gcd = $row32['sl'];
	$gnm = $row32['nm'];
	?>
<tr >
       
            <td align="left" colspan="3"><font size="3" color="#000"><b><u><?php  echo $gnm; ?> :</b></u></font></td>

</tr>	
	<?php 
		$gtot2=0;
		$data33= mysqli_query($conn,"SELECT * FROM main_ledg where gcd='$gcd'");
		while ($row33 = mysqli_fetch_array($data33))
		{


		$cnt7++;
		$ldgr = $row33['sl'];
		$gnm = $row33['nm'];
		$ccc='';
	if($ldgr==-2)
{
	$ccc=" or dldgr='4'";
}			
$gtot3=0;
$query33 = "SELECT cldgr,sum(amm) as tot1 FROM main_drcr where cldgr='$ldgr' and".$qry1.$ccc." order by dt";
$result33 = mysqli_query($conn,$query33);
while ($R = mysqli_fetch_array ($result33))
{

$f6=$R['tot1'];
$gtot3=$gtot3+$f6;
		
}

$gtot2=$gtot2+$gtot3;
if($gtot3!=0)
{
?>
 <tr >
       
            <td align="left" colspan="3" width="100%"><b>
			<font size="3" color="red"><?php  echo $gnm; ?></font> : 
			<font size="3" color="red"><font size="3" color="#000">  Rs </font><?php  echo number_format($gtot3,2); ?></font></b>
			</td>
			
			
</tr> 

		
		  <tr>
            
			<td width="55%" align="left" background="images/tablebg.jpg"><font size="3" color="#00008B">Narration</font></td>
			<td width="25%" align="left" background="images/tablebg.jpg"><font size="3" color="#00008B">By.</font></td>
			<td width="20%" align="right" background="images/tablebg.jpg"><font size="3" color="#00008B">Amount(Rs)</font></td>
		 </tr>


<?php 
$ccc='';
if($ldgr==-2)
{
	$ccc=" or dldgr='4'";
}
$query33 = "SELECT *,sum(amm) as amm FROM main_drcr where cldgr='$ldgr' and".$qry1.$ccc." group by cbill order by dt";
$result33 = mysqli_query($conn,$query33);


		while ($R = mysqli_fetch_array ($result33))
{
		$gdt=$R['dt'];
		$gpno=$R['pno'];
		$gnrtn=$R['nrtn'];
		$gdldgr=$R['dldgr'];
		$gamm=$R['amm'];
		$cid=$R['cid'];
		$sid=$R['sid'];							
		$snm="";
		$cnm="";
if($cid=="")
{
	$query6="select * from  main_suppl where sl='$sid'";	
		$result5 = mysqli_query($conn,$query6);	
		while($Ree4=mysqli_fetch_array($result5))	
			{	
		$cnm="(".$Ree4['spn'].")";	
		}
	
}	
elseif($sid=="")
{
	$query6="select * from  main_cust where sl='$cid'";	
		$result5 = mysqli_query($conn,$query6);	
		while($Ree4=mysqli_fetch_array($result5))	
			{	
		$cnm="(".$Ree4['nm'].")";	
		}
}
else{
	$sid1="";
}
				
		
		
		
		
		
		
		
		
	if($gamm!=0)
		{
		$query41 = "SELECT * FROM main_ledg where sl='$gdldgr'";
		$result41 = mysqli_query($conn,$query41);
		while ($R1 = mysqli_fetch_array ($result41))
		{
		$gdldgr=$R1['nm'];
		}
		
		$query41 = "SELECT * FROM main_project where sl='$gpno'";
		$result41 = mysqli_query($conn,$query41);
		while ($R1 = mysqli_fetch_array ($result41))
		{
		$gpno=$R1['nm'];
		}
?>
<tr >
            
			<td  align="left" ><font size="2" color="#000"><?php echo $gnrtn;?></font></td>
			<td  align="left" ><font size="2" color="#000">
			<?php 
				echo $gdldgr;
			?>
			<?php echo $cnm;?></font></td>
			<td  align="right" ><font size="3" ><?php echo $gamm;?></font></td>
		 </tr>


<?php 
				
		}
}		

}

}
?>
 <tr >
       <td align="right" colspan="3"><font size="3" color="#000"><font size="3" color="#000">  Rs </font><?php  echo number_format($gtot2,2); ?></font></td>	
</tr>
<?php 
$gtot1=$gtot1+$gtot2;
}
?>

<tr >
<td align="right" colspan="3" width="100%"><font size="1" color="#000"><font size="4" color="black"><B> __________ </B></font></td>
</tr>
<tr >
<?php  $IT=$gtot1;?>
<td align="right" colspan="3" width="100%"><font size="4" color="#000"><font size="3" color="#000"><B>  Rs <?php  echo number_format($gtot1,2); ?></B></font></td>
</tr>
  </table>
</div>
  </td>
  <td align="center" width="50%" valign="top"><div id="sdtl1">
<table border="0"  width="100%">			
<?php 
$gtot1=0;
$data32= mysqli_query($conn,"SELECT * FROM main_group where  pcd='8'");
while ($row32 = mysqli_fetch_array($data32))
	{
	$gcd = $row32['sl'];
	$gnm = $row32['nm'];
	
		?>
<tr >
       
            <td align="left" colspan="3"><font size="3" color="#000"><b><u><?php  echo $gnm; ?> :</b></u></font></td>

</tr>	
	<?php 
$gtot2=0;
		$data33= mysqli_query($conn,"SELECT * FROM main_ledg where gcd='$gcd'");
		while ($row33 = mysqli_fetch_array($data33))
		{
		$ldgr = $row33['sl'];
		$gnm = $row33['nm'];
$ccc='';
if($ldgr==-3)
{
	$ccc=" or cldgr='12'";
}		
$gtot3=0;
$query33 = "SELECT cldgr,sum(amm) as tot1 FROM main_drcr where dldgr='$ldgr' and".$qry1.$ccc." order by dt";
$result33 = mysqli_query($conn,$query33);
while ($R = mysqli_fetch_array ($result33))
{

$f6=$R['tot1'];
$gtot3=$gtot3+$f6;
		
}

$gtot2=$gtot2+$gtot3;
if($gtot3!=0)
{
?>
 <tr >
       
            <td align="left" colspan="3" width="100%"><b>
			<font size="3" color="red"><?php  echo $gnm; ?></font> : 
			<font size="3" color="red"><font size="3" color="#000">  Rs </font><?php  echo number_format($gtot3,2); ?></font></b>
			</td>
		
			
</tr> 

		 
		
		<tr>
            
			<td width="55%" align="left" background="images/tablebg.jpg"><font size="3" color="#00008B">Narration1</font></td>
			<td width="25%" align="left" background="images/tablebg.jpg"><font size="3" color="#00008B">By.</font></td>
			<td width="20%" align="right" background="images/tablebg.jpg"><font size="3" color="#00008B">Amount(Rs)</font></td>
		 </tr>


<?php 
$ccc='';
if($ldgr==-3)
{
	$ccc=" or cldgr='12'";
}	
$query33 = "SELECT *,sum(amm) as amm FROM main_drcr where dldgr='$ldgr' and".$qry1.$ccc." group by sbill order by dt";
$result33 = mysqli_query($conn,$query33) or die (mysqli_error($conn));
while ($R = mysqli_fetch_array ($result33))
{
		$gdt=$R['dt'];
		$gpno=$R['pno'];
		$gnrtn=$R['nrtn'];
		$gdldgr=$R['dldgr'];
		$gamm=$R['amm'];
		$cid=$R['cid'];
		$sid=$R['sid'];
					$snm="";			
					$cnm="";	
					$query6="select * from  main_suppl where sl='$sid'";	
					$result5 = mysqli_query($conn,$query6);	
					while($Ree4=mysqli_fetch_array($result5))	
						{			
					$cnm="(".$Ree4['spn'].")";	
					}
		
		
	if($gamm!=0)
		{
		$query41 = "SELECT * FROM main_ledg where sl='$gdldgr'";
		$result41 = mysqli_query($conn,$query41);
		while ($R1 = mysqli_fetch_array ($result41))
		{
		$gdldgr=$R1['nm'];
		}
		
		$query41 = "SELECT * FROM main_project where sl='$gpno'";
		$result41 = mysqli_query($conn,$query41);
		while ($R1 = mysqli_fetch_array ($result41))
		{
		$gpno=$R1['nm'];
		}
?>
<tr >
           
			<td  align="left" ><font size="2" color="#000"><?php echo $gnrtn;?></font></td>
			<td  align="left" ><font size="2" color="#000"><?php echo $gdldgr;?><?php echo $spn;?><?php echo $cnm;?></font></td>
			<td  align="right" ><font size="3" color="#000"><?php echo $gamm;?></font></td>
		 </tr>


<?php 
				
		}
}
		
}}
?>
 <tr >
       
           
			<td align="right" colspan="3"><font size="3" color="#000"><font size="3" color="#000">  Rs </font><?php  echo number_format($gtot2,2); ?></font></td>
		
</tr>
<?php 
$gtot1=$gtot1+$gtot2;
}
?>

<tr >
<td align="right" colspan="3"><font size="1" color="#000"><font size="4" color="black"><B> __________ </B></font></td>
</tr>
<tr >
<?php  $ET=$gtot1;?>
<td align="right" colspan="3"><font size="4" color="#000"><font size="3" color="#000"><B>  Rs <?php  echo number_format($gtot1,2); ?></B></font></td>
</tr>
  </table>
</div>
  </td>
  </tr>
 <?php $T=$IT-$ET;
   if($T>=0)
   {
   $msg="Excess of Income over Expenditure";
   ?>
   <tr class="odd">
   <td align="left">
   
  </td>
  <td align="right"><font size="3" color="#000"><?php  echo $msg; ?></font>
  <font size="3" color="#000"><B> Rs <?php  echo number_format($T,2); ?></B></font>
  </td>
  
  </tr>
  <tr class="even">
  <td align="right">
   <font size="4" color="#000"><B> Rs <?php  echo number_format($IT,2); ?></B></font>
  </td>
  <td align="right">
  <font size="4" color="#000"><B> Rs <?php  echo number_format($T+$ET,2); ?></B></font>
  </td>
  
  </tr>
   
   <?php 
   }
   else
   { $T=$T*-1;
    $msg="Excess of Expenditure over Income";
	?>
	<tr class="odd">
	
  <td align="right"><font size="3" color="#000"><?php  echo $msg; ?></font>
  <font size="3" color="#000"><B>  Rs <?php  echo number_format($T,2); ?></B></font>
  </td>
  <td align="left">
  
  </td>
  </tr>
  <tr class="even">
   <td align="right">
   <font size="4" color="#000"><B> Rs <?php  echo number_format($T+$IT,2); ?></B></font>
  </td>
  <td align="right">
  <font size="4" color="#000"><B> Rs <?php  echo number_format($ET,2); ?></B></font>
  </td>
 
  </tr>
	
	<?php 
   }
 ?>
  
  
  
  <tr class="even">
       <td width="100%"  colspan="2" align="right" ><input type="submit" value=" Export to Excel "></td>
 </tr>
  
  


  </table>
<?php 
}
?>
