<?php
$reqlevel = 3;
include("membersonly.inc.php");
 
$frmnm='';
date_default_timezone_set('Asia/Kolkata');
$dt = date('d-M-Y');

$cy=date('Y');
$pnm=$_REQUEST[pnm];
$dt=$_REQUEST[dt];
$cat=$_REQUEST[cat];
$bnm=$_REQUEST[bnm];
$sect=$_REQUEST[sect];

$brncd=$_REQUEST[brncd];if($brncd==""){$brncd1="";}else{$brncd1=" and bcd='$brncd'";}
$tdt=date('Y-m-d',strtotime($dt));
$fdt=date('Y-m-d',strtotime($dt));

$cat1="";
if($cat!=""){$cat1=" and cat='$cat'";}
$bnm1="";
if($bnm!=""){$bnm1=" and bnm='$bnm'";}
if($pnm!=""){$all1=" and sl='$pnm'";}else{$all1="";	}
$sect1="";
if($sect!=""){$sect1=" and sect='$sect'";}

$file="Stock_Statement_as_On_".$dt.".xls";
header("Content-type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=$file"); 



?>

 <table  class="table table-hover table-striped table-bordered" border="1" style="width:900px" >
		
		     <tr>
			  <td  align="center" >
			<b>Sl</b>
			</td>
			 <td  align="center" >
			<b>Product</b>
			</td>
			<td  align="center" >
			<b>Opening </b>
			</td>
			<td  align="right" >
			<b>Opening Value (Rs.)</b>
			</td>
			<td  align="center" >
			<b>Stock In</b>
			</td>
			<td  align="right" >
			<b>In Value (Rs.)</b>
			</td>
			<td  align="center" >
			<b>Return</b>
			</td>
			<td  align="right" >
			<b>Return Value (Rs.)</b>
			</td>
			<td  align="center" >
			<b>Sale</b>
			</td>
			<td  align="right" >
			<b>Sale Value Stock (Rs.)</b>
			</td>
			<td  align="right" >
			<b>Sale Value (Rs.)</b>
			</td>
			   <td  align="center" >
			<b>Closing Stcok</b>
			</td>
			<td  align="right" >
			<b>Closing Value (Rs.)</b>
			</td>
		
		     </tr>
<?

$sl=$start;
$c1='odd';
$c3=0;
$sln=0;
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
$data= mysqli_query($conn,"select * from main_product where sl>0 $all1 $cat1 $bnm1 $sect1 ")or die(mysqli_error($conn));
 
