<?
$reqlevel = 3; 

include("membersonly.inc.php");

$srch=rawurldecode($_REQUEST['srch']);

$af="%".$srch."%";
if($srch!='')
{
$a2="and (pack LIKE '$af')";
}
else
{
$a2='';
}
$psl=$_REQUEST[psl];
if($psl==""){
	$psl1="";
	}
	else
	{
		$psl1=" and psl='$psl'";
    }

?>
<table  class="table table-hover table-striped table-bordered"  >	
<tr>
<td  align="center" width="4%"><b>Sl</b></td>
<td  align="center" width="6%"><b>Product Name</b></td>
<td  align="center" width="6%" ><b>Pack</b></td>		
</tr>
<?
$cnt=0;
$data= mysqli_query($conn,"select * from  main_pack where sl>0 ".$a2.$psl1) or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data))
{
	$cnt++;	
	$sl=$row1['sl'];
    $psl=$row1['psl'];
    $pack=$row1['pack'];


    $q12="SELECT * FROM main_product where sl='$psl'";
	$r12=mysqli_query($conn,$q12);
	while ($N=mysqli_fetch_array($r12))
	{
		$pname=$N['pname'];
	}
?>		 
<tr>			
<td  align="center" ><?=$cnt;?></td>
<td  align="left" ><?=$pname;?>
</td>
<td  align="center" >
<div id="pack<?=$sl;?>">
<a href="#" onclick="sedt('<?echo $sl;?>','pack','<?echo $pack;?>','pack<?=$sl;?>')"><b><?=$pack;?></b></a>
</div>
</td>
</tr>	 			 				 
<?
}
?>
</tr>
</table>