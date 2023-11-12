<?
require("config.php");
function parseToXML($htmlStr)
{
$xmlStr=str_replace('<','&lt;',$htmlStr);
$xmlStr=str_replace('>','&gt;',$xmlStr);
$xmlStr=str_replace('"','&quot;',$xmlStr);
$xmlStr=str_replace("'",'&#39;',$xmlStr);
$xmlStr=str_replace("&",'&amp;',$xmlStr);
return $xmlStr;
}
//header("Content-type: text/xml");
set_time_limit(0);
$pno='0';
$dt=$_REQUEST[fdt];
$dt1=$_REQUEST[tdt];
$pno=$_REQUEST[pno];
$brncd=$_REQUEST[brncd];if($brncd==""){$brncd1="";}else{$brncd1=" and brncd='$brncd'";}
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


//echo '<markers>';
$gtot1=0;
$cnt7=0;
$data32= mysqli_query($conn,"SELECT * FROM main_group where  pcd='7'");
while ($row32 = mysqli_fetch_array($data32))
	{
	$gcd = $row32['sl'];
	$gnm = $row32['nm'];
	//echo '<marker ';
	// echo 'Income_head="' . parseToXML($gnm) . '" ';
	  //echo '/>';
		$gtot2=0;
		$data33= mysqli_query($conn,"SELECT * FROM main_ledg where gcd='$gcd'");
		while ($row33 = mysqli_fetch_array($data33))
		{


		$cnt7++;
		$ldgr = $row33['sl'];
		$gnm1 = $row33['nm'];
				
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
	//echo '<marker ';
	// echo 'Income_head_sub="' . parseToXML($gnm1) . '" ';
	// echo 'Income_head_sub_value="' . parseToXML($gtot3) . '" ';
	  //echo '/>';
}

}
//echo '<marker ';
	// echo 'Income_head_sub_value_ttl="' . parseToXML($gtot2) . '" ';
	  //echo '/>';
$gtot1=$gtot1+$gtot2;
}
$IT=$gtot1;
//echo '<marker ';
	// echo 'Income_head_sub_value_gttl="' . parseToXML($gtot1) . '" ';
	  //echo '/>';
?>
<table border="1" width="100%">			
<?
$gtot1=0;
$data32t= mysqli_query($conn,"SELECT * FROM main_group where  pcd='8'");
while ($row32t = mysqli_fetch_array($data32t))
	{
	$gcdi = $row32t['sl'];
	$gnmt = $row32t['nm'];
	//echo '<marker ';
	// echo 'Expenditure_head="' . parseToXML($gnmt) . '" ';
	  //echo '/>';
			$gtot2=0;
		$data33i= mysqli_query($conn,"SELECT * FROM main_ledg where gcd='$gcdi'");
		while ($row33i = mysqli_fetch_array($data33i))
		{
		$ldgr = $row33i['sl'];
		$gnm9 = $row33i['nm'];
			
$gtot3p=0;
$query33 = "SELECT cldgr,sum(amm) as tot1 FROM main_drcr where dldgr='$ldgr' and".$qry1."";
$result33 = mysqli_query($conn,$query33);
while ($R = mysqli_fetch_array ($result33))
{

$f6=$R['tot1'];
$gtot3p=$gtot3p+$f6;
		
}

$gtot2=$gtot2+$gtot3p;
if($gtot3p!=0)
{
	//echo '<marker ';
	// echo 'Expenditure_head_sub="' . parseToXML($gnm9) . '" ';
	// echo 'Expenditure_head_sub_value="' . parseToXML($gtot3p) . '" ';
	 //echo '/>';
}}
//echo '<marker ';
	// echo 'Expenditure_head_sub_value_ttl="' . parseToXML($gtot2) . '" ';
	  //echo '/>';
$gtot1=$gtot1+$gtot2;
}
?>

<tr >
<td  align="right"><font size="4" color="BLACK"></font></td>
<td  align="right"><font size="4" color="BLACK"></font></td>
<td align="right"><font size="1" color="red"><font size="4" color="black"><B> __________ </B></font></td>
</tr>
<tr >
<? $ET=$gtot1;?>
<td  align="right"><font size="4" color="BLACK"></font></td>
<td  align="right"><font size="4" color="BLACK"></font></td>
<td align="right"><font size="4" color="red"><font size="3" color="red"><B>  Rs <? echo number_format($gtot1,2); ?></B></font></td>
</tr>
  </table>
</div>
  </td>
  </tr>
 <?$T=$IT-$ET;
   if($T>=0)
   {
   $msg="Excess of Income over Expenditure";
   ?>
   <tr class="odd">
   <td align="left">
   
  </td>
  <td align="right"><font size="3" color="#1A4C80"><? echo $msg; ?></font>
  <font size="3" color="red"><B> Rs <? echo number_format($T,2); ?></B></font>
  </td>
  
  </tr>
  <tr class="even">
  <td align="right">
   <font size="4" color="red"><B> Rs <? echo number_format($IT,2); ?></B></font>
  </td>
  <td align="right">
  <font size="4" color="red"><B> Rs <? echo number_format($T+$ET,2); ?></B></font>
  </td>
  
  </tr>
   
   <?
   }
   else
   { $T=$T*-1;
    $msg="Excess of Expenditure over Income";
	?>
	<tr class="odd">
	
  <td align="right"><font size="3" color="#1A4C80"><? echo $msg; ?></font>
  <font size="3" color="red"><B>  Rs <? echo number_format($T,2); ?></B></font>
  </td>
  <td align="left">
  
  </td>
  </tr>
  <tr class="even">
   <td align="right">
   <font size="4" color="red"><B> Rs <? echo number_format($T+$IT,2); ?></B></font>
  </td>
  <td align="right">
  <font size="4" color="red"><B> Rs <? echo number_format($ET,2); ?></B></font>
  </td>
 
  </tr>
	
	<?
   }
 ?>
<?
}

//echo '</markers>';




mysqli_close($conn);