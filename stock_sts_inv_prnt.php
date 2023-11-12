<?php
$reqlevel = 3;
include("membersonly.inc.php");

$frmnm='';
date_default_timezone_set('Asia/Kolkata');
$dt = date('d-M-Y');
 
$cy=date('Y');
$pnmsl=$_REQUEST['pnm'];
$catsl=$_REQUEST['cat'];
$wzer=$_REQUEST['wzer'];

$brncd=$_REQUEST['brncd'];
//if($brncd==""){$brncd1="";}else{$brncd1=" and cat='$brncd'";}
if($brncd==""){$brncd2="";}else{$brncd2=" and bcd='$brncd'";}
if($catsl!=""){$cat1=" and scat='$catsl'";}else{$cat1="";}
if($pnmsl!=""){$pnm1=" and sl='$pnmsl'";}else{$pnm1="";	}
$querys="Select * from ".$DBprefix."branch where sl='$brncd'";
$results = mysqli_query($conn,$querys);
while ($Rs = mysqli_fetch_array ($results))
{
$branchnm=$Rs['bnm'];
}
 
?> 
<script type="text/javascript">
prnt();
function prnt(){
    if(confirm('Are You Sure?')){
    
    window.print();
   }
   
}
</script>
<style>
.advancedtable tbody tr td
{
border:1px solid #000;
padding: 2px 2px;
}
.advancedtable thead tr th
{
border:1px solid #000;
padding: 0px 0px;
}
.advancedtable
{
border-collapse: collapse;
}
</style>
<table width="100%">
<tr>
<td align="center" colspan="9"><b>
<b>Stock Statement Invoice Wise</b><br>
<font style="font-size:18px;font-family:Century"><b><?=$comp_nm;?> - <?=$branchnm;?></b></font><br/>
<font style="font-size:13px;font-family:Century"><?=$comp_addr;?><br>
Phone : <?=$cont;?>
</font><br/>
<font style="font-size:13px;">GSTIN NO. : <?=$gstin?></font><br>
<font style="font-size:14px;"><b>Statement As On : <?=$dt;?></b></font>


</b></td>
</tr>	
</table>

<table  class="advancedtable"  cellspacing="0" width="100%">
<thead>
		     <tr bgcolor="#e8ecf6">
			  <th  align="center" >
			<b>Sl</b>
			</th>
			 <th  align="left" >
			<b>Company </b>
			</th>
			<th  align="left" >
			<b>Category </b>
			</th>
			
			 <th  align="left" >
			<b>Product Name</b>
			</th>
			<th  align="left" >
			<b>Invoice No </b>
			</th>
			<th  align="left" >
			<b>MRP</b>
			</th>
			
			<th  align="left" >
			<b>Stock In</b>
			</th>
			<th  align="left" >
			<b>Stock Out</b>
			</th>
			<th  align="left" >
			<b>Closing Stcok</b>
			</th>
			</tr>
			</thead>
<?
$cntt=0;
$data= mysqli_query($conn,"select * from main_product where sl>0 $cat1 $pnm1 ")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
$pcd=$row['sl'];
$pnm=$row['pnm'];
$cat=$row['cat'];
$scat=$row['scat'];
$get=mysqli_query($conn,"select * from ".$DBprefix."unit where cat='$cat'") or die(mysqli_error($conn));
while($roww=mysqli_fetch_array($get))
{
$mun=$roww['mun'];
$mdvlu=$roww['mdvlu'];
$sun=$roww['sun'];
$smvlu=$roww['smvlu'];
}
if($mdvlu<1)
{
$mun=$sun;
$mdvlu=$smvlu;	
}
$reslt5 = mysqli_query($conn,"select * from  main_branch where sl='$cat'");
while($trow=mysqli_fetch_array($reslt5))
{
$cnm=$trow['bnm'];
}
$rest5 = mysqli_query($conn,"select * from  main_scat where sl='$scat'");
while($trw=mysqli_fetch_array($rest5))
{
$snm=$trw['nm'];
}

$data1 = mysqli_query($conn,"SELECT * FROM main_stock WHERE pcd='$pcd' group by refno,ret order by sl");
while ($row1 = mysqli_fetch_array($data1))
{
$cntt++;
$sl=$row1['sl'];
$refno1=$row1['refno'];
$pcd1=$row1['pcd'];
$unit=$row1['unit'];
$rate=$row1['ret'];


$stck=0;
$stck2=0;
$stck3=0;
$stock_in=0;
$stock_in3=0;
$stock_in2=0;
 $query4="Select sum(opst+stin-stout) as stck1,sum(opst+stin) as stck2,sum(stout) as stck3 from ".$DBprefix."stock where pcd='$pcd' and  refno='$refno1' $brncd2 ";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$stck=round($R4['stck1'],4);
$stck2=round($R4['stck2'],4);
$stck3=round($R4['stck3'],4);
}
if($stck2==""){$stck2=0;}
else
{
if($stck2>0)	
{
$stock_in2=$stck2/$smvlu;
$stock_in2=$stock_in2." ".$sun;	

	
}
}
if($stck3==""){$stck3=0;}
else
{
if($stck3>0)	
{
$stock_in3=$stck3/$smvlu;
$stock_in3=$stock_in3." ".$sun;	
}
}
if($stck==""){$stck=0;}
else
{
if($stck>0)	
{
$stock_in=$stck/$smvlu;
$stock_in=$stock_in." ".$sun;	
}
}

if($wzer=="0")
{
	if($stck>0)	
	{
	?>
	<tbody>
	 <tr  title="<?=$pcd;?>">
	<td  align="center" ><?=$cntt;?></td>
	<td align="left"><?=$cnm;?></td>
	<td align="left"><?=$snm;?></td>
	<td align="left"><?=$pnm;?></td>
	<td align="left" ><?=$refno1;?></td>
	<td align="left" ><?=$rate;?></td>
	<td align="left" ><?=$stock_in2;?></td>
	<td align="left" ><?=$stock_in3;?></td>
	<td align="left" ><?=$stock_in;?></td>
		</tr>
		</tbody>
		<?
		
	}
	
	
}
else
{
	?>
	<tbody>
	 <tr  title="<?=$pcd;?>">
	<td  align="center" ><?=$cntt;?></td>
	<td align="left"><?=$cnm;?></td>
	<td align="left"><?=$snm;?></td>
	<td align="left"><?=$pnm;?></td>
	<td align="left" ><?=$refno1;?></td>
	<td align="left" ><?=$rate;?></td>
	<td align="left" ><?=$stock_in2;?></td>
	<td align="left" ><?=$stock_in3;?></td>
	<td align="left" ><?=$stock_in;?></td>
		</tr>
		</tbody>
		<?
}


	}
}
	?>
</table>
