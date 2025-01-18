<?php 
include("config.php");
date_default_timezone_set('Asia/Kolkata');
ini_set("memory_limit","780M");
set_time_limit(0);
$edt = date('d/m/Y h:i:s a', time());
$pno='0';
$dt=$_REQUEST['fdt'];
$dt1=$_REQUEST['tdt'];
$pno='';
$brncd=$_REQUEST['brncd'] ?? "";
if($brncd==""){$brncd1="";}else{$brncd1=" and brncd='$brncd'";}
if($dt=="" or $dt1=="")
{
echo 'false';
}
else
{
date_default_timezone_set('Asia/Kolkata');
$dt3 = date('y-m-d');
$pdt=date('Y-m-d', strtotime($dt));
$pdt1=date('Y-m-d', strtotime($dt1));

	$wrknm="All";
	$qry1=" sl>0 and (dt between '$pdt' and '$pdt1')  order by dt";
	



ob_start();


?>
<page backtop="5mm" >
 
        <table style="" border="1">

          <tr >
          <td colspan="2" align="center">
        <font size="4" ><b>Income & Expenditure A/c<br><?php echo $dt?> To  <?php echo $dt1?></b></font>
          </td>
		  </tr>
       
		<tr class="even">
            
            <td  align="center" ><font size="3" color="#000">I n c o m e</font></td>
			<td  align="center" ><font size="3" color="#000">E x p e n d i t u r e </font></td>
		</tr>
<tr bgcolor="#FFF">
<td  valign="top">
<table  >			
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
       
            <td  colspan="3"><font size="3" color="#1A4C80"><u><b><?php  echo $gnm; ?> :</b></u></font></td>

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
$query33 = "SELECT cldgr,sum(amm) as tot1 FROM main_drcr where cldgr='$ldgr' and ".$qry1."";
$result33 = mysqli_query($conn,$query33);
while ($R = mysqli_fetch_array ($result33))
{

$f6=$R['tot1'];
$gtot3=$gtot3+$f6;
		
}

$gtot2=$gtot2+$gtot3;
if($gtot3>0)
{
?>
 <tr >
       
            <td align="left" ><font size="3" color="#1A4C80"><?php  echo $gnm; ?></font></td>
			<td align="right" ><font size="3" color="#1A4C80"><font size="3" color="red">  Rs </font><?php  echo number_format($gtot3,2); ?></font></td>
			<td align="left" ><font size="3" color="#1A4C80"></font></td>
</tr>     

<?php 
}
else
{
	?>
	 <tr >
       
            <td align="left" ><font size="3" color="#1A4C80"></font></td>
			<td align="right" ><font size="3" color="#1A4C80"></font></td>
			<td align="left" ><font size="3" color="#1A4C80"></font></td>
</tr>
	<?php 
}

}
?>
 <tr >
<td align="right" colspan="3" style="border-bottom: 1px solid #000;border-top: 1px solid #000;"><font size="3" color="#1A4C80"><font size="3" color="red">  Rs </font><?php  echo number_format($gtot2,2); ?></font></td>		
</tr>
<?php 
$gtot1=$gtot1+$gtot2;
}
?>

<tr >
<td  align="right"><font size="4" color="BLACK"></font></td>
<td  align="right"><font size="4" color="BLACK"></font></td>
<td align="right"><font size="1" color="red"><b>__________</b></font></td>
</tr>
<tr >
<?php  $IT=$gtot1;?>
<td  align="right"><font size="4" color="BLACK"></font></td>
<td  align="right"><font size="4" color="BLACK"></font></td>
<td align="right"><font size="4" color="red"><B>  Rs <?php  echo number_format($gtot1,2); ?></B></font></td>
</tr>
  </table>
  </td>
  <td  valign="top">
