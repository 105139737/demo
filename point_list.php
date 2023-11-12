<?
$reqlevel = 3; 

include("membersonly.inc.php");
$psl=$_REQUEST['psl'];
$srch=rawurldecode($_REQUEST['srch']);
if($psl==""){$psl1="";}else{$psl1="AND pcd='$psl'";}

$af="%".$srch."%";
if($srch!='')
{
	$a2="AND (pack LIKE '$af' OR point LIKE '$af')";
}
else
{
	$a2='';
}


?>
<table  class="table table-hover table-striped table-bordered"  >	
<tr>
<td  align="center" width="4%"><b>Sl</b></td>
<td  align="center" width="6%"><b>Product Name</b></td>
<td  align="center" width="6%" ><b>Pack</b></td>		
<td  align="center" width="6%" ><b>Point</b></td>		
</tr>
<?
$cnt=0;
$data= mysqli_query($conn,"select * from  main_point where sl>0 $a2 $psl1") or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data))
{
	$cnt++;	
	$sl=$row1['sl'];
    $psl=$row1['pcd'];
    $pack=$row1['pack'];
    $point=$row1['point'];


    $q12="SELECT * FROM main_product where sl='$psl'";
	$r12=mysqli_query($conn,$q12);
	while ($N=mysqli_fetch_array($r12))
	{
		$pname=$N['pname'];
	}
?>		 
<tr>			
<td  align="center" ><?=$cnt;?></td>
<td  align="left" ><?=$pname;?></td>
<td  align="center" ><?=$pack;?></td>
<td  align="center" >
<div id="pack<?=$sl;?>">
<a href="#" onclick="sedt('<?=$sl;?>','point','<?=$point;?>','pack<?=$sl;?>')"><b><?=$point;?></b></a>
</div>
</td>
</tr>	 			 				 
<?
}
?>
</tr>
</table>