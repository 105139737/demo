<?php
$reqlevel = 3;
include("membersonly.inc.php");

$frmnm='';
date_default_timezone_set('Asia/Kolkata');
$cdt = date('Y-m-d');
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$sup=$_REQUEST['sup'];
$typ_nm=$_REQUEST['typ'];
$gstin=$_REQUEST['gstin'];
$note_typ=$_REQUEST['note_typ'];
if($gstin=='1')
{
	$GSTIN=" and tax_rate>0";
}
else if($gstin=='0')
{
	$GSTIN=" and tax_rate='0'";
}
else
{
	$GSTIN="";
} 

$dtt="";
if($fdt!="" and $tdt!="")
{
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));
$dtt=" and dt between '$fdt' and '$tdt'";
}
$sup1="";
if($sup!='')
	{
	$sup1=" and sup='$sup'";
	}

if($typ_nm!="" )
{	
	$typ_nm1=" and find_in_set(typ,'$typ_nm')>0";
	
}
else
{
	$typ_nm1="";
}	
if($note_typ!=''){$note_typ1=" and note_typ='$note_typ'";}
$file="GST Credit Note.xls";
header("Content-type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=$file"); 
?>
<div style="overflow-x: scroll;overflow-y: hidden;">
  <table width="60%" class="advancedtable" border="2">
  <tr bgcolor="#000">

  <td align="center"><b><font color="#FFF">SL</font></b></td>
  <td align="center"><b><font color="#FFF">RECEIVER GSTIN / UIN</font></b></td>
  <td align="center"><b><font color="#FFF">RECEIVER NAME.</font></b></td>
  <td align="center"><b><font color="#FFF">DEBIT / CREDIT NOTE NO. </font></b></td>
  <td align="center"><b><font color="#FFF">DEBIT / CREDIT NOTE DATE </font></b></td>
  <td align="center"><b><font color="#FFF">ORIGINAL INVOICE NUMBER</font></b></td>
  <td align="center"><b><font color="#FFF">ORIGINAL INVOICE DATE</font></b></td>
  <td align="right"><b><font color="#FFF">NOTE TYPE </font></b></td>
  <td align="right"><b><font color="#FFF">TYPE </font></b></td>
  <td align="right"><b><font color="#FFF">SUPPLY TYPE</font></b></td>
  <td align="right"><b><font color="#FFF"> NOTE VALUE (Taxable Value ) </font></b></td>
  <td align="right"><b><font color="#FFF"> Tax Rate(%)</font></b></td>
  <td align="right"><b><font color="#FFF"> Tax Amount </font></b></td>
  <td align="right"><b><font color="#FFF"> Net Amount </font></b></td>
   </tr>
  <?

$data = mysqli_query($conn,"SELECT * FROM  main_cdnr where sl>0".$GSTIN.$dtt.$sup1.$typ_nm1.$note_typ1);
while ($row = mysqli_fetch_array($data))
	{
		//sup	sgstin	name	note_no	dt	inv	invdt	note_typ	amm	styp	edt
$cnt++;
		$sup=$row['sup'];
		$ssl=$row['sl'];
		$sgstin=$row['sgstin'];
		$name=$row['name'];
		$note_no=$row['note_no'];
		$dt1=$row['dt'];
		$dt=date("d-M-Y", strtotime($dt1));
		$inv=$row['inv'];
		$notetyp=$row['note_typ'];
		$amm=$row['amm'];
		$styp=$row['styp'];
		$invdt1=$row['invdt'];
		$typ=$row['typ'];
		$tax_rate=$row['tax_rate'];
		$tax=$row['tax'];
		$net=$row['net'];
		$invdt=date("d-M-Y", strtotime($invdt1));

	/*$sql1="SELECT * FROM main_comp where sl='$sup'";
	$result1 = mysqli_query($conn,$sql1) or die(mysqli_error($conn));
	while($row1=mysqli_fetch_array($result1))
		{
		$cnm=$row1['cnm'];
		}
	*/
		if($notetyp=='C')
		{
			$note_typ="Credit";
		}
		if($notetyp=='D')
		{
			$note_typ="Debit";
		}
$amm1+=$amm;
$tax1+=$tax;
$net1+=$net;
  ?>
   <b> 
<tr bgcolor="#e8ecf6" style="cursor:pointer;">
<td align="center"><font color="#000"><?=$cnt;?> .</font></td>
<td align="center"><font color="#000"><?=$sgstin;?></font></td>
<td align="left"><font color="#000"><?=$name;?></font></td>
<td align="center"><font color="#000"><?=$note_no;?></font></td>
<td align="center"><font color="#000"><?=$dt;?></font></td>
<td align="center"><font color="#000"><?=$inv;?></font></td>
<td align="center"><font color="#000"><?=$invdt;?></font></td>
<td align="center"><font color="#000"><?=$notetyp;?></font></td>
<td align="center"><font color="#000"><?=$typ;?></font></td>
<td align="center"><font color="#000"><?=$styp;?></font></td>
<td align="center"><font color="#000"><?=$amm;?></font></td>
<td align="center"><font color="#000"><?=$tax_rate;?></font></td>
<td align="center"><font color="#000"><?=$tax;?></font></td>
<td align="center"><font color="#000"><?=$net;?></font></td>
 
</tr>
<?php
	}
?>
<tr bgcolor="#e8ecf6" style="cursor:pointer;">
<td align="right" colspan="10"><font size="3" color="#000"><b>Total :</b></font></td>
<td align="center"><font color="#000"><?=$amm1;?></font></td>
<td align="center"><font color="#000"></font></td>
<td align="center"><font color="#000"><?=$tax1;?></font></td>
<td align="center"><font color="#000"><?=$net1;?></font></td>

</tr>
  </table>
</div>