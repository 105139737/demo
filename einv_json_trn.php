<?php 
include 'config.php';
//include "../function.php";
$cgst_am=0;
$sgst_am=0;
$igst_am=0;
$disp=0;
$disa1=0;
$err_log="";
require("function.php");
$blno = $_REQUEST['blno'];
$query1 = "Select * from main_cnm ";
$result1 = mysqli_query($conn, $query1);
while ($R = mysqli_fetch_array($result1)) {
	$comp_nm = $R['cnm'];
	$comp_addr = $R['addr'];
	$cont = $R['cont'];
	$comp_gstin = $R['gstin'];
	$branch1 = $R['branch1'];
	$branch2 = $R['branch2'];
	$ifsc1 = $R['ifsc1'];
	$ifsc2 = $R['ifsc2'];
	$ac1 = $R['ac1'];
	$ac2 = $R['ac2'];
	$acnm1 = $R['acnm1'];
	$acnm2 = $R['acnm2'];
}

$total_am = 0;
$i = 0;

$totalValue = 0;
$cgstValue = 0;
$result5 = mysqli_query($conn, "select * from main_trns where  blno='$blno' ");
$count6 = mysqli_num_rows($result5);
if ($count6 > 0) {
	while ($row1 = mysqli_fetch_array($result5)) {
		$sl = $row1['sl'];
		$tbcd = $row1['tbcd'];
		$dt = $row1['dt'];
		$trn_dt = $row1['dt'];
		$transDistance = $row1['transDistance'];
		$vno = $row1['vno'];

		$file_name = $sl . "_" . date('d_m_Y', strtotime($dt)) . "_" . date('his');
		$cnt_sl = 0;
		$i2 = 0;

		$select_q1 = mysqli_query($conn, "select sum(qty) as total_qty,prsl,fbcd from main_trndtl where blno='$blno' group by prsl") or die(mysqli_error($conn));
		while ($row2 = mysqli_fetch_array($select_q1)) {
			$total_qty = $row2['total_qty'];
			$prsl = $row2['prsl'];
			$fbcd = $row2['fbcd'];
			$cgst = 0;
			$data1 = mysqli_query($conn, "Select * from main_gst where cat='$prsl' and '$trn_dt' between fdt and tdt") or die(mysqli_error($conn));
			while ($row1 = mysqli_fetch_array($data1)) {
				$cgst = $row1['cgst'];
				$sgst = $row1['sgst'];
				$igst = $row1['igst'];
			}
			$rate = get_avg_rate($conn, $prsl, $dt);
			$totalValue += round($total_qty * $rate, 2);
			$cgstValue = round((round($total_qty * $rate, 2) * $cgst) / 100,2);
		}
		$data = mysqli_query($conn, "select * from main_godown where  sl='$tbcd'") or die(mysqli_error($conn));
		while ($row = mysqli_fetch_array($data)) {
			$tbnm = $row['gnm'];
			$taddr = $row['addr'];
			$tbcnt = $row['bcnt'] ?? "";
			$dist = $row['dist'];
			$pin = $row['pin'];
		}
		$data = mysqli_query($conn, "select * from main_godown where  sl='$fbcd'") or die(mysqli_error($conn));
		while ($row = mysqli_fetch_array($data)) {
			$fbnm = $row['gnm'];
			$faddr = $row['addr'];
			$fbcnt = $row['bcnt'] ?? "";
			$fdist = $row['dist'];
			$fpin = $row['pin'];
		}

		$gbit = mysqli_query($conn, "select * from main_state where sl='1'") or die(mysqli_error($conn));
		while ($GBi = mysqli_fetch_array($gbit)) {
			$statnm = $GBi['sn'];
			$tst = $GBi['cd'];
		}

		$dt = date('d/m/Y', strtotime($dt));
		if($vno==""){$err_log="Vehicle Number  Not found.";}
		if($transDistance==""){$err_log="Distance  Not found.";}
		if($transDistance==""){$err_log="Distance  Not found.";}
		if($fdist=="" or $fpin==""){$err_log="From Godown District or Pin  Not found.";}
		if($dist=="" or $pin==""){$err_log="To Godown District or Pin  Not found.";}
		$docNo=explode("/",$blno);
		$docNo=$docNo[1]."/".$docNo[2];
		$myObj = '  {
    "version":"1.0.0621",
        "billLists":[{
               "userGstin":"' . $comp_gstin . '",
               "supplyType":"O",
               "subSupplyType":5,
               "docType":"CHL",
               "docNo":"' . $docNo . '",
               "docDate":"' . $dt . '",
               "transType":1,
               "fromGstin":"' . $comp_gstin . '",
               "fromTrdName":"' . $comp_nm . '",
               "fromAddr1":"' . $faddr . '",
               "fromAddr2":null,
               "fromPlace":"'.$fdist.'",
               "fromPincode":'.$fpin.',
               "fromStateCode":19,
               "actualFromStateCode":19,
               "toGstin":"' . $comp_gstin . '",
               "toTrdName":"' . $comp_nm . '",
               "toAddr1":"' . $taddr . '",
               "toAddr2":null,
               "toPlace":"' . $dist . '",
               "toPincode":' . $pin . ',
               "toStateCode":19,
               "actualToStateCode":19,
               "totalValue":' . $totalValue . ',
               "cgstValue":' . $cgstValue . ',
               "sgstValue":' . $cgstValue . ',
               "igstValue":0,
               "cessValue":0,
               "TotNonAdvolVal":0,
               "OthValue":0,
               "totInvValue":' . ($totalValue + $cgstValue + $cgstValue) . ',
               "transMode":1,
               "transDistance":' . $transDistance . ',
               "transporterName":"",
               "transporterId":"",
               "transDocNo":"",
               "transDocDate":"",
               "vehicleNo":"'.$vno.'",
               "vehicleType":"R",';

		$myObj .= '
   "ItemList": [';

		$item_list = "";
		$cnt_sl=0;
		$select_q = mysqli_query($conn, "select * from main_trndtl where blno='$blno'");
		while ($row2 = mysqli_fetch_array($select_q)) {
			$cnt_sl++;
			$fbcd = $row2['fbcd'];
			$prsl = $row2['prsl'];
			$qty = $row2['qty'];


			$select_q34 = mysqli_query($conn, "select * from main_product where sl='$prsl'");
			while ($row34 = mysqli_fetch_array($select_q34)) {
				$hsn = $row34['hsn'];
				$pnm = $row34['pnm'];
				/*$hsn=substr($hsn, 0, 4);*/
			}
			$data1 = mysqli_query($conn, "Select * from main_gst where cat='$prsl' and '$trn_dt' between fdt and tdt") or die(mysqli_error($conn));
			while ($row1 = mysqli_fetch_array($data1)) {
				$cgst = $row1['cgst'];
				$sgst = $row1['sgst'];
				$igst = $row1['igst'];
			}
			$pgst = $cgst_am + $sgst_am + $igst_am;
			if ($disp == 0) {
				if ($disa1 > 0) {
					$disp = round(($disa1 * 100) / $total, 2);
				}
			}
			$rate = get_avg_rate($conn, $prsl, $trn_dt);
			$totalValue = round($qty * $rate, 2);
			$cgstValue = (round($total_qty * $rate, 2) * $cgst) / 100;

			if ($item_list == '') {
				$item_list = ' 
				{
				"itemNo":'.$cnt_sl.',
				"productName":"'.$pnm.'",
				"productDesc":"'.$pnm.'",
				"hsnCode":"'.$hsn.'",
				"quantity":'.$qty.',
				"qtyUnit":"PCS",
				"taxableAmount":'.$totalValue.',
				"sgstRate":'.$cgst.',
				"cgstRate":'.$cgst.',
				"igstRate":0,
				"cessRate":0,
				"cessNonAdvol":0
				}';
							} else {
				$item_list .= ', 
				{
				"itemNo":'.$cnt_sl.',
				"productName":"'.$pnm.'",
				"productDesc":"'.$pnm.'",
				"hsnCode":"'.$hsn.'",
				"quantity":'.$qty.',
				"qtyUnit":"PCS",
				"taxableAmount":'.$totalValue.',
				"sgstRate":'.$cgst.',
				"cgstRate":'.$cgst.',
				"igstRate":0,
				"cessRate":0,
				"cessNonAdvol":0
				}';
			}
		}
		$myObj .= $item_list . '     
    ]
  }
]
}

';

		$err = false;
		$message = "Data Available";
		$i++;
	}
} else {
	$err = true;
	$message = "Data Not Available";
}
//echo $myObj;
//$items = json_decode($myObj);

if ($err_log == "") {
	$resultup = mysqli_query($conn, "update main_trns set colorStatus=1 where blno='$blno' ");
	header('Content-disposition: attachment; filename=' . $file_name . '.json');
	header('Content-type: application/json');
	//$myJSON = json_encode($myObj, true);
	echo $myObj;
} else {
?>
	<center>
		<font size="7" color="red"><?php  echo $err_log; ?></font>
	</center>
<?php 
}
