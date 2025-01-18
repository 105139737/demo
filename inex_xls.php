<?php 
$reqlevel = 1; 
include("membersonly.inc.php");
setlocale(LC_MONETARY, 'en_IN');
set_time_limit(0);
$pno='0';
$dt=$_REQUEST['fdt'];
$dt1=$_REQUEST['tdt'];
$pno=$_REQUEST['pno'] ?? "";
$brncd=$_REQUEST['brncd'] ?? "";if($brncd==""){$brncd1="";}else{$brncd1=" and brncd='$brncd'";}
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
$qry1=" pno='$pno' and dt between '$pdt' and '$pdt1' $brncd1 order by dt";

}
else
{	$wrknm="All";
	$qry1=" sl!='0' and dt between '$pdt' and '$pdt1' $brncd1 order by dt";
	
}

$file="Income & Expenditure A/c (".$dt." To ".$dt1.".xls";
header("Content-type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=$file"); 

?>
<input type="hidden" id="pno" name="pno" size="5" value="<?php  echo $pno; ?>" style="font-size: 12pt; text-align: left;color: #008000">
<input type="hidden" id="fdt" name="fdt" size="5" value="<?php  echo $dt; ?>" style="font-size: 12pt; text-align: left;color: #008000">
<input type="hidden" id="tdt" name="tdt" size="5" value="<?php  echo $dt1; ?>" style="font-size: 12pt; text-align: left;color: #008000">

<input type="hidden" id="ck" name="ck" size="5" value="" style="font-size: 12pt; text-align: left;color: #008000"></td>

<div align="left">
 
        <table width="900px" border="1"  align="center">

          <tr style="height: 30px;">
          <td colspan="2" align="center">
        <font size="4" ><b>Income & Expenditure A/c<br><?php echo $dt?> To  <?php echo $dt1?></b></font>
          </td>
		  </tr>
       
		<tr class="even">
            
            <td width="50%"  align="center" ><font size="3" color="#000">I n c o m e</font></td>
			<td width="50%"  align="center" ><font size="3" color="#000">E x p e n d i t u r e </font></td>
		</tr>
<tr bgcolor="#FFF">
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
       
            <td align="left" colspan="3"><font size="3" color="#1A4C80"><b><u><?php  echo $gnm; ?> :</b></u></font></td>

</tr>	
	<?php 
		$gtot2=0;
		$data33= mysqli_query($conn,"SELECT * FROM main_ledg where gcd='$gcd'");
		while ($row33 = mysqli_fetch_array($data33))
		{


		$cnt7++;
		$ldgr = $row33['sl'];
		$gnm = $row33['nm'];
				
$gtot3=0;
$query33 = "SELECT cldgr,sum(amm) as tot1 FROM main_drcr where cldgr='$ldgr' and".$qry1."";
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
       
            <td align="left"><font size="3" color="#1A4C80"><a href="#" onClick="show4('<?php  echo $ldgr;?>','<?php  echo $pdt;?>','<?php  echo $pdt1;?>','<?php  echo $pno;?>')"><?php  echo $gnm; ?></font></a></td>
			<td align="right"><font size="3" color="#1A4C80"><font size="3" color="red">  Rs </font><?php  echo number_format($gtot3,2); ?></font></td>
			<td align="left"><font size="3" color="#1A4C80"></font></td>
</tr> 

		<tr class="even">
         <td align="center" colspan="3"><div id="<?php  echo $ldgr; ?>">    </div></td>
		</tr>        

<?php 
}

}
?>
 <tr >
       
           
			<td align="right" colspan="3"><font size="3" color="#1A4C80"><font size="3" color="red">  Rs </font><?php  echo number_format($gtot2,2); ?></font></td>
		
</tr>
<?php 
$gtot1=$gtot1+$gtot2;
}
?>

<tr >
<td  align="right"><font size="4" color="BLACK"></font></td>
<td  align="right"><font size="4" color="BLACK"></font></td>
<td align="right"><font size="1" color="red"><font size="4" color="black"><B> __________ </B></font></td>
</tr>
<tr >
<?php  $IT=$gtot1;?>
<td  align="right"><font size="4" color="BLACK"></font></td>
<td  align="right"><font size="4" color="BLACK"></font></td>
<td align="right"><font size="4" color="red"><font size="3" color="red"><B>  Rs <?php  echo number_format($gtot1,2); ?></B></font></td>
</tr>
  </table>
