<?
$reqlevel = 3; 
include("membersonly.inc.php");
$brncd=$_REQUEST['brncd'];
$ldgr=$_REQUEST['ldgr'];
$cust=$_REQUEST['cust'];
$sup=$_REQUEST['sup'];

if($brncd==""){$brncd1="";}else{$brncd1=" and brncd='$brncd'";}
if($ldgr==""){$ldgr1="";}else{$ldgr1=" and (dldgr='$ldgr' or cldgr='$ldgr')";}
if($cust==""){$cust1="";}else{$cust1=" and cid='$cust'";}
if($sup==""){$sup1="";}else{$sup1=" and sid='$sup'";}

?>
<table class="table table-hover table-striped table-bordered">

<tr style="height: 30px;">
<th align="center" width="5%">Sl.</th>
<th align="center" width="12%">Branch</th>
<th align="center" width="15%">Ledger Head</th>
<th align="center" width="10%">Opening Balance</th>
<th align="center" width="10%">Dr. / Cr.</th>
<th align="center" width="25%">Narration</th>
<td align="center" width="5%"><b>Edit</b></td>
</tr>
<?
		$f=0;
		$totamm=0;
$data= mysqli_query($conn,"SELECT * FROM main_drcr where typ='11' and dldgr!='4' and cldgr!='4' $brncd1 $ldgr1 $cust1 $sup1 order by dt desc");
while ($row = mysqli_fetch_array($data))
		{
		$sl= $row['sl'];
		$pno= $row['pno'];
		$cldgr= $row['cldgr'];
		$dldgr= $row['dldgr'];
		$amm= $row['amm'];
		$nrtn= $row['nrtn'];
		$eby= $row['eby'];
		$edt= $row['edt'];
		$cid= $row['cid'];
		$sid= $row['sid'];
		$brncd= $row['brncd'];
		$cunm="";
		$cont="";
		$addr="";
		$query6="select * from  main_cust where sl='$cid'";
		$result5 = mysqli_query($conn,$query6);
		while($row=mysqli_fetch_array($result5))
		{
		$cnm=$row['nm'];
		$addr=$row['addr'];
		$cont=$row['cont'];
		}
		$snm="";
		$query6="select * from  main_suppl where sl='$sid'";
		$result5 = mysqli_query($conn,$query6);
		while($row=mysqli_fetch_array($result5))
		{
		$snm=$row['spn'];
		}
		$var="";
		if($cldgr==12  or $dldgr==12 )
		{
			$var=" : ".$snm."";
		}
		else
		{
			if($cldgr==4  or $dldgr==4 )
		{
			$var=" : <b>".$cnm."</b> (".$addr.") ";
		}
		else
		{
			$var="";
		}
			
		}
		$proj="";
		$get2 = mysqli_query($conn,"SELECT * FROM main_project where sl='$pno'") or die(mysqli_error($conn));
		while($row2 = mysqli_fetch_array($get2))
		{
		$proj=$row2['nm'];
		}
		$query="Select * from main_branch where sl='$brncd'";
   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$slb=$R['sl'];
$bnm=$R['bnm'];
}
		
		if($pno=='0')
		{$proj='NA';
		}
		if($nrtn=='')
		{$nrtn='NA';
		}
		
		
		
		if($cldgr==-1)
		{$ldgr=$dldgr;
		 $drcr="Dr.";
		}
		else
		{$ldgr=$cldgr;
		$drcr="Cr.";
		}
		
								$data1= mysqli_query($conn,"SELECT * FROM main_ledg where sl='$ldgr'");
								while ($row1 = mysqli_fetch_array($data1))
								{
									$ldgr= $row1['nm'];
								}
								
								
															
		$f++;
		if($f%2==0)
		{$cls="odd";
		}
		else
		{$cls="even";
		}
		$dt=date('d-M-Y', strtotime($dt));
?>
<tr class="<?echo $cls;?>" style="height: 20px;">
<td align="left" valign="top"><a href="#" title="By : <?=$eby;?> | On :<?=$edt;?>"><b><?echo $f;?></b></td>
<td align="left" valign="top"><?echo $bnm;?></td>
<td align="left" valign="top"><?echo $ldgr.$var;?></td>
<td align="right" valign="top" align="right"><font color="red">Rs. <b><?echo number_format($amm,2);?></b></font></td>
<td align="left" valign="top"><?echo $drcr;?></td>
<td align="left" valign="top"><?echo $nrtn;?></td>
<td align="center" valign="top">
<a href="#" onclick="sfdtl4('<? echo $sl; ?>')" title="Edit"> <i class="fa fa-edit"></i></a>
</td>
</tr>
<?
$totamm=$amm+$totamm;
}
?>
<tr>
<td colspan="3" align="right"><b>Total : </b></td><td align="right"><b><?echo number_format($totamm,2);?></b></td>
</tr>
</table>