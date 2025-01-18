<?php 
$reqlevel = 3;
date_default_timezone_set('Asia/Kolkata');
include("membersonly.inc.php");
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$brncd=$_REQUEST['brncd'] ?? "";if($brncd==""){$brncd1="";}else{$brncd1=" and bcd='$brncd'";}

$fdt=date('Y-m-d',strtotime($fdt));
$tdt=date('Y-m-d',strtotime($tdt));
$diff = (strtotime($tdt) - strtotime($fdt));
$diff = floor($diff / (60*60*24));


?>




<table class="table table-hover table-striped table-bordered">  
<tr>
			<td  align="center" >

			</td>
			<td  align="center" >
			<font size="3"><b>A</b></font>
			</td>
			<td  align="center" >
			<font size="3"><b>B</b></font>
			</td>
			<td  align="center" >
			<font size="3"><b>C</b></font>
			</td>
			<td  align="center" >
			<b></b>
			</td>
			<td  align="center" >
			<font size="3"><b>D</b></font>
			</td>
			<td  align="center" >
			<b></b>
			</td>
			<td  align="center" >
			<font size="3"><b>E = A + B + C - D</b></font>
			</td>
			</tr>

			<tr>
			<td  align="center" >
			<b>Date</b>
			</td>
			<td  align="right" >
			<b>Opening Value (Rs.)</b>
			</td>
			<td  align="right" >
			<b>In Value (Rs.)</b>
			</td>
			<td  align="right" >
			<b>Return Value (Rs.)</b>
			</td>
			<td  align="right" >
			<b>Return Value With Discount(Rs.)</b>
			</td>
			<td  align="right" >
			<b>Sale Value (Rs.)</b>
			</td>
			<td  align="right" >
			<b>Sale Value With Discount (Rs.)</b>
			</td>
			<td  align="right" >
			<b>Closing Value (Rs.)</b>
			</td>
			</tr>
			
<?php 
$in_total=0;
$retn_total=0;
$retn_w_d_total=0;
$sale_total=0;
$sale_w_d_total=0;

$dt=$fdt;
for($i=0;$i<=$diff;$i++)
{

$open1=0;
$stkf=0;
$stin1=0;
$stout1=0;
$Top=0;
$Tin=0;
$Tout=0;
$Tout1=0;
$Toutr1=0;
$Tcl=0;
$innn=0;
$out=0;
$ccl=0;
$rrr=0;


 $clval=0;    
$opval=0; 
$inval=0;
$outval=0;
$stck=0;

$totR=0;

$open=0;
$opval=0;
$query6="Select sum(opst+stin-stout) as open,(sum(opst+stin-stout)*ret) as opval from ".$DBprefix."stock where  dt<'$dt' and bcd='1' group by pcd order by pcd";
$result6 = mysqli_query($conn,$query6);
while ($R6 = mysqli_fetch_array ($result6))
{
$open+=$R6['open'];
$opval+=$R6['opval'];
}
$stck=0;
$clval=0;
$query4="Select sum(opst+stin-stout) as stck1,sum((opst+stin-stout)*ret) as clval from ".$DBprefix."stock where bcd='1' and dt<='$dt' group by pcd order by pcd ";
$result4 = mysqli_query($conn,$query4);
  while ($R4 = mysqli_fetch_array ($result4))
{
$stck+=$R4['stck1'];
$clval+=$R4['clval'];
}
$stkf=$stck;
if($stkf==""){$stkf=0;}
$ccl+=$stkf;
$stin=0;
$inval=0;
$query7="Select sum(stin) as stin,sum(stin*ret) as inval from ".$DBprefix."stock where (nrtn='Purchase' or nrtn='Open Stock') and bcd='1' and dt='$dt'  group by pcd order by pcd";
$result7 = mysqli_query($conn,$query7);
  while ($R7 = mysqli_fetch_array ($result7))
{
$stin+=$R7['stin'];
$inval+=$R7['inval'];
}
$stin1+=$stin;
$innn+=$stin;

$str=0;
$rval=0;
$query9="Select sum(stin) as stin,sum(stin*ret) as inval,pcd,rbill from ".$DBprefix."stock where nrtn='Sale Return' and bcd='1' and dt='$dt'  group by pcd order by pcd";
$result9 = mysqli_query($conn,$query9);
  while ($R7 = mysqli_fetch_array ($result9))
{
$str+=$R7['stin'];
$outtt=$R7['stin'];
$rval+=$R7['inval'];
$rbill=$R7['rbill'];
$pcd=$R7['pcd'];

$data21= mysqli_query($conn,"select * from main_billdtls where prsl='$pcd' and retno='$rbill'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data21))
{
$prc=$row1['fprc'];
}
$totR+=$prc*$outtt;
}
$rrr=$str+$rrr;

$tots=0;
$stout=0;
$outval=0;
$query8="Select sum(stout) as stout,sum(stout*ret) as outval,pcd,sbill from ".$DBprefix."stock where stout>0 and bcd='1' and dt='$dt'  group by pcd order by pcd";

$result8 = mysqli_query($conn,$query8);
while ($R8 = mysqli_fetch_array ($result8))
{
$stout2=0;	
$sbetno=$R8['pcd'];
$sbill=$R8['sbill'];
$stout+=$R8['stout'];
$stout2=$R8['stout'];
$outval+=$R8['outval'];
$fprc=0;
$data21= mysqli_query($conn,"select * from main_billdtls where prsl='$sbetno' and blno='$sbill'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data21))
{
$fprc=$row1['fprc'];
}
$tots+=$fprc*$stout2;
}
$ddt=date('Y-m-d',strtotime($dt));
	?>		
			
			
			<tr>
			<td  align="center" >
			<b><?php  echo $ddt;?></b><br>
			
			
			</td>
			<td  align="right" >
			<b><?php echo sprintf('%0.2f',$opval);?></b>
			</td>
			<td  align="right" >
			<b><?php echo sprintf('%0.2f',$inval);?></b>
			</td>
			<td  align="right" >
			<b><?php echo sprintf('%0.2f',$rval);?></b>
			</td>
			<td  align="right" >
			<b><?php echo sprintf('%0.2f',$totR);?></b>
			</td>
			<td  align="right" >
			<b><?php echo sprintf('%0.2f',$outval);?></b>
			</td>
			<td  align="right" >
			<b><?php echo sprintf('%0.2f',$tots);?></b>
			</td>
			<td  align="right" >
			<b><?php echo sprintf('%0.2f',$clval);?></b>
			</td>
			</tr>
<?php 
$dt = strtotime ( "+ 1 day" , strtotime ( $dt) ) ;
$dt = date ( 'Y-m-d' , $dt );
$in_total+=$inval;
$retn_total+=$rval;
$retn_w_d_total+=$totR;
$sale_total+=$outval;
$sale_w_d_total+=$tots;
}
?>
	<tr bgcolor="#e8ecf6">
			<td  align="right" colspan="2" >
			<b><font size="3">Total:</font></b>
			</td>
			<td  align="right" >
			<b><?php echo sprintf('%0.2f',$in_total);?></b>
			</td>
			<td  align="right" >
			<b><?php echo sprintf('%0.2f',$retn_total);?></b>
			</td>
			<td  align="right" >
			<b><?php echo sprintf('%0.2f',$retn_w_d_total);?></b>
			</td>
			<td  align="right" >
			<b><?php echo sprintf('%0.2f',$sale_total);?></b>
			</td>
			<td  align="right" >
			<b><?php echo sprintf('%0.2f',$sale_w_d_total);?></b>
			</td>
			<td  align="right" >
		
			</td>
			</tr>
</table>                 
                  	
  