<table >			
<?php 
$gtot1=0;
$data32= mysqli_query($conn,"SELECT * FROM main_group where pcd='8'");
while ($row32 = mysqli_fetch_array($data32))
	{
	$gcd = $row32['sl'];
	$gnm = $row32['nm'];
	
		?>
<tr >
       
            <td  colspan="3"><font size="3" color="#1A4C80"><u><b><?php  echo $gnm; ?> :</b></u></font></td>

</tr>	
	<?php 
			$gtot2=0;
		$data33= mysqli_query($conn,"SELECT * FROM main_ledg where gcd='$gcd'");
		while ($row33 = mysqli_fetch_array($data33))
		{
		$ldgr = $row33['sl'];
		$gnm = $row33['nm'];
			
$gtot3=0;
$query331 = "SELECT cldgr,sum(amm) as tot1 FROM main_drcr where dldgr='$ldgr' and ".$qry1."";
$result331 = mysqli_query($conn,$query331) or die (mysqli_error($conn));
while($R = mysqli_fetch_array($result331))
{
$f6=$R['tot1'];
$gtot3=$gtot3+$f6;
}

$gtot2=$gtot2+$gtot3;
if($gtot3>0)
{
?>
 <tr >
       
            <td align="left" ><font size="3" color="#1A4C80"><?php  echo $gnm; ?></font></td>
			<td align="right" ><font size="3" color="#1A4C80"><font size="3" color="red">  Rs </font><?php  echo number_format($gtot3,2); ?></font></td>
			<td align="left" ><font size="3" color="#1A4C80"></font></td>
</tr>      

<?php 
}
else
{
?>
	 <tr >
       
            <td align="left" ><font size="3" color="#1A4C80"></font></td>
			<td align="right" ><font size="3" color="#1A4C80"></font></td>
			<td align="left" ><font size="3" color="#1A4C80"></font></td>
</tr>
<?php 
}

}
?>
 <tr >
<td align="right" colspan="3" style="border-bottom: 1px solid #000;border-top: 1px solid #000;"><font size="3" color="#1A4C80"><font size="3" color="red">  Rs </font><?php  echo number_format($gtot2,2); ?></font></td>
		
</tr>
<?php 
$gtot1=$gtot1+$gtot2;
}
?>

<tr >
<td  align="right"><font size="4" color="BLACK"></font></td>
<td  align="right"><font size="4" color="BLACK"></font></td>
<td align="right"><font size="1" color="red"><B> __________ </B></font></td>
</tr>
<tr >
<?php  $ET=$gtot1;?>
<td  align="right"><font size="4" color="BLACK"></font></td>
<td  align="right"><font size="4" color="BLACK"></font></td>
<td align="right"><font size="4" color="red"><B>  Rs <?php  echo number_format($gtot1,2); ?></B></font></td>
</tr>
  </table>
  </td>
  </tr>
 <?php $T=$IT-$ET;
   if($T>=0)
   {
   $msg="Excess of Income over Expenditure";
   ?>
   <tr class="odd">
   <td align="left" style="border-bottom: 1px solid #FFF;border-top: 1px solid #FFF;">
   
  </td>
  <td align="right" style="border-bottom: 1px solid #FFF;border-top: 1px solid #FFF;"><font size="3" color="#1A4C80"><?php  echo $msg; ?></font>
  <font size="3" color="red"><B> Rs <?php  echo number_format($T,2); ?></B></font>
  </td>
  
  </tr>
  <tr class="even">
  <td align="right" style="border-bottom: 1px solid #000;border-top: 1px solid #000;">
   <font size="4" color="red"><B> Rs <?php  echo number_format($IT,2); ?></B></font>
  </td>
  <td align="right" style="border-bottom: 1px solid #000;border-top: 1px solid #000;">
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
	
  <td align="right" style="border-bottom: 1px solid #000;border-top: 1px solid #000;"><font size="3" color="#1A4C80"><?php  echo $msg; ?></font>
  <font size="3" color="red"><B>  Rs <?php  echo number_format($T,2); ?></B></font>
  </td>
  <td align="left">
  
  </td>
  </tr>
  <tr class="even" style="border-bottom: 1px solid #000;border-top: 1px solid #000;">
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
  </page>
<?php 

$file='inex';
		$content = ob_get_clean();
  		require_once('html2pdf/html2pdf.class.php');
		try
		{
        $html2pdf = new HTML2PDF('P', 'A4', 'en');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
   $html2pdf->Output($file.'.pdf','F');
	
		}
		catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
		}
		echo 'true';
		
}
?>