while ($row = mysqli_fetch_array($data))
{
$slno=$row['sl'];
$csl=$row['csl'];
$pcd=$row['sl'];
$cat=$row['cat'];
$bnm=$row['bnm'];
$variant=$row['variant'];
$cnm="";				
$data4= mysqli_query($conn,"select * from main_catg where sl='$cat'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data4))
{
$cnm=$row1['cnm'];
}
$brand="";
$data2= mysqli_query($conn,"select * from main_brand where sl='$bnm'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data2))
{
$brand=$row1['brand'];
}


$sln++;
 $clval=0;    
$opval=0; 
$inval=0;
$outval=0;
$stck=0;
$clval=0;
$query4="Select sum(opst+stin-stout) as stck1,(sum(opst+stin-stout)*ret) as clval from ".$DBprefix."stock where pcd='$pcd' and dt<='$fdt'".$brncd1." group by betno order by pcd ";
$result4 = mysqli_query($conn,$query4);
  while ($R4 = mysqli_fetch_array ($result4))
{
$stck+=$R4['stck1'];
$clval+=$R4['clval'];
}
$stkf=$stck;
if($stkf==""){$stkf=0;}
$open=0;
$opval=0;
$query6="Select sum(opst+stin-stout) as open,(sum(opst+stin-stout)*ret) as opval from ".$DBprefix."stock where pcd='$pcd' and dt<'$tdt'".$brncd1." group by betno order by pcd";
$result6 = mysqli_query($conn,$query6);
while ($R6 = mysqli_fetch_array ($result6))
{
$open+=$R6['open'];
$opval+=$R6['opval'];
}
$open1=$open;
if($open1==""){$open1=0;}
$stin=0;
$inval=0;
$query7="Select sum(stin) as stin,(sum(stin)*ret) as inval from ".$DBprefix."stock where pcd='$pcd' and dt='$fdt' and (nrtn='Product IN' or nrtn='Receive')".$brncd1." group by betno order by pcd";
$result7 = mysqli_query($conn,$query7);
  while ($R7 = mysqli_fetch_array ($result7))
{
$stin+=$R7['stin'];
$inval+=$R7['inval'];
}
$stin1=$stin;
if($stin1==""){$stin1=0;}


$str=0;
$rval=0;
$query7="Select sum(stin) as stin,(sum(stin)*ret) as inval from ".$DBprefix."stock where pcd='$pcd' and dt='$fdt' and nrtn='Sale Return'".$brncd1." group by betno order by pcd";
$result7 = mysqli_query($conn,$query7);
  while ($R7 = mysqli_fetch_array ($result7))
{
$str+=$R7['stin'];
$rval+=$R7['inval'];
}
if($str==""){$str=0;}


$tots=0;
$stout=0;
$outval=0;
$query8="Select sum(stout) as stout,(sum(stout)*ret) as outval,betno,sbill from ".$DBprefix."stock where pcd='$pcd' and dt='$fdt' and stout>0".$brncd1." group by betno order by pcd";

$result8 = mysqli_query($conn,$query8);
while ($R8 = mysqli_fetch_array ($result8))
{
$stout2=0;	
$sbetno=$R8['betno'];
$sbill=$R8['sbill'];
$stout+=$R8['stout'];
$stout2=$R8['stout'];
$outval+=$R8['outval'];
$fprc=0;
$data21= mysqli_query($conn,"select * from main_billdtls where prsl='$pcd' and betno='$sbetno' and blno='$sbill'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data21))
{
$fprc=$row1['fprc'];
}
$tots+=$fprc*$stout2;
}


$stout1=$stout;
if($stout1==""){$stout1=0;}

			 ?>
		   <tr  >
		   
		    <td  align="center" >
			<?=$sln;?>
			</td>
			 <td  align="left" title="<?=$pcd?>">
		<?=$cnm;?> - <?=$brand;?> - <?=$variant;?>
			</td>
			 <td  align="center" >
			<?echo $open1;?>
			</td>
			 <td  align="right" >
			<?echo sprintf('%0.2f',$opval);?>
			</td>
            <td  align="center" >
			<?=$stin1;?>
			</td>
			 <td  align="right" >
			<?echo sprintf('%0.2f',$inval);?>
			</td>
			 <td  align="center" >
			<?=$str;?>
			</td>
			 <td  align="right" >
			<?echo sprintf('%0.2f',$rval);?>
			</td>
			 <td  align="center" >
			<?=$stout1;?>
			</td>
			 <td  align="right" >
			<?echo sprintf('%0.2f',$outval);?>
			</td>
			<td  align="right" >
			<?echo sprintf('%0.2f',$tots);?>
			</td>
			
			<td  align="center" >
			<?=$stkf;?>
			</td>
			 <td  align="right" >
			<?echo sprintf('%0.2f',$clval);?>
			</td>
		     </tr>	 
<?
$stkf=0;
$stout1=0;
$stin1=0;
$open1=0;
$Top=$opval+$Top;
$Tin=$inval+$Tin;
$Tout=$outval+$Tout;
$Tcl=$clval+$Tcl;
$Tout1=$tots+$Tout1;
$Toutr1=$rval+$Toutr1;
}?>
<tr>
<td colspan="2" align="right">
<b>Total Value </b>
</td>
	 <td  align="center" >
			
			</td>
			 <td  align="right" >
			<b><font size="4"><?echo sprintf('%0.2f',$Top);?></font></b>
			</td>
            <td  align="center" >
		
			</td>
			 <td  align="right" >
			<b><font size="4"><?echo sprintf('%0.2f',$Tin);?></font></b>
			</td>
			<td  align="center" >
		
			</td>
			 <td  align="right" >
			<b><font size="4"><?echo sprintf('%0.2f',$Toutr1);?></font></b>
			</td>
			 <td  align="center" >
		
			</td>
			 <td  align="right" >
			<b><font size="4"><?echo sprintf('%0.2f',$Tout);?></font></b>
			</td> 
			<td  align="right" >
			<b><font size="4"><?echo sprintf('%0.2f',$Tout1);?></b>
			</td>
		
			<td  align="center" >
		
			</td>
			 <td  align="right" >
			<b><font size="4"><?echo sprintf('%0.2f',$Tcl);?></font></b>
			</td>
</tr>

	  </table>