</div>
  </td>
  <td align="center" width="50%" valign="top">
  <div id="sdtl1">
<table border="0" width="100%">			
<?php 
$gtot1=0;
$data32= mysqli_query($conn,"SELECT * FROM main_group where  pcd='8'");
while ($row32 = mysqli_fetch_array($data32))
	{
	$gcd = $row32['sl'];
	$gnm = $row32['nm'];
	
		?>
<tr >
       
            <td align="left" colspan="3"><font size="3" color="#1A4C80"><b><u><?php  echo $gnm; ?> :</b></u></font></td>

</tr>	
	<?php 
			$gtot2=0;
		$data33= mysqli_query($conn,"SELECT * FROM main_ledg where gcd='$gcd'");
		while ($row33 = mysqli_fetch_array($data33))
		{
		$ldgr = $row33['sl'];
		$gnm = $row33['nm'];
			
$gtot3=0;
$query33 = "SELECT cldgr,sum(amm) as tot1 FROM main_drcr where dldgr='$ldgr' and".$qry1."";
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
       
            <td align="left"><font size="3" color="#1A4C80"><a href="#" onClick="show3('<?php  echo $ldgr;?>','<?php  echo $pdt;?>','<?php  echo $pdt1;?>','<?php  echo $pno;?>')"><?php  echo $gnm; ?></font></a></td>
			<td align="right"><font size="3" color="#1A4C80"><font size="3" color="red">  Rs </font><?php  echo number_format($gtot3,2); ?></font></td>
			<td align="left"><font size="3" color="#1A4C80"></font></td>
</tr> 

		<tr class="even">
         <td align="center" colspan="3"><div id="<?php  echo $ldgr; ?>">    </div></td>
		</tr>        

<?php 
}}
?>
 <tr >
       
           
			<td align="right" colspan="3"><font size="3" color="#1A4C80"><font size="3" color="red">  Rs </font><?php  echo number_format($gtot2,2); ?></font></td>
		
</tr>
<?php 
$gtot1=$gtot1+$gtot2;
}
?>

<tr >
<td  align="right"><font size="4" color="BLACK"></font></td>
<td  align="right"><font size="4" color="BLACK"></font></td>
<td align="right"><font size="1" color="red"><font size="4" color="black"><B> __________ </B></font></td>
</tr>
<tr >
<?php  $ET=$gtot1;?>
<td  align="right"><font size="4" color="BLACK"></font></td>
<td  align="right"><font size="4" color="BLACK"></font></td>
<td align="right"><font size="4" color="red"><font size="3" color="red"><B>  Rs <?php  echo number_format($gtot1,2); ?></B></font></td>
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
  <td align="right"><font size="3" color="#1A4C80"><?php  echo $msg; ?></font>
  <font size="3" color="red"><B> Rs <?php  echo number_format($T,2); ?></B></font>
  </td>
  
  </tr>
  <tr class="even">
  <td align="right">
   <font size="4" color="red"><B> Rs <?php  echo number_format($IT,2); ?></B></font>
  </td>
  <td align="right">
  <font size="4" color="red"><B> Rs <?php  echo number_format($T+$ET,2); ?></B></font>
  </td>
  
  </tr>
   
   <?php 
   }
   else
   { $T=$T*-1;
    $msg="Excess of Expenditure over Income";
	?>
	<tr class="odd">
	
  <td align="right"><font size="3" color="#1A4C80"><?php  echo $msg; ?></font>
  <font size="3" color="red"><B>  Rs <?php  echo number_format($T,2); ?></B></font>
  </td>
  <td align="left">
  
  </td>
  </tr>
  <tr class="even">
   <td align="right">
   <font size="4" color="red"><B> Rs <?php  echo number_format($T+$IT,2); ?></B></font>
  </td>
  <td align="right">
  <font size="4" color="red"><B> Rs <?php  echo number_format($ET,2); ?></B></font>
  </td>
 
  </tr>
	
	<?php 
   }
 ?>
  
  
  

  
  


  </table>
  </div>
<?php 
}
?>