<?
$reqlevel = 3; 
include("membersonly.inc.php");
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$bcd=$_REQUEST['bcd'];

$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));

if($fdt!="" and $tdt!=""){$todt=" and dt between '$fdt' and '$tdt'";}else{$todt="";}



$dis1=0;
?>

<div class="row">
<div class="col-md-12">
<div class="col-md-12" style="background-color:#000"><font size="5" color="#fff">Product  List</font></div>
 <table  width="100%" class="advancedtable"  >
		
			<tr bgcolor="#e8ecf6">

			<td  align="center" ><b><b>All</b> &nbsp; </font>
<input type="checkbox" name="chkall" onchange="checkall(this.checked)" style="width:20px;"/></b></td>		
			<td  align="center" ><b>Sl</b></td>
			<td  align="center" ><b>From Godown</b></td>
			<td  align="center" ><b>To Godown</b></td>
			<td  align="center" ><b>Bill No.</b></td>
			<td  align="center" ><b>Date</b></td>
			<td  align="center" ><b>Brand</b></td>
			<td  align="center" ><b>Category</b></td>
			<td  align="center" ><b>Product</b></td>
			<td  align="center" ><b>Serial No.</b></td>
			<td  align="center" ><b>Quantity</b></td>	
			<td  align="center" ><b>Action</b></td>
			

			</tr>
			 <?
		$sln=0;

$data1= mysqli_query($conn,"select * from  main_billdtls where sl>0 and tstat='1' and tbcd='$bcd' ".$todt." order by sl")or die(mysqli_error($conn));
while ($R100 = mysqli_fetch_array($data1))
{
$sln++;
$sl=$R100['sl'];
$prsl=$R100['prsl'];
$unit=$R100['unit'];
$pcs=$R100['pcs'];
$betno=$R100['betno'];
$blno=$R100['blno'];
$fbcd=$R100['fbcd'];
$tbcd=$R100['tbcd'];
$cat=$R100['cat'];
$scat=$R100['scat'];
$dt=$R100['dt'];
$pnm="";
$query6="select * from  ".$DBprefix."product where sl='$prsl'";
$result5 = mysqli_query($conn,$query6);
while($row=mysqli_fetch_array($result5))
{
$pnm=$row['pnm'];
$pcd=$row['pcd'];
}
$fgnm="";
$geti=mysqli_query($conn,"select * from main_godown where sl='$fbcd'") or die(mysqli_error($conn));
while($rowi=mysqli_fetch_array($geti))
{
$fgnm=$rowi['gnm'];
}
$tgnm="";
$geti=mysqli_query($conn,"select * from main_godown where sl='$tbcd'") or die(mysqli_error($conn));
while($rowi=mysqli_fetch_array($geti))
{
$tgnm=$rowi['gnm'];
}
$cnm="";				
$data3= mysqli_query($conn,"select * from main_catg where sl='$cat'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data3))
{
$cnm=$row1['cnm'];
}
$scat_nm="";				
$data2= mysqli_query($conn,"select * from main_scat where sl='$scat'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data2))
{
$scat_nm=$row1['nm'];
}

?>
<tr >
<td align="center">
<input type="checkbox" name="chk[]" value="<?=$sl;?>"  onclick="ch1('<?=$sl;?>',this.checked)" style="width:20px;"/>
</td> 
<td  align="center"  ><?=$sln;?></td>
<td  align="left" ><?=$fgnm;?></td>
<td  align="left" ><?=$tgnm;?></td>
<td  align="left" ><?=$blno;?></td>	
<td  align="left" ><?=date('d-m-Y', strtotime($dt));?></td>	
<td  align="left" ><?=$cnm;?></td>
<td  align="left" ><?=$scat_nm;?></td>
<td  align="left" ><?=$pcd." - ".$pnm;?></td>		
<td  align="left" ><?=$betno;?></td>		
<td  align="left" ><?=$pcs;?></td>		
<td align="center" width="4%"><b><a onclick="if(confirm('Are you Sure?')){del('<?=$sl;?>')}"><font color="red">Delete</font></a> </b></td>
		

</tr>	 
<?}?>
</table>
 </div>
