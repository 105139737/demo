<?php 
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
include "function.php";
$cid="";
$cr_tm = date('H:i');
$ndl_tm = strtotime("+30 minute", strtotime($cr_tm));
$dl_tm = date('H:i', $ndl_tm);
?>
<html>
<div class="wrapper row-offcanvas row-offcanvas-left">
	<?php 
	include "left_bar.php";
	?>

	<head>
		<style type="text/css">
			th {
				text-align: center;
				color: #FFF;
				border: 1px solid #37880a;
			}

			input:focus {

				background-color: Aqua;
			}

			a {
				cursor: pointer;
			}

			select.sc {
				width: 280px;
				font-family: Verdana, Geneva, sans-serif;
				font-size: 12px;
				color: #666666;
				border: 1px solid #d8d8d8;
				padding-top: 2px;
				padding-right: 0px;
				padding-bottom: 2px;
				padding-left: 7px;
				padding: 7px;
			}

			select.sc1 {
				width: 100%;
				font-family: Verdana, Geneva, sans-serif;
				font-size: 12px;
				color: #666666;
				border: 1px solid #d8d8d8;
				padding-top: 2px;
				padding-right: 0px;
				padding-bottom: 2px;
				padding-left: 7px;
				padding: 4px;
			}
		</style>
		<link rel="stylesheet" href="cupertino/jquery.ui.all.css" type="text/css">
		<style type="text/css">
			.ui-datepicker {
				font-family: Arial;
				font-size: 13px;
				z-index: 1003 !important;
				display: none;
			}
		</style>

		<link href="advancedtable.css" rel="stylesheet" type="text/css" />
		<link href="style.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript">
			function isNumber(evt) {
				var iKeyCode = (evt.which) ? evt.which : evt.keyCode
				if (iKeyCode < 48 || iKeyCode > 57) {
					return false;
				}
				return true;
			}

			function spaces(myString) {
				document.getElementById('betno').value = myString.split(' ').join('');
			}

			function getb() {
				pcd = document.getElementById('prnm').value;
				fbcd = document.getElementById('bcd').value;
				//$("#gbet").load("getbe_trn.php?pcd=" + pcd + '&fbcd=' + fbcd).fadeIn('fast');
			}

			function add() {
				var prnm = document.getElementById('prnm').value;
				var qty = document.getElementById('qnty').value;
				var fbcd = document.getElementById('bcd').value;
				var tbcd = document.getElementById('tbcd').value;
				var sih = document.getElementById('sih').value;
				var unit = document.getElementById('unit').value;
				var usl = document.getElementById('usl').value;
				var betno = document.getElementById('betno').value;
				var remk = encodeURIComponent(document.getElementById('remk').value);
				$('#wb_Text13').load('adtmppr_trn.php?prnm=' + prnm + '&qty=' + qty + '&fbcd=' + fbcd + '&tbcd=' + tbcd + '&sih=' + sih + '&remk=' + remk + '&unit=' + unit + '&usl=' + usl + '&betno=' + betno).fadeIn('fast');
			}

			function reset() {
				prnm = document.getElementById('prnm').value
				$("#prnm option[value='" + prnm + "']").remove();
				$('#prnm').trigger("chosen:updated");
				document.getElementById('qnty').value = "";
				document.getElementById('sih').value = "";
				document.getElementById('remk').value = "";
				document.getElementById('betno').value = "";
			}

			function temp() {
				$('#wb_Text13').load("tmppr_trn.php").fadeIn('fast');
				//$('#fbcd_div').load("fbcd_get.php").fadeIn('fast');
			}

			function deltpr(sl) {
				$('#wb_Text13').load("deltpr_trn.php?sl=" + sl).fadeIn('fast');
			}

			function gtt_unt() {
				prnm = document.getElementById('prnm').value;
				$("#g_unt").load("get_unt.php?prnm=" + prnm).fadeIn('fast');
			}

			function product() {
				fbcd = document.getElementById('fbcd').value;
				//$("#product").load("product_stk_trn.php?fbcd="+fbcd).fadeIn('fast');
			}

			function cbcd() {
				var fbcd = document.getElementById('fbcd').value;
				$('#bb').load('cbcd.php?fbcd=' + fbcd).fadeIn('fast');
				getb();
			}

			function check() {
				if (document.form1.tbcd.value == '') {
					alert("Please Select Send Branch !");
					$('#tbcd').focus();
					return false;
				} else {

					if (confirm("Are Sure To Submit ?")) {
						document.forms["form1"].submit();
					}
				}
			}

			function get_betno(betno = '') {
				if (betno == 'undefined' || betno == '') {
					betno = '';
				}
				prnm = document.getElementById('prnm').value;
				bcd = document.getElementById('bcd').value;
				betnoo = '';
				$("#g_betno").load("get_betno_trn.php?prnm=" + prnm + '&bcd=' + bcd + '&betnoo=' + betno).fadeIn('fast');
			}

			function godown() {
				prnm = document.getElementById('prnm').value;
				$("#g_gwn").load("get_gwn_trn.php?prnm=" + prnm).fadeIn('fast');
			}

			function get_scat(scat = '') {
				var cat = document.getElementById('cat1').value;
				$("#scatdiv").load("get_scat_pur.php?cat=" + cat + "&scat=" + scat).fadeIn('fast');
			}

			function get_prod(psl = '') {
				var scat = document.getElementById('scat1').value;
				var cat = document.getElementById('cat1').value;
				//$("#prod_div").load("get_product_trn.php?cat="+cat+"&scat="+scat+"&psl="+psl).fadeIn('fast');	
			}

			function get_prod_by_name(psl = '') {
				var scat = document.getElementById('scat1').value;
				var cat = document.getElementById('cat1').value;
				var prnm3 = encodeURIComponent(document.getElementById('prnm3').value);
				if (cat == '') {
					alert("Please Select Brand first ! ");
					return;
				}
				if (prnm3.length > 2) {
					$("#prod_div").load("get_product_trn.php?cat=" + cat + "&scat=" + scat + "&psl=" + psl + "&prnm3=" + prnm3).fadeIn('fast');
				}
			}
		</script>
	</head>

	<body onload="temp(),cbcd()">
		<aside class="right-side">
			<section class="content-header">
				<h1 align="center">
					Stock Transfer
					<small> Transfer</small>
				</h1>
				<ol class="breadcrumb">
					<li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
					<li class="active">Stock Transfer</li>
				</ol>
			</section>
			<section class="content">
				<form method="post" target="" name="form1" id="form1" action="transfers.php">
					<div class="box box-success">
						<font color="#00a65a"> Godown :</font>
						<table border="0" width="860px" class="table table-hover table-striped table-bordered">
							<tr>
								<td align="right" style="padding-top:10px" width="10%">
									<font size="4"><b>To Godown :</b></font>
								</td>
								<td align="left" width="35%">
									<div id="bb">
										<select name="tbcd" class="form-control" size="1" tabindex="1" id="tbcd">
											<option value="">---Select---</option>
										</select>
									</div>
								</td>
								<td align="right" hidden style="padding-top:10px" width="20%">
									<font size="4"><b>From :</b></font>
								</td>
								<td align="left" hidden width="30%">
									<div id="fbcd_div">
										<?php $fbcd="";
										$query100 = "SELECT * FROM " . $DBprefix . "trntemp where eby='$user_currently_loged' order by sl";
										$result100 = mysqli_query($conn, $query100);
										while ($R100 = mysqli_fetch_array($result100)) {
											$fbcd = $R100['fbcd'];
										}
										if ($fbcd != "") {
										?>
											<select name="fbcd" class="form-control" size="1" id="fbcd" tabindex="1" onchange="cbcd(),product()">
												<?php 
												$query = "Select * from main_godown where sl='$fbcd' and stat=1";
												$result = mysqli_query($conn, $query);
												while ($R = mysqli_fetch_array($result)) {
													$sl = $R['sl'];
													$bnm = $R['bnm'];
													$gnm = $R['gnm'];


												?>
													<option value="<?php  echo $sl; ?>"><?php  echo $gnm; ?></option>
												<?php 
												}
												?>
											</select>
										<?php 
										} else {
										?>
											<select name="fbcd" class="form-control" size="1" tabindex="1" id="fbcd" onchange="cbcd();product()">
												<?php 
												$query = "Select * from main_godown where stat=1 ";
												$result = mysqli_query($conn, $query);
												while ($R = mysqli_fetch_array($result)) {
													$sl = $R['sl'];
													$bnm = $R['bnm'];
													$gnm = $R['gnm'];

												?>
													<option value="<?php  echo $sl; ?>"><?php  echo $gnm; ?></option>
												<?php 
												}
												?>
											</select>
										<?php  } ?>
									</div>
								</td>
								<td align="right" style="padding-top:10px" width="10%">
									<font size="4"><b>Distance :</b></font>
								</td>
								<td align="left" width="35%">
									<input type="text" id="transDistance" name="transDistance" class="form-control">
								</td>
							</tr>
						</table>
					</div>

					<div class="box box-success">
						<table>
							<tr>
								<td>

									<select name="cat1" class="form-control" size="1" id="cat1" tabindex="1" onchange="get_scat();get_prod()">
										<Option value="">---Brand---</option>
										<?php 
										$data1 = mysqli_query($conn, "Select * from main_catg where stat='0' order by cnm");
										while ($row1 = mysqli_fetch_array($data1)) {
											$sl = $row1['sl'];
											$cnm = $row1['cnm'];
											echo "<option value='" . $sl . "' >" . $cnm . "</option>";
										}
										?>
									</select>
								</td>
								<td>
									<div id="scatdiv">
										<select name="scat1" class="form-control" size="1" id="scat1" tabindex="1" onchange="get_prod()">
											<Option value="">---Category---</option>
											<?php 
											$data2 = mysqli_query($conn, "Select * from main_scat where stat='0' order by nm");
											while ($row2 = mysqli_fetch_array($data2)) {
												$ssl = $row2['sl'];
												$snm = $row2['nm'];
												echo "<option value='" . $ssl . "'>" . $snm . "</option>";
											}
											?>
										</select>
									</div>
								</td>

							</tr>
						</table>
						<table width="800px" class="table table-hover table-striped table-bordered">
							<tr>
								<td>
									<table border="0" width="100%" class="advancedtable">
										<tr class="odd">
											<td align="left" width="25%">Model: &nbsp; <input type="box" id="prnm3" onkeyup="get_prod_by_name()" name="prnm3" placeholder="Min 3 Digit Model Name "></b></td>
											<td align="left" width="18%"><b>From Godown</b></td>
											<td align="left" width="8%"><b>Unit</b></td>
											<td hidden align="center" width="15%"><b>Stock In Hand</b></td>
											<td align="center" width="23%"><b>Serial No.</b></td>
											<td align="center" width="7%"><b>Quantity</b></td>
											<td align="center" width="12%"><b>Remark</b></td>
											<td align="center" width="5%"><b>Action</b></td>
										</tr>
									</table>
								</td>
							</tr>

							<tr>
								<td>
									<table border="0" width="100%" class="advancedtable">
										<tr>
											<td width="25%">
												<div id="prod_div">
													<select id="prnm" name="prnm" class="sc1" tabindex="1">
														<option value="">---Select---</option>

													</select>
												</div>
											</td>
											<td align="left" width="18%">
												<div id="g_gwn">
													<select name="bcd" class="form-control" tabindex="10" size="1" id="bcd" onchange="gtt_unt();getb();get_betno();">
														<?php 
														$query = "Select * from main_godown where stat=1";
														$result = mysqli_query($conn, $query);
														while ($R = mysqli_fetch_array($result)) {
															$sl = $R['sl'];
															$gnm = $R['gnm'];
														?>
															<option value="<?php  echo $sl; ?>"><?php  echo $gnm; ?></option>
														<?php 
														}
														?>
													</select>
												</div>
											</td>
											<td width="8%">
												<div id="g_unt">
													<select id="unit" name="unit" class="sc" tabindex="1" style="padding:3px;width:100%">
														<option value="">---Select---</option>
													</select>
												</div>
											</td>

											<td width="15%" hidden>
												<div id="gbet">
													<input type="text" class="sc" id="sih" name="sih" tabindex="1">
												</div>
											</td>
											<td width="23%">
												<div id="g_betno">
													<input type="text" id="betno" class="sc" autocomplete="off" name="betno" tabindex="1" onblur="spaces(this.value)">
												</div>
											</td>
											<td width="7%">
												<input type="text" id="qnty" class="sc" autocomplete="off" name="qnty" tabindex="1" onkeypress="return isNumber(event)">
											</td>
											<td width="12%">
												<input type="text" id="remk" class="sc" autocomplete="off" name="remk" tabindex="1">
											</td>

											<td width="5%">
												<input type="button" class="btn btn-success" id="Button1" name="" value="Add" tabindex="1" onclick="add()" tabindex="9" style="padding:2px;width:100%">
											</td>
										</tr>
									</table>
								</td>
							</tr>

							<tr height="230px">
								<td>
									<div id="wb_Text13"></div>
								</td>
							</tr>
						</table>

						<table border="0" width="860px" class="table table-hover table-striped table-bordered">
							<tr>
								<td align="right">
									<input type="button" class="btn btn btn-success" id="Button2" name="" onclick="check()" value="Submit" tabindex="1">
								</td>
							</tr>
						</table>

						<input type="hidden" id="prid" name="prid" value="<?php  echo $cid; ?>">
						<input type="hidden" id="stk">
						<input type="hidden" id="fls">
				</form>
</div>

<div class="box-footer clearfix no-border"></div>

</div>
</section><!-- /.content -->
</aside><!-- /.right-side -->

<link rel="stylesheet" href="chosen.css">
<script src="chosen.jquery.js" type="text/javascript"></script>
<script src="prism.js" type="text/javascript" charset="utf-8"></script>
<script>
	$('#prnm').chosen({
		no_results_text: "Oops, nothing found!",
	});
	$('#cat1').chosen({
		no_results_text: "Oops, nothing found!",
	});
	$('#scat1').chosen({
		no_results_text: "Oops, nothing found!",
	});
	$('#bcd').chosen({
		no_results_text: "Oops, nothing found!",
	});
</script>
</body>

</html>