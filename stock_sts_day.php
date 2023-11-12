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
$scat=$_REQUEST[scat];

$brncd=$_REQUEST[brncd];if($brncd==""){$brncd1="";}else{$brncd1=" and bcd='$brncd'";}
$tdt=date('Y-m-d',strtotime($dt));
$fdt=date('Y-m-d',strtotime($dt));

$cat1="";
if($cat!=""){$cat1=" and cat='$cat'";}
$scat1="";
if($scat!=""){$scat1=" and scat='$scat'";}
if($pnm!=""){$all1=" and sl='$pnm'";}else{$all1="";	}


?> 

  <table  class="table table-hover table-striped table-bordered"  >
		
		     <tr>
			  <td  align="center" >
			<b>Sl</b>
			</td>
			 <td  align="center" >
			<b>Product Name</b>
			</td>
			<td  align="center" >
			<b>Opening </b>
			</td>
			<td  align="center" >
			<b>Stock In</b>
			</td>
				
			<td  align="center" >
			<b>Sale</b>
			</td>
	
		
			   <td  align="center" >
			<b>Closing Stcok</b>
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
$data= mysqli_query($conn,"select * from main_product where sl>0 $cat1 $scat1  $all1")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
$pcd=$row['sl'];
$unit=$row['unit'];
$nm=$row['pnm'];
$cat=$row['cat'];
$scat=$row['scat'];
$cnm="";				
$data12= mysqli_query($conn,"select * from main_catg where sl='$cat'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data12))
{
$cnm=$row1['cnm'];
}
$scat_nm="";				
$data2= mysqli_query($conn,"select * from main_scat where sl='$scat'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data2))
{
$scat_nm=$row1['nm'];
}
$get=mysqli_query($conn,"select * from ".$DBprefix."unit where cat='$pcd'") or die(mysqli_error($conn));
while($roww=mysqli_fetch_array($get))
{
	$sun=$roww['sun'];
}

$sln++;
 $clval=0;    
$opval=0; 
$inval=0;
$outval=0;
$stck=0;
$clval=0;
$stock_close="";
$query4="Select sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pcd' and dt<='$fdt'".$brncd1." order by pcd ";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$stck=$R4['stck1'];
}
$stkf=$stck;
if($stkf==""){$stkf=0;}
$stock_close=$stkf." ".$sun;

$stock_op="";
$open=0;
$opval=0;
$query6="Select sum(opst+stin-stout) as open from ".$DBprefix."stock where pcd='$pcd' and dt<'$tdt'".$brncd1."  order by pcd";
$result6 = mysqli_query($conn,$query6);
while ($R6 = mysqli_fetch_array ($result6))
{
$open=$R6['open'];
}
$open1=$open;
if($open1==""){$open1=0;}
$stock_op=$open1." ".$sun;

$stin=0;
$inval=0;
$stock_in="";
$query7="Select sum(stin) as stin from ".$DBprefix."stock where pcd='$pcd' and dt='$fdt' ".$brncd1."  order by pcd";
$result7 = mysqli_query($conn,$query7);
while ($R7 = mysqli_fetch_array ($result7))
{
$stin=$R7['stin'];
}
$stin1=$stin;
if($stin1==""){$stin1=0;}
$stock_in=$stin1." ".$sun;


$tots=0;
$stout=0;
$outval=0;
$stock_out="";
$query8="Select sum(stout) as stout from ".$DBprefix."stock where pcd='$pcd' and dt='$fdt' and stout>0".$brncd1."  order by pcd";

$result8 = mysqli_query($conn,$query8);
while ($R8 = mysqli_fetch_array ($result8))
{
$stout=$R8['stout'];
}
$stout1=$stout;
if($stout1==""){$stout1=0;}

$stock_out=$stout1." ".$sun;
			 ?>
		   <tr  >
			<td  align="center" >
			<?=$sln;?>
			</td>
			 <td  align="left" title="<?=$pcd?>">
				<?=$cnm;?> --	<?=$scat_nm;?> -- <?=$nm;?>
			</td>
			 <td  align="left" >
			<?echo $stock_op;?>
			</td>
	       <td  align="left" >
			<?=$stock_in;?>
			</td>

		
			 <td  align="left" >
			<?=$stock_out;?>
			</td>
			<td  align="left" >
			<?=$stock_close;?>
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

	  </table>
