<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$cdt = date('Y-m-d');
$dttm = date('d-m-Y H:i:s a');
$stk_dt = $_REQUEST['stk_dt'];
$dt = $_REQUEST['dt'];
$cat = $_REQUEST['cat'];
$scat = $_REQUEST['scat'];
$fdt = $_REQUEST['fdt'];
$tdt = $_REQUEST['tdt'];
$stk_godown = $_REQUEST['stk_godown'];

$fdt = date('Y-m-d', strtotime($fdt));
$tdt = date('Y-m-d', strtotime($tdt));

if ($fdt != "" and $tdt != "") {
	$todt = " and dt between '$fdt' and '$tdt'";
} else {
	$todt = "";
}
$stk_godown1="";
if($stk_godown!="")
{
	$stk_godown1=" and sl='$stk_godown'";
}


set_time_limit(0);
//$stk_dt="2020-09-13";
//$dt="2020-09-14"; 

$logx=0;
$dt = date('Y-m-d', strtotime($stk_dt));
$stk_dt = date('Y-m-d', strtotime($stk_dt));
$data5 = mysqli_query($conn, "select * from  main_openingdtl where sl>0 and cat='$cat' and scat='$scat' and rqty='0' $todt  group by prsl ") or die(mysqli_error($conn));
$counnt=mysqli_num_rows($data5);
if($counnt>0)
{
	$logx++;
}
//echo "select * from  main_openingdtl where sl>0 and cat='$cat' and scat='$scat' $todt  group by prsl ";
$data = mysqli_query($conn, "select * from  main_product where sl>0 and cat='$cat' and scat='$scat' ") or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data)) {
	$unit = 'sun';
	$prnm = $row['sl'];


	 $query = "Select * from main_godown where sl>0 $stk_godown1";
	$result = mysqli_query($conn, $query);
	while ($R = mysqli_fetch_array($result)) {
		$brncd = $R['sl'];


		$stk_rate = 0;
		$rate = 0;
		$query41 = "Select * from main_stock where pcd='$prnm' and stk_rate>0 and rate>0  order by sl desc limit 0,1";
		$result41 = mysqli_query($conn, $query41);
		while ($R4 = mysqli_fetch_array($result41)) {
			$stk_rate = $R4['stk_rate'];
			$rate = $R4['rate'];
			$total = $R4['total'];
		}


		$qty = 0;
		 $query4 = "Select sum(opst+stin-stout) as stck1 from main_stock where pcd='$prnm' and bcd='$brncd'  and dt<='$stk_dt'";
		$result4 = mysqli_query($conn, $query4);
		while ($R4 = mysqli_fetch_array($result4)) {
			$qty = $R4['stck1'];
		}

		if ($qty != 0) {


			$get = mysqli_query($conn, "select * from " . $DBprefix . "unit where cat='$prnm'") or die(mysqli_error($conn));
			while ($roww = mysqli_fetch_array($get)) {
				$sun = $roww['sun'];
				$mun = $roww['mun'];
				$bun = $roww['bun'];
				$smvlu = $roww['smvlu'];
				$mdvlu = $roww['mdvlu'];
				$bgvlu = $roww['bgvlu'];
				$usl = $roww['sl'];
			}
			$refno = "Adjustment-" . $cat . "-" . $scat . "-" . $stk_dt;
			if ($qty > 0) {
				if ($unit == 'sun') {
					$stock_in = $qty * $smvlu;
					$rate1 = $rate / $smvlu;
					$uval = $smvlu;
				}
				if ($unit == 'mun') {
					$stock_in = $qty * $mdvlu;
					$rate1 = $rate / $mdvlu;
					$uval = $mdvlu;
				}
				if ($unit == 'bun') {
					$stock_in = $qty * $bgvlu;
					$rate1 = $rate / $bgvlu;
					$uval = $bgvlu;
				}

				echo $query21 = "INSERT INTO " . $DBprefix . "stock (pcd,bcd,dt,unit,stout,nrtn,eby,dtm,stat,ret,refno,usl,uval,betno,rate,stk_rate,sbill,lot)
VALUES ('$prnm','$brncd','$stk_dt','$unit','$stock_in','Adjustment','$user_currently_loged','$dttm','1','$rate','$refno','$usl','$uval','$betno','$rate','$stk_rate','Adjustment','$prnm')";
				$result21 = mysqli_query($conn, $query21) or die(mysqli_error($conn));
				echo "<br>";
			} else {
				$qty = ($qty * (-1));
				if ($unit == 'sun') {
					$stock_in = $qty * $smvlu;
					$rate1 = $rate / $smvlu;
					$uval = $smvlu;
				}
				if ($unit == 'mun') {
					$stock_in = $qty * $mdvlu;
					$rate1 = $rate / $mdvlu;
					$uval = $mdvlu;
				}
				if ($unit == 'bun') {
					$stock_in = $qty * $bgvlu;
					$rate1 = $rate / $bgvlu;
					$uval = $bgvlu;
				}
				echo $query21 = "INSERT INTO " . $DBprefix . "stock (pcd,bcd,dt,unit,stin,nrtn,eby,dtm,stat,ret,refno,usl,uval,betno,rate,stk_rate,lot)
VALUES ('$prnm','$brncd','$stk_dt','$unit','$stock_in','Adjustment','$user_currently_loged','$dttm','1','$rate','$refno','$usl','$uval','$betno','$rate','$stk_rate','$prnm')";
				$result21 = mysqli_query($conn, $query21) or die(mysqli_error($conn));

				echo "<br>";
			}

			echo "<br>";
		}
	}

}
if($logx>0)
{
	
	$get = mysqli_query($conn, "update main_openingdtl set rqty='2' where sl>0 and cat='$cat' and scat='$scat' and rqty='0' $todt") or die(mysqli_error($conn));

echo "<center><font color='red' size='5'>Stcok Clear Sucess</font></center>";

}
else
{
	echo "<center><font color='red' size='5'>Sorry, Product Not Available</font></center>";
}