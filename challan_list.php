<?
$reqlevel = 3; 

include("membersonly.inc.php");
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$cno=rawurldecode($_REQUEST['cno']);
$dnm=rawurldecode($_REQUEST['dnm']);
$brncd=$_REQUEST['brncd'];
if($brncd=="")
{
$brncd1="";
}
else
{
	$brncd1=" and bcd='$brncd'";
}
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));

if($fdt!="" and $tdt!=""){$todt=" and edt between '$fdt' and '$tdt'";}else{$todt="";}

if($cno!=""){$cno1=" and cno='$cno'";}else{$cno1="";}

if($dnm!="")
{
	$dnm1=" and cid='$dnm'";
}
else
{
$dnm1="";	
}
?>
 <table  class="table table-hover table-striped table-bordered"  >
		
		     <tr>
			 	<td  align="center" >
			<b>Action</b>
			</td>
			  <td  align="center" >
			<b>Sl</b>
			</td>
			 <td  align="center" >
			<b>Date</b>
			</td>
			 <td  align="center" >
		<b>Challan No.</b>
			</td>
          <td  align="center" >
			<b>Car No.</b>
			</td>
			
			<td  align="center" >
			<b>Driver Name</b>
			</td>
		
		     </tr>
			 <?
		$sln=0;
		$tota=0;
$tq=0;
$data1= mysqli_query($conn,"select * from main_chnl where sl>0".$todt.$cno1.$dnm1.$brncd1)or die(mysqli_error($conn));

  
while ($row1 = mysqli_fetch_array($data1))
{

$blno=$row1['blno'];
$edt=$row1['edt'];
$vat=$row1['vat'];
$car=$row1['car'];
$dis=$row1['dis'];
$fid=$row1['fid'];
$cid=$row1['cid'];
$cno=$row1['cno'];
$cnm=$row1['cnm'];

$edt=date('d-m-Y', strtotime($edt));
$sln++;


	 ?>
		   <tr>
		      <td  align="center"  >
			<a onclick="" style="cursor:pointer;" onclick="bill('<?=$blno;?>')"><font color="red">To Invoice</font></a>
			</td>
		    <td  align="center"  >
			<?=$sln;?>
			</td>
			 <td  align="center" >
			<?=$edt;?>
			</td>
			<td  align="center" >
				<a href="#" onclick="view('<?=$blno;?>')" title="Print"><?=$blno;?></a>
			</td>
            <td  align="center" >
			<?=$cno;?>
			</td>
			
			<td  align="center" title="<?=$pcd;?>" >
			<?=$cnm;?>
			</td>
		
		
		     </tr>	 
			 
<?
}
?>


	  </table>