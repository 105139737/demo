<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$sl=$_REQUEST['sl'] ?? "";
$brncd=$_REQUEST['brncd'] ?? "";if($brncd==""){$brncd1="";}else{$brncd1=" and brncd='$brncd'";}

$data= mysqli_query($conn,"SELECT sum(amm) as t1 FROM main_drcr where dldgr='$sl' and stat='1'".$brncd1);
		while ($row = mysqli_fetch_array($data))
		{
			$t1 = $row['t1'];
		}
		

$data1= mysqli_query($conn,"SELECT sum(amm) as t2 FROM main_drcr where cldgr='$sl' and stat='1'".$brncd1);
	while ($row1 = mysqli_fetch_array($data1))
		{
		$t2 = $row1['t2'];
		}
		$T=$t1-$t2;
	
		?>
		 <img src="images\rp.png" height="15px"><input type="text" name="dbal" id="dbal" size="35" value="<?php echo $T;?>" style="background :transparent; color : red;" readonly>
