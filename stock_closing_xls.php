<?php 
$reqlevel = 3;
include("config.php");

$frmnm='';
date_default_timezone_set('Asia/Kolkata');
$dt = date('d-m-Y');

$cy=date('Y');
$pnm=$_REQUEST[pnm];
if($pnm!="")
{
	$all1=" and sl='$pnm'";
}
else
{
$all1="";	
}
$mm=date('M', strtotime($m));

$file="NADIA CLOSING STOCK ".$dt.".xls";
header("Content-type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=$file"); 



?>

 <table  class="advancedtable" width="900px" border="1" >
				     <tr bgcolor="#06dbfb">
		 <td  align="center" colspan="3" >
			<b>NADIA CLOSING STOCK <?php  echo $dt;?></b>
			</td>
			<td  align="center" colspan="7">
			<b>NADIA</b>
			</td>
			
		     </tr>
		     <tr >
		 <td  align="center" >
			<b>PRODUCT DESCRIPTION</b>
			</td>
			<td  align="center" >
			<b>Pack</b>
			</td>
			
			<td  align="center" >
			<b>Landed Price</b>
			</td>
			<td  align="center" bgcolor="#ffefd8" >
			<b>CHAKADAHA 1</b>
			</td>
		  <td  align="center" bgcolor="#ffefd8" >
			<b>Kg/Ltr</b>
			</td>
			<td  align="center" bgcolor="#99cc00" >
			<b>KRISHNAGAR 1</b>
			</td>
	  <td  align="center"  bgcolor="#99cc00">
			<b>Kg/Ltr</b>
			</td>
		<td  align="center" bgcolor="#ffcc99" >
			<b>TEHATTA 1</b>
			</td>
	  <td  align="center" bgcolor="#ffcc99" >
			<b>Kg/Ltr</b>
			</td>
			<td  align="center" bgcolor="#99ccff" >
			<b>Nadia Total Kg/Ltr</b>
			</td>
		     </tr>
<?php 


$c1='odd';
$cs="odd";
$CHAKADAHA=0;
$KRISHNAGAR=0;
$TEHATTA=0;
$gtot=0;
$stkfgt=array("0","0","0");
$CHAKADAHA_ret_total=0;
$KRISHNAGAR_ret_total=0;
$TEHATTA_ret_total=0;
$NADIA_ret_total=0;
 $data= mysqli_query($conn,"select * from  main_product where sl!='' $all1 order by pname")or die(mysqli_error($conn));
 
while ($row = mysqli_fetch_array($data))
{
	$c3++;
$slno=$row['sl'];
$csl=$row['csl'];
$pcd=$row['sl'];

$co=$row['co'];
$pname=$row['pname'];
$c=$row['pkgunt'];
$ret=$row['ret'];


$sln++;
$pack="0";
  $query2="Select * from main_pack where psl='$slno'";
   $result2 = mysqli_query($conn,$query2);
while ($R1 = mysqli_fetch_array ($result2))
{
$pack=$R1['pack'];
}       

$query1="Select * from ".$DBprefix."unit where sl='$c'";
   $result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$punt=$R1['pkgunt'];
$upkg=$R1['untpkg'];
$ptu=$R1['tunt'];
}
$i=0;

$stkftt=0;
$CHAKADAHA=0;
$KRISHNAGAR=0;
$TEHATTA=0;
$CHAKADAHA_pack=0;
$KRISHNAGAR_pack=0;
$TEHATTA_pack=0;
$NADIA_pack=0;
$CHAKADAHA_ret=0;
$KRISHNAGAR_ret=0;
$TEHATTA_ret=0;

$query="Select * from main_branch where sl!=1 order by sl";
   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$bcd=$R['sl'];
$bnm=$R['bnm'];
$stkf=0;

  $query4="Select sum(opst+stin-stout) as stck1,bcd from ".$DBprefix."stock where pcd='$pcd' and bcd='$bcd' group by bcd ";
$result4 = mysqli_query($conn,$query4);
  while ($R4 = mysqli_fetch_array ($result4))
{
$stck=$R4['stck1'];
$bcd1=$R4['bcd'];
}

if($stck!=0)
{
$stkf=$stck/$ptu;
}
if($bcd1==10)
{
$CHAKADAHA=$stkf;
$CHAKADAHA_pack=$CHAKADAHA*$pack;
$CHAKADAHA_ret=($CHAKADAHA*$ret);

}
elseif($bcd1==9)
{
	$KRISHNAGAR=$stkf;
$KRISHNAGAR_pack=$KRISHNAGAR*$pack;
$KRISHNAGAR_ret=($KRISHNAGAR*$ret);
}
elseif($bcd1==11)
{
$TEHATTA=$stkf;	
$TEHATTA_pack=$TEHATTA*$pack;
$TEHATTA_ret=($TEHATTA*$ret);
}

}
$NADIA_pack=$CHAKADAHA_pack+$KRISHNAGAR_pack+$TEHATTA_pack;



		if($cs=="even")
		{
		$cs="odd";
		}
		else{
			$cs="even";
		}
			 ?>
		   <tr class="<?php  echo $cs;?>" >
		   
		    <td  align="left" >
			<?php  echo $pname;?>
			</td>
			 <td  align="right" style="cursor:pointer" >
			<?php  echo $pack;?>
			</td>
			
			 <td  align="right" >
			<b><?php echo number_format($ret,2);?></b>
			</td>
            <td  align="center" bgcolor="#ff9900" >
			<?php  echo $CHAKADAHA;?>
			</td>
		  <td  align="right" bgcolor="#ff9900" >
			<b><?php  echo $CHAKADAHA_pack;?></b>
			</td>
			<td  align="center" bgcolor="#cc99ff" >
		<?php  echo $KRISHNAGAR;?>
			</td>
			  <td  align="right" bgcolor="#cc99ff"  >
			<b><?php  echo $KRISHNAGAR_pack;?></b>
			</td>
			<td  align="center" bgcolor="#ff99cc"  >
		<?php  echo $TEHATTA;?>
			</td>
		  <td  align="right" bgcolor="#ff99cc"  >
			<b><?php  echo $TEHATTA_pack;?></b>
			</td>
				<td  align="right" bgcolor="#ffcc99"  >
			<?php  echo $NADIA_pack;?>
			</td>
	
		
		     </tr>	 
<?php 
$CHAKADAHA_ret_total=$CHAKADAHA_ret+$CHAKADAHA_ret_total;
$KRISHNAGAR_ret_total=$KRISHNAGAR_ret+$KRISHNAGAR_ret_total;
$TEHATTA_ret_total=$TEHATTA_ret+$TEHATTA_ret_total;
$NADIA_ret_total=$TEHATTA_ret_total+$KRISHNAGAR_ret_total+$CHAKADAHA_ret_total;
}
?>
<tr bgcolor="#69c238">
<td colspan="3" align="right">
<b>Total Value :</b>
</td>

<td align="center" >
<b><?php echo $CHAKADAHA_ret_total;?></b>
</td>
<td>
</td>
<td align="center" >
<b><?php echo $KRISHNAGAR_ret_total;?></b>
</td>
<td>
</td>
<td align="center" >
<b><?php echo $TEHATTA_ret_total;?></b>
</td>
<td>
</td>
<td align="right" >
<b><?php  echo $NADIA_ret_total;?></b>
</td>


</tr>

	  </table>
