<?php 
$reqlevel = 1; 
include("membersonly.inc.php");
setlocale(LC_MONETARY, 'en_IN');
set_time_limit(0);
$brncd=$_REQUEST['brncd'] ?? "";if($brncd==""){$brncd1="";}else{$brncd1=" and brncd='$brncd'";}
$dt=$_REQUEST['fdt'];
$dt1=$_REQUEST['tdt'];
$pno=$_REQUEST['pno'] ?? "";
$msg='';
if($dt=="" or $dt1=="")
{
$msg='Please Enter Valid Date Range.';
}

if($msg!="")
{
echo $msg;
}
else
{
date_default_timezone_set('Asia/Kolkata');
$dt3 = date('y-m-d');
$pdtf=date('Y-m-d', strtotime($dt));
$pdt=date('Y-m-d', strtotime($dt1));


if($pno!='0')
{
$data22= mysqli_query($conn,"SELECT * FROM main_project where sl='$pno'");
while ($row22 = mysqli_fetch_array($data22))
	{
	$wrknm = $row22['nm'];

	}
$qry1=" pno='$pno' $brncd1";

}
else
{	$wrknm="";
	$qry1=" sl!='0' $brncd1";
	
}


$file="Balance Sheet (".$dt." To ".$dt1.".xls";
header("Content-type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=$file"); 

?>

<input type="hidden" id="pno" name="pno" size="5" value="<?php  echo $pno; ?>" style="font-size: 12pt; text-align: left;color: #008000">
<input type="hidden" id="fdt" name="fdt" size="5" value="<?php  echo $dt; ?>" style="font-size: 12pt; text-align: left;color: #008000">
<input type="hidden" id="tdt" name="tdt" size="5" value="<?php  echo $dt1; ?>" style="font-size: 12pt; text-align: left;color: #008000">

<input type="hidden" id="ck" name="ck" size="5" value="" style="font-size: 12pt; text-align: left;color: #008000"></td>

<div align="left">
 
        <table width="900px" border="1"  >
		
          <tr >
          <td colspan="2" align="center">
      <font size="4"> Balance Sheet<br> as at  <?php echo $dt1?></font>
          </td>
		  </tr>
         
		  <tr class="even">
            <td width="50%"  align="center" ><font size="3" color="#000">L i a b i l i t i e s </font></td>
            <td width="50%"  align="center" ><font size="3" color="#000">A s s e t s </font></td>
		  </tr>
<tr class="odd">
<td valign="top" align="center" width="50%"><div id="sdtl1">
<table width="100%" >
		
<tr>
            <td width="100%" align="left" colspan="3"><font size="3" color="blue">C A P I T A L &nbsp;&nbsp; A / C</font></td>
</tr>		
<?php 
$gtot1=0;
$data32= mysqli_query($conn,"SELECT * FROM main_group where pcd='1'");
while ($row32 = mysqli_fetch_array($data32))
	{
	$gcd = $row32['sl'];
	$gnm = $row32['nm'];
	
			$gtot2=0;
		$data33= mysqli_query($conn,"SELECT * FROM main_ledg where gcd='$gcd'");
		while ($row33 = mysqli_fetch_array($data33))
		{
		$ldgr = $row33['sl'];
		$gnm1 = $row33['nm'];

		
		$gtot3=0;
		$query31 = "SELECT sum(amm) as dbt FROM main_drcr where dldgr='$ldgr' and dt between '1970-01-01' and '$pdt' and".$qry1."";
		$result31 = mysqli_query($conn,$query31);
		while ($R1 = mysqli_fetch_array ($result31))
		{
		$dbt=$R1['dbt'];
		}
		
		
		
		$query32 = "SELECT sum(amm) as cdt FROM main_drcr where  cldgr='$ldgr' and dt between '1970-01-01' and '$pdt' and".$qry1."";
		$result32 = mysqli_query($conn,$query32);
		while ($R2 = mysqli_fetch_array ($result32))
		{
		$cdt=$R2['cdt'];
		}
		
		$gtot3=$cdt-$dbt;

if($gtot3!='0')
{
if($gtot2==0)
{
?>
<tr >
	<td align="left"><font size="3" color="#1A4C80"><u><b><?php  echo $gnm; ?> :</b></u></font></td>
</tr>
<?php 
}

?>
<tr >
       
            <td align="left"><font size="3" color="#1A4C80"><a href="#" onclick="showbl('<?php  echo $ldgr;?>','<?php  echo $pdtf;?>','<?php  echo $pdt;?>','<?php  echo $pno;?>',event)"><?php  echo $gnm1; ?></a></font></td>
			<td align="right"><font size="3" color="#1A4C80"><font size="3" color="red">  Rs </font><?php  echo number_format($gtot3,2,'.',''); ?></font></td>
			<td align="left"><font size="3" color="#1A4C80">&nbsp;</font></td>
</tr>
          
<?php 
}		
$ET1=$gtot2+$gtot3;

}
if($gtot2!='0')
{
?>
		<tr >
<td  align="right"><font size="4" color="BLACK"></font></td>
<td  align="right"><font size="4" color="BLACK"></font></td>
<td align="right"><font size="4" color="black"><B> __________ </B></font></td>
</tr>
<tr >
<td  align="right"><font size="4" color="BLACK"></font></td>
<td  align="right"><font size="4" color="BLACK"></font></td>
<td align="right"><font size="3" color="red"><B>  Rs <?php  echo number_format($gtot2,2,'.',''); ?></B></font></td>
</tr>
		<tr >
       
         <td align="center" colspan="3"><div id="<?php  echo $gcd; ?>">    </div></td>
			
		 </tr>
<?php 
}
$gtot1=$gtot1+$gtot2;
}
?>
<?php  $ET1=$gtot1;?>
<tr >
<td  align="right"><font size="4" color="BLACK"></font></td>
<td  align="right"><font size="4" color="BLACK"></font></td>
<td align="right">===================</td>
</tr>

<tr>
            <td width="100%" align="left" colspan="3"><font size="3" color="blue">L O A N S</font></td>
</tr>		
<?php 
$gtot1=0;
$data32= mysqli_query($conn,"SELECT * FROM main_group where pcd='2'");
while ($row32 = mysqli_fetch_array($data32))
	{
	$gcd = $row32['sl'];
	$gnm = $row32['nm'];
	
			$gtot2=0;
		$data33= mysqli_query($conn,"SELECT * FROM main_ledg where gcd='$gcd'");
		while ($row33 = mysqli_fetch_array($data33))
		{
		$ldgr = $row33['sl'];
		$gnm1 = $row33['nm'];

		
		$gtot3=0;
		$query31 = "SELECT sum(amm) as dbt FROM main_drcr where dldgr='$ldgr' and dt between '1970-01-01' and '$pdt' and".$qry1."";
		$result31 = mysqli_query($conn,$query31);
		while ($R1 = mysqli_fetch_array ($result31))
		{
		$dbt=$R1['dbt'];
		}
		
		
		
		$query32 = "SELECT sum(amm) as cdt FROM main_drcr where  cldgr='$ldgr' and dt between '1970-01-01' and '$pdt' and".$qry1."";
		$result32 = mysqli_query($conn,$query32);
		while ($R2 = mysqli_fetch_array ($result32))
		{
		$cdt=$R2['cdt'];
		}
		
		$gtot3=$cdt-$dbt;

if($gtot3!='0')
{
if($gtot2==0)
{
?>
<tr >
	<td align="left"><font size="3" color="#1A4C80"><u><b><?php  echo $gnm; ?> :</b></u></font></td>
</tr>
<?php 
}

?>
<tr >
       
            <td align="left"><font size="3" color="#1A4C80"><a href="#" onclick="showbl('<?php  echo $ldgr;?>','<?php  echo $pdtf;?>','<?php  echo $pdt;?>','<?php  echo $pno;?>',event)"><?php  echo $gnm1; ?></a></font></td>
			<td align="right"><font size="3" color="#1A4C80"><font size="3" color="red">  Rs </font><?php  echo number_format($gtot3,2,'.',''); ?></font></td>
			<td align="left"><font size="3" color="#1A4C80">&nbsp;</font></td>
</tr>
          
<?php 
}		
$gtot2=$gtot2+$gtot3;

}
if($gtot2!='0')
{
?>
		<tr >
<td  align="right"><font size="4" color="BLACK"></font></td>
<td  align="right"><font size="4" color="BLACK"></font></td>
<td align="right"><font size="4" color="black"><B> __________ </B></font></td>
</tr>
<tr >
<td  align="right"><font size="4" color="BLACK"></font></td>
<td  align="right"><font size="4" color="BLACK"></font></td>
<td align="right"><font size="3" color="red"><B>  Rs <?php  echo number_format($gtot2,2,'.',''); ?></B></font></td>
</tr>
		<tr >
       
         <td align="center" colspan="3"><div id="<?php  echo $gcd; ?>">    </div></td>
			
		 </tr>
<?php 
}
$gtot1=$gtot1+$gtot2;
}
?>
<?php  $ET2=$gtot1;?>
<tr >
<td  align="right"><font size="4" color="BLACK"></font></td>
<td  align="right"><font size="4" color="BLACK"></font></td>
<td align="right">===================</td>
</tr>

<tr>
            <td width="100%" align="left" colspan="3"><font size="3" color="blue">L I A B I L I T I E S</font></td>
</tr>		
<?php 
$gtot1=0;
$data32= mysqli_query($conn,"SELECT * FROM main_group where pcd='3'");
while ($row32 = mysqli_fetch_array($data32))
	{
	$gcd = $row32['sl'];
	$gnm = $row32['nm'];
	
			$gtot2=0;
		$data33= mysqli_query($conn,"SELECT * FROM main_ledg where gcd='$gcd'");
		while ($row33 = mysqli_fetch_array($data33))
		{
		$ldgr = $row33['sl'];
		$gnm1 = $row33['nm'];

		
		$gtot3=0;
		$query31 = "SELECT sum(amm) as dbt FROM main_drcr where dldgr='$ldgr' and dt between '1970-01-01' and '$pdt' and".$qry1."";
		$result31 = mysqli_query($conn,$query31);
		while ($R1 = mysqli_fetch_array ($result31))
		{
		$dbt=$R1['dbt'];
		}
		
		
		
		$query32 = "SELECT sum(amm) as cdt FROM main_drcr where  cldgr='$ldgr' and dt between '1970-01-01' and '$pdt' and".$qry1."";
		$result32 = mysqli_query($conn,$query32);
		while ($R2 = mysqli_fetch_array ($result32))
		{
		$cdt=$R2['cdt'];
		}
		
		$gtot3=$cdt-$dbt;

if($gtot3!='0')
{
if($gtot2==0)
{
?>
<tr >
	<td align="left"><font size="3" color="#1A4C80"><u><b><?php  echo $gnm; ?> :</b></u></font></td>
</tr>
<?php 
}

?>
<tr >
       
            <td align="left"><font size="3" color="#1A4C80"><a href="#" onclick="showbl('<?php  echo $ldgr;?>','<?php  echo $pdtf;?>','<?php  echo $pdt;?>','<?php  echo $pno;?>',event)"><?php  echo $gnm1; ?></a></font></td>
			<td align="right"><font size="3" color="#1A4C80"><font size="3" color="red">  Rs </font><?php  echo number_format($gtot3,2,'.',''); ?></font></td>
			<td align="left"><font size="3" color="#1A4C80">&nbsp;</font></td>
</tr>
          
<?php 
}		
$gtot2=$gtot2+$gtot3;

}
if($gtot2!='0')
{
?>
		<tr >
<td  align="right"><font size="4" color="BLACK"></font></td>
<td  align="right"><font size="4" color="BLACK"></font></td>
<td align="right"><font size="4" color="black"><B> __________ </B></font></td>
</tr>
<tr >
<td  align="right"><font size="4" color="BLACK"></font></td>
<td  align="right"><font size="4" color="BLACK"></font></td>
<td align="right"><font size="3" color="red"><B>  Rs <?php  echo number_format($gtot2,2,'.',''); ?></B></font></td>
</tr>
		<tr >
       
         <td align="center" colspan="3"><div id="<?php  echo $gcd; ?>">    </div></td>
			
		 </tr>
<?php 
}
$gtot1=$gtot1+$gtot2;
}
?>
<?php  $ET3=$gtot1;?>
<tr >
<td  align="right"><font size="4" color="BLACK"></font></td>
<td  align="right"><font size="4" color="BLACK"></font></td>
<td align="right">===================</td>
</tr>


<tr >
<td  align="right"><font size="4" color="BLACK"></font></td>
<td  align="right"><font size="4" color="BLACK"></font></td>
<td align="right"><font size="3" color="red"><B>  Rs <?php  echo number_format($ET3,2,'.',''); ?></B></font></td>
</tr>
 </table>
</div>
  </td>
  
  
  
  
<td align="center" Valign="TOP" width="50%"><div id="sdtl1">
<table width="100%" border="0" >
			
<tr>
            <td width="100%" align="left" colspan="3"><font size="3" color="blue">C U R R E N T &nbsp;&nbsp; A S S E T S</font></td>
</tr>
<?php 
$gtot1=0;
$data32= mysqli_query($conn,"SELECT * FROM main_group where pcd='5'");
while ($row32 = mysqli_fetch_array($data32))
	{
	$gcd = $row32['sl'];
	$gnm = $row32['nm'];
	
			$gtot2=0;
		$data33= mysqli_query($conn,"SELECT * FROM main_ledg where gcd='$gcd'");
		while ($row33 = mysqli_fetch_array($data33))
		{
		$ldgr = $row33['sl'];
		$gnm1 = $row33['nm'];

		
		$gtot3=0;
		$query31 = "SELECT sum(amm) as dbt FROM main_drcr where dldgr='$ldgr' and dt between '1970-01-01' and '$pdt' and".$qry1."";
		$result31 = mysqli_query($conn,$query31);
		while ($R1 = mysqli_fetch_array ($result31))
		{
		$dbt=$R1['dbt'];
		}
		
		
		
		$query32 = "SELECT sum(amm) as cdt FROM main_drcr where  cldgr='$ldgr' and dt between '1970-01-01' and '$pdt' and".$qry1."";
		$result32 = mysqli_query($conn,$query32);
		while ($R1 = mysqli_fetch_array ($result32))
		{
		$cdt=$R1['cdt'];
		}
		$gtot3=$dbt-$cdt;

if($gtot3!='0')
{
if($gtot2==0)
{
?>
<tr >
	<td align="left"><font size="3" color="#1A4C80"><u><b><?php  echo $gnm; ?> :</b></u></font></td>
</tr>
<?php 
}

?>
<tr >
       
            <td align="left"><font size="3" color="#1A4C80"><a href="#" onclick="showbl('<?php  echo $ldgr;?>','<?php  echo $pdtf;?>','<?php  echo $pdt;?>','<?php  echo $pno;?>',event)"><?php  echo $gnm1; ?></a></font></td>
			<td align="right"><font size="3" color="#1A4C80"><font size="3" color="red">  Rs </font><?php  echo number_format($gtot3,2,'.',''); ?></font></td>
			<td align="left"><font size="3" color="#1A4C80">&nbsp;</font></td>
</tr>
          
<?php 
}		
$gtot2=$gtot2+$gtot3;

}
if($gtot2!='0')
{
?>
		<tr >
<td  align="right"><font size="4" color="BLACK"></font></td>
<td  align="right"><font size="4" color="BLACK"></font></td>
<td align="right"><font size="4" color="black"><B> __________ </B></font></td>
</tr>
<tr >
<td  align="right"><font size="4" color="BLACK"></font></td>
<td  align="right"><font size="4" color="BLACK"></font></td>
<td align="right"><font size="3" color="red"><B>  Rs <?php  echo number_format($gtot2,2,'.',''); ?></B></font></td>
</tr>
		<tr >
       
         <td align="center" colspan="3"><div id="<?php  echo $gcd; ?>">    </div></td>
			
		 </tr>
<?php 
}
$gtot1=$gtot1+$gtot2;
}
?>
<?php  $IT1=$gtot1;?>
<tr >
<td  align="right"><font size="4" color="BLACK"></font></td>
<td  align="right"><font size="4" color="BLACK"></font></td>
<td align="right">===================</td>
</tr>
<tr >
<td  align="right"><font size="4" color="BLACK"></font></td>
<td  align="right"><font size="4" color="BLACK"></font></td>
<td align="right"><font size="3" color="red"><B>  Rs <?php  echo number_format($IT1,2,'.',''); ?></B></font></td>
</tr>
		
<tr>
            <td width="100%" align="left" colspan="3"><font size="3" color="blue">F I X E D &nbsp;&nbsp; A S S E T S</font></td>
</tr>
<?php 
$gtot1=0;
$data32= mysqli_query($conn,"SELECT * FROM main_group where pcd='4'");
while ($row32 = mysqli_fetch_array($data32))
	{
	$gcd = $row32['sl'];
	$gnm = $row32['nm'];
	
			$gtot2=0;
		$data33= mysqli_query($conn,"SELECT * FROM main_ledg where gcd='$gcd'");
		while ($row33 = mysqli_fetch_array($data33))
		{
		$ldgr = $row33['sl'];
		$gnm1 = $row33['nm'];

		
		$gtot3=0;
		$query31 = "SELECT sum(amm) as dbt FROM main_drcr where dldgr='$ldgr' and dt between '1970-01-01' and '$pdt' and".$qry1."";
		$result31 = mysqli_query($conn,$query31);
		while ($R1 = mysqli_fetch_array ($result31))
		{
		$dbt=$R1['dbt'];
		}
		
		
		
		$query32 = "SELECT sum(amm) as cdt FROM main_drcr where  cldgr='$ldgr' and dt between '1970-01-01' and '$pdt' and".$qry1."";
		$result32 = mysqli_query($conn,$query32);
		while ($R1 = mysqli_fetch_array ($result32))
		{
		$cdt=$R1['cdt'];
		}
		$gtot3=$dbt-$cdt;

if($gtot3!='0')
{
if($gtot2==0)
{
?>
<tr >
	<td align="left"><font size="3" color="#1A4C80"><u><b><?php  echo $gnm; ?> :</b></u></font></td>
</tr>
<?php 
}

?>
<tr >
       
            <td align="left"><font size="3" color="#1A4C80"><a href="#" onclick="showbl('<?php  echo $ldgr;?>','<?php  echo $pdtf;?>','<?php  echo $pdt;?>','<?php  echo $pno;?>',event)"><?php  echo $gnm1; ?></a></font></td>
			<td align="right"><font size="3" color="#1A4C80"><font size="3" color="red">  Rs </font><?php  echo number_format($gtot3,2,'.',''); ?></font></td>
			<td align="left"><font size="3" color="#1A4C80">&nbsp;</font></td>
</tr>
          
<?php 
}		
$gtot2=$gtot2+$gtot3;

}
if($gtot2!='0')
{
?>
		<tr >
<td  align="right"><font size="4" color="BLACK"></font></td>
<td  align="right"><font size="4" color="BLACK"></font></td>
<td align="right"><font size="4" color="black"><B> __________ </B></font></td>
</tr>
<tr >
<td  align="right"><font size="4" color="BLACK"></font></td>
<td  align="right"><font size="4" color="BLACK"></font></td>
<td align="right"><font size="3" color="red"><B>  Rs <?php  echo number_format($gtot2,2,'.',''); ?></B></font></td>
</tr>
		<tr >
       
         <td align="center" colspan="3"><div id="<?php  echo $gcd; ?>">    </div></td>
			
		 </tr>
<?php 
}
$gtot1=$gtot1+$gtot2;
}
?>
<?php  $IT2=$gtot1;?>
<tr >
<td  align="right"><font size="4" color="BLACK"></font></td>
<td  align="right"><font size="4" color="BLACK"></font></td>
<td align="right">===================</td>
</tr>
<tr >
<td  align="right"><font size="4" color="BLACK"></font></td>
<td  align="right"><font size="4" color="BLACK"></font></td>
<td align="right"><font size="3" color="red"><B>  Rs <?php  echo number_format($IT2,2,'.',''); ?></B></font></td>
</tr>



  </table>
</div>
  </td>
  </tr>
  <?php  $ET=$ET1+$ET2+$ET3;
	 $IT=$IT1+$IT2;
   include("inex_cal.php");
   
   $cp=$T;
   $obal=$IT-($ET+$cp);
   $fundtot=$cp+$obal;
   ?>
  <tr class="odd">
  <td align="right">
  <table width="100%" border="0" >
 
<tr>
            <td width="100%" align="left" colspan="3"><font size="3" color="#1A4C80"><u><b>C a p i t a l &nbsp; F u n d :</b></u></font></td>
</tr>
   
  <tr >
	<td align="left"><font size="3" color="#1A4C80">As per last A/c </font></td>
	<td align="right"><font size="3" color="#1A4C80"><font size="3" color="red">Rs </font> <?php  echo number_format($obal,2,'.',''); ?></B></font></td>
	<td  align="right"><font size="4" color="BLACK"></font></td>   
   </tr>
  
  <tr>
  <td align="left"><font size="3" color="#1A4C80">Current Period </font></td>
  <td align="right"><font size="3" color="#1A4C80"><font size="3" color="red">Rs </font><?php  echo number_format($cp,2,'.',''); ?></B></font></td>
  <td  align="right"><font size="4" color="BLACK"></font></td>
  </tr>
  <tr >
<td  align="right"><font size="4" color="BLACK"></font></td>
<td  align="right"><font size="4" color="BLACK"></font></td>
<td align="right">===================</td>
</tr>
<tr >
<td  align="right"><font size="4" color="BLACK"></font></td>
<td  align="right"><font size="4" color="BLACK"></font></td>
<td align="right"><font size="3" color="red"><B>  Rs <?php  echo number_format($fundtot,2,'.',''); ?></B></font></td>
</tr>
  </table>
  </td>
  <td align="right">
 
  </td>
 
  </tr>
  <tr class="even">
  <td align="right">
  <font size="4" color="red"><B>  Rs <?php  echo number_format($IT,2,'.',''); ?></B></font>
  </td>
  <td align="right">
  <font size="4" color="red"><B>  Rs <?php  echo number_format($IT,2,'.',''); ?></B></font>
  </td>
  </tr>
   
  
</div>

  </table>


<?php 
}?>
