<?php 
$reqlevel = 1;
include("membersonly.inc.php");
$edtm = date('d-m-Y h:i:s a', time());
$edt = date('Y-m-d');
$brncd = $_REQUEST['brncd'];
$dt = $_REQUEST['dt'];
$cldgr = $_REQUEST['cldgr'];
$cid = $_REQUEST['cid'];
$nrtn = $_REQUEST['nrtn'];
$proj = $_REQUEST['proj'];
$it = $_REQUEST['it'];
$bsl = $_POST['bsl'];
$btyp = $_POST['btyp'];
$dldgr = $_POST['dldgr'];
$paymtd = $_POST['paymtd'];
$tamm = $_POST['tamm'];
$refno = $_POST['refno'];
$ramm = $_POST['ramm'];
$blno_ref = $_POST['blno_ref'];
$spid = $_POST['spid'];

set_time_limit(0);
$err="";
$edit_count = get_permission($dt, $recv_edt);
if ($edit_count == 0) {
	die('<b><center><font color="red" size="5">Please Check Your Input Date, Contact Administrator. Please Go Back Previous Page....</font></center></b>');
}

$get = mysqli_query($conn, "select * from main_billtype where sl='$bsl'") or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($get)) {
	$als = $row['als'];
	$ssn = $row['ssn'];
	$start_no = $row['start_no'];
}


if ($dt == '' or $cldgr == '' or $cid == '' or $tamm < 1) {
	$err = "Please Fill All The Fields..!!";
}

if ($dt == "") {
	$dt = "0000-00-00";
} else if ($dt == "00-00-0000") {
	$dt = "0000-00-00";
} else {
	$dt = date('Y-m-d', strtotime($dt));
}

$query1001 = "SELECT * FROM main_recv_reg_temp where eby='$user_currently_loged' and cid='$cid' and app_ref='$blno_ref' order by sl";
$result1001 = mysqli_query($conn, $query1001) or die(mysqli_error($conn));
$ccount = mysqli_num_rows($result1001);
if ($ccount == 0) {
	$err = "Please ADD Some Row...";
}
if ($err == "") {

	$blno1 = $blno_ref;

	$query51 = "select * from " . $DBprefix . "drcr where blno='$blno1'";
	$result51 = mysqli_query($conn, $query51) or die(mysqli_error($conn));
	while ($rows = mysqli_fetch_array($result51)) {
		$vcno = $rows['vno'];
		$blnon = $rows['blnon'];
	}


	$query31 = "update main_recv set bcd='$brncd',dt='$dt',cid='$cid',nrtn='$nrtn',dldgr='$dldgr',paymtd='$paymtd',tamm='$tamm',refno='$refno',spid='$spid' where blno='$blno1'";
	$result31 = mysqli_query($conn, $query31) or die(mysqli_error($conn));



	$query31 = "update main_recv_app set bcd='$brncd',dt='$dt',cid='$cid',nrtn='$nrtn',dldgr='$dldgr',paymtd='$paymtd',tamm='$tamm',refno='$refno',spid='$spid' where blno='$blno1'";
	$result31 = mysqli_query($conn, $query31) or die(mysqli_error($conn));


	$query511 = "select * from main_recv_app where blno='$blno1'";
	$result511 = mysqli_query($conn, $query51) or die(mysqli_error($conn));
	$count = mysqli_num_rows($result511);

	if ($blno1 != '') {
		mysqli_query($conn, "DELETE FROM main_recv_dtl WHERE ref='$blno1' ") or die(mysqli_error($conn));
		mysqli_query($conn, "DELETE FROM main_recv_dtl_app WHERE ref='$blno1' ") or die(mysqli_error($conn));
		mysqli_query($conn, "DELETE FROM main_drcr WHERE blno='$blno1' ") or die(mysqli_error($conn));
	}
	$query100 = "SELECT * FROM main_recv_reg_temp where eby='$user_currently_loged' and cid='$cid' and app_ref='$blno_ref' order by sl";
	$result100 = mysqli_query($conn, $query100) or die(mysqli_error($conn));
	while ($R100 = mysqli_fetch_array($result100)) {
		$tsl = $R100['sl'];
		$blno = $R100['blno'];
		$blno_add = $R100['blno'];
		$amm = $R100['amm'];
		$sman = $R100['sman'];
		$cid = $R100['cid'];
		$disl = $R100['disl'];
		$damm = $R100['damm'];
		$remk = $R100['remk'];



		$query21 = "INSERT INTO main_recv_dtl(ref,blno,amm,sman,cid,eby,brncd,disl,damm,remk)
VALUES ('$blno1','$blno','$amm','$spid','$cid','$user_currently_loged','$brncd','$disl','$damm','$remk')";
		$result21 = mysqli_query($conn, $query21) or die(mysqli_error($conn));

		if ($count > 0) {
			$query21 = "INSERT INTO main_recv_dtl_app(ref,blno,amm,sman,cid,eby,brncd,disl,damm,remk)
VALUES ('$blno1','$blno','$amm','$spid','$cid','$user_currently_loged','$brncd','$disl','$damm','$remk')";
			$result21 = mysqli_query($conn, $query21) or die(mysqli_error($conn));
		}
		if ($blno == "ADVANCE-PAYMENT") {
			$blno = "";
			$cldgr = '7';
			$typ = "ADV77";
		} else {
			$typ = "77";
		}
		if ($blno_add == 'ADVANCE-PAYMENT' && $dldgr == '7') {
		} else {
			$query31 = "INSERT INTO main_drcr (vno,dt,nrtn,typ,dldgr,mtd,mtddtl,cldgr,amm,eby,edtm,cid,brncd,cbill,sman,btyp,als,ssn,bill_typ,blnon,blno) VALUES 
('$vcno','$dt','$nrtn','$typ','$dldgr','$paymtd','$refno','$cldgr','$amm','$user_currently_loged','$edtm','$cid','$brncd','$blno','$spid','$btyp','$als','$ssn','$bsl','$blnon','$blno1')";
			$result31 = mysqli_query($conn, $query31) or die(mysqli_error($conn));
		}
		if ($damm > 0) {
			$query31 = "INSERT INTO main_drcr (vno,dt,nrtn,typ,dldgr,cldgr,amm,eby,edtm,cid,brncd,cbill,sman,btyp,als,ssn,bill_typ,blnon,blno) VALUES 
('$vcno','$dt','$remk','CC01','$disl','$cldgr','$damm','$user_currently_loged','$edtm','$cid','$brncd','$blno','$spid','$btyp','$als','$ssn','$bsl','$blnon','$blno1')";
			$result31 = mysqli_query($conn, $query31) or die(mysqli_error($conn));
		}

		$T = 0;
		$t1 = 0;
		$t2 = 0;
		$data = mysqli_query($conn, "SELECT sum(amm) as t1 FROM main_drcr where  cbill='$blno' and dldgr='4'");
		while ($row = mysqli_fetch_array($data)) {
			$t1 = $row['t1'];
		}
		$data1 = mysqli_query($conn, "SELECT sum(amm) as t2 FROM main_drcr where cbill='$blno' and cldgr='4'");
		while ($row1 = mysqli_fetch_array($data1)) {
			$t2 = $row1['t2'];
		}
		$T = round($t1 - $t2, 0);
		if ($T == 0) {
			$qr = mysqli_query($conn, "update main_drcr set paid='1' where cbill='$blno'") or die(mysqli_error($conn));
		} else {
			$qr = mysqli_query($conn, "update main_drcr set paid='0' where cbill='$blno'") or die(mysqli_error($conn));
		}
	}

	mysqli_query($conn, "DELETE FROM main_recv_reg_temp WHERE eby='$user_currently_loged' ") or die(mysqli_error($conn));


?>
	<script language="javascript">
		alert('Update Successfully. Thank You..!');
		document.location = "final_cltn.php";
	</script>
<?php 
} else {
?>
	<script language="javascript">
		alert('<?php echo  $err; ?>');
		document.location = "final_cltn.php";
	</script>
<?php 
}
