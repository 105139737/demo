<?php 
$reqlevel = 1;
// get the cookievars if they exist
$rememberCookieUname = $_COOKIE["rememberCookieUname"] ?? "";
$rememberCookiePassword = $_COOKIE["rememberCookiePassword"] ?? "";

// the security header which should be included in al memberpaga's
// first we include the configuration file which contains the database data
// also it will connect to the database.
include("config.php");

// tell we want to work with sessions
session_start();
$last_login = $_SESSION['lastlog'] ?? "";
$username=$_SESSION['id'] ?? "";
$pass=$_SESSION['pass'] ?? "";
// the $HTTP_SESSION_VARS[id] in this query indicates that we want to retrieve the username from the session.
$query = "Select * from " . $DBprefix . "signup where username='" . $username . "' And password = '" . $pass . "' and logstat='1'";
$result = mysqli_query($conn, $query);

// if there are results check it the accesslevel is high enough. If there aren't results tell the user to log-in and stop (die) after that.
if ($row = mysqli_fetch_array($result)) {
	// set the current level into a variable for use on a page.
	$user_current_level = $row["userlevel"];
	$user_nm = $row["name"];
	// check if the user's access level is higher than zero. since if it is lower than zero he is an admin which have access to al pages.
	// and check if the user's level is high enough for this page.
	if ($reqlevel == 0 && $row["userlevel"] > 0) {
		die("You need to be an admin for this page");
	} else {
		if ($row["userlevel"] < $reqlevel && $row["userlevel"] > 0) {
			// it seems that the user's access level isn't high enough. Therefore 'die' (stop processing the page) with that message that the access level isn't high enough.
			die("Your acces level is not high enough for this page, <BR> Your access level: $row[userlevel] <BR>Level required: $reqlevel");
		}
	}
} else {
	// if there are no results, check for an cookie
	if ($rememberCookiePassword != "" && $rememberCookieUname != "") {
		// validate the cookie
		$query = "Select * from " . $DBprefix . "signup where username='" . $rememberCookieUname . "'";
		$result = mysqli_query($conn, $query);
		// if there are results check it the accesslevel is high enough. If there aren't results tell the user to log-in and stop (die) after that.
		if ($row = mysqli_fetch_array($result)) {
			// check the password
			if (md5($row["password"]) == $rememberCookiePassword) {
				// if the user has a valid cookie, set the session vars:
				// remove al the data from the session (auto logoff)
				session_unset();
				// remove the session itself
				session_destroy();
				// put the password in the session
				session_register("pass");
				$_SESSION["pass"] = $rememberCookiePassword;
				// put the username in the session
				session_register("id");
				$_SESSION_VARS["id"] =  $rememberCookieUname;
				//set the current level into a variable for use on a page.
				$user_current_level = $row["userlevel"];
				$user_nm = $row["name"];
				//check if the user's access level is higher than zero. since if it is lower than zero he is an admin which have access to al pages.
				//and check if the user's level is high enough for this page.
				if ($reqlevel == 0 && $row["userlevel"] > 0) {
					die("You need to be an admin for this page");
				} else {
					if ($row["userlevel"] < $reqlevel && $row["userlevel"] > 0) {
						//it seems that the user's access level isn't high enough. Therefore 'die' (stop processing the page) with that message that the access level isn't high enough.
						die("Your acces level is not high enough for this page, <BR> Your access level: $row[userlevel] <BR>Level required: $reqlevel");
					}
				}
			} else {
				die(include("login.php"));
			}
		} else {
			die(include("login.php"));
		}
	} else {
		die(include("login.php"));
	}
}
// Below we set al variables which can be used in pages, things like the current logged user and his or hers level

// This will set the user_currently_loged variable
// first we remove the htmlcode from the username saved in a cookie
$user_currently_loged = htmlspecialchars($_SESSION["id"], ENT_NOQUOTES);
// Then we replace \" with "
$user_currently_loged = str_replace('\"', "&quot;", $user_currently_loged);
$user_currently_loged = str_replace("\'", "&#039", $user_currently_loged);
// and a variable where u get the plain username (only use for scripting!)
$user_currently_loged_plain = $_SESSION["id"];

date_default_timezone_set('Asia/Kolkata');
$lastactivetime = date("Y-m-d h:i:s");
$lastpage = full_path();
$query = "UPDATE " . $DBprefix . "signup Set logstat='1',lastactivetime='$lastactivetime',lastpage='$lastpage' where username='" . $_SESSION['id'] . "'";
$result = mysqli_query($conn, $query);

if ($user_current_level < 0) {
	$user_current_Rank = "ADMIN";
} else {
	$user_current_Rank = $ranks[$user_current_level];
}
$branch_code = $row["brncd"];
$mob_user = $row["mob"];
$staff_name = $row["name"];
$super_user = $row["sup"];

$bill_ent = $row['bill_ent'];
$bill_edt = $row['bill_edt'];
$recv_ent = $row['recv_ent'];
$recv_edt = $row['recv_edt'];
$pur_ent = $row['pur_ent'];
$pur_edt = $row['pur_edt'];
$ccn_ent = $row['ccn_ent'];
$ccn_edt = $row['ccn_edt'];
$contra = $row['contra'];
$exp_edt = $row['exp'];
$salereport = $row['salereport'];


// check if there are unread messages



$query = "Select * from " . $DBprefix . "branch where sl='$branch_code'";
$result = mysqli_query($conn, $query);
while ($R = mysqli_fetch_array($result)) {
	$branch_nm = $R['bnm'];
	$branch_sl = $R['sl'];
	$branch_als = $R['als'];
	$branch_addr = $R['addr'];
	$branch_cnt = $R['bcnt'];
	$branch_ctag = $R['ctag'];
}
function get_branch_name($current_branch_code)
{
	include("config.php");
	$query1111 = "SELECT * FROM main_branch where sl='$current_branch_code'";
	$result1111 = mysqli_query($conn, $query1111);
	while ($rw1111 = mysqli_fetch_array($result1111)) {
		$current_branch_name = $rw1111['bnm'];
	}
	return $current_branch_name;
}

function get_branch_name_godown($current_branch_code)
{
	include("config.php");
	$query1111 = "SELECT * FROM main_godown where sl='$current_branch_code'";
	$result1111 = mysqli_query($conn, $query1111);
	while ($rw1111 = mysqli_fetch_array($result1111)) {
		$current_branch_name = $rw1111['gnm'];
	}
	return $current_branch_name;
}
$query = "SELECT * from main_vat";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($result)) {
	$current_vat = $row['vat'];
}

$query1 = "Select * from main_cnm ";
$result1 = mysqli_query($conn, $query1);
while ($R = mysqli_fetch_array($result1)) {
	$comp_nm = $R['cnm'];
	$comp_addr = $R['addr'];
	$cont = $R['cont'];
	$gstin = $R['gstin'];
	$branch1 = $R['branch1'];
	$branch2 = $R['branch2'];
	$ifsc1 = $R['ifsc1'];
	$ifsc2 = $R['ifsc2'];
	$ac1 = $R['ac1'];
	$ac2 = $R['ac2'];
	$acnm1 = $R['acnm1'];
	$acnm2 = $R['acnm2'];
}


$qy = "Select * from main_dt";
$qrr = mysqli_query($conn, $qy);
while ($RR = mysqli_fetch_array($qrr)) {
	$rng_dt1 = $RR['dt'];
}
if ($user_currently_loged != 'admin') {
	$rng_dt = date('d-m-Y', strtotime($rng_dt1));
} else {
	$rng_dt11 = strtotime('+5 years', $rng_dt1);
	$rng_dt = date('d-m-Y', strtotime($rng_dt11));
}
function date_chk($dt)
{
	include("config.php");
	$dt = date("Y-m-d", strtotime($dt));
	$query1 = "Select * from main_ssn where '$dt' between fdt and tdt ";
	$result1 = mysqli_query($conn, $query1);
	$countt = mysqli_num_rows($result1);
	return $countt;
}

function avg_rate($pcd)
{
	include("config.php");
	$query4 = "Select ((sum((main_stock.stin+main_stock.opst)*stk_rate))/sum(main_stock.stin+main_stock.opst)) as stk_rate,((sum((main_stock.stin+main_stock.opst)*rate))/sum(main_stock.stin+main_stock.opst)) as rate from main_stock where pcd='$pcd' and main_stock.stin+main_stock.opst>0  ";
	$result4 = mysqli_query($conn, $query4);
	while ($R4 = mysqli_fetch_array($result4)) {
		$stk_rate = round($R4['stk_rate'], 2);
		$rate = round($R4['rate'], 2);
	}
	return $stk_rate . "@@" . $rate;
}

function get_avg_rate_op($rt, $scat, $fdt, $conn)
{
	$tst = 0;
	$tnrt = 0;

	$data2 = mysqli_query($conn, "select * from main_product where sl>0 and scat='$scat' ") or die(mysqli_error($conn));
	while ($row1 = mysqli_fetch_array($data2)) {
		$pcd = $row1['sl'];

		$open_stk = 0;
		$open_rt = 0;
		$query4 = "Select sum((opst*$rt)+(stin*$rt))/sum(opst+stin) as stck1 from main_stock where pcd='$pcd' and dt<'$fdt' and (opst>0 or stin>0) and (nrtn='Opening' or nrtn='Purchase')";
		$result4 = mysqli_query($conn, $query4) or die(mysqli_error($conn));
		while ($R4 = mysqli_fetch_array($result4)) {
			$open_rt = round($R4['stck1'], 2);
		}

		$query4 = "Select sum(opst+stin-stout) as stck1 from main_stock where pcd='$pcd' and  dt<'$fdt' ";
		$result4 = mysqli_query($conn, $query4) or die(mysqli_error($conn));
		while ($R4 = mysqli_fetch_array($result4)) {
			$open_stk = $R4['stck1'];
		}


		$tst += $open_stk;
		$rt1 = $open_stk * $open_rt;
		$tnrt += $rt1;
	}

	if ($tnrt > 0 and $tst > 0) {
		return round($tnrt / $tst, 2);
	} else {
		return 0;
	}
}

function get_avg_rate_in($rt, $scat, $todt, $conn)
{
	$tst = 0;
	$tnrt = 0;
	$data2 = mysqli_query($conn, "select * from main_product where sl>0 and scat='$scat' ") or die(mysqli_error($conn));
	while ($row1 = mysqli_fetch_array($data2)) {
		$pcd = $row1['sl'];
		$open_stk = 0;
		$open_rt = 0;
		$query4 = "Select sum(stin*$rt)/sum(stin) as stck1  from main_stock where pcd='$pcd'  and (opst>0 or stin>0)  and nrtn='Purchase' $todt";
		$result4 = mysqli_query($conn, $query4);
		while ($R4 = mysqli_fetch_array($result4)) {
			$open_rt = round($R4['stck1'], 2);
		}

		$query4 = "Select sum(stin) as stck1 from main_stock where pcd='$pcd' and (opst>0 or stin>0)  and (nrtn='Purchase' or nrtn='Sale Return') $todt ";
		$result4 = mysqli_query($conn, $query4) or die(mysqli_error($conn));
		while ($R4 = mysqli_fetch_array($result4)) {
			$open_stk = $R4['stck1'];
		}

		$tst += $open_stk;
		$rt1 = $open_stk * $open_rt;
		$tnrt += $rt1;
	}
	if ($tnrt > 0 and $tst > 0) {
		return round($tnrt / $tst, 2);
	} else {
		return 0;
	}
}


function get_avg_rate_out($rt, $scat, $todt, $conn)
{
	$tst = 0;
	$tnrt = 0;
	$data2 = mysqli_query($conn, "select * from main_product where sl>0 and scat='$scat' ") or die(mysqli_error($conn));
	while ($row1 = mysqli_fetch_array($data2)) {
		$pcd = $row1['sl'];
		$open_stk = 0;
		$open_rt = 0;
		$query4 = "Select sum(stout*$rt)/sum(stout) as stck1  from main_stock where pcd='$pcd'  and nrtn='Sale'  $todt";
		$result4 = mysqli_query($conn, $query4);
		while ($R4 = mysqli_fetch_array($result4)) {
			$open_rt = round($R4['stck1'], 2);
		}

		$query4 = "Select sum(stout) as stck1 from main_stock where pcd='$pcd' and (nrtn='Sale' or nrtn='Purchase Return') $todt ";
		$result4 = mysqli_query($conn, $query4) or die(mysqli_error($conn));
		while ($R4 = mysqli_fetch_array($result4)) {
			$open_stk = $R4['stck1'];
		}

		$tst += $open_stk;
		$rt1 = $open_stk * $open_rt;
		$tnrt += $rt1;
	}

	if ($tnrt > 0 and $tst > 0) {
		return round($tnrt / $tst, 2);
	} else {
		return 0;
	}
}
/*
$qy="Select * from main_edit_days where sl>0 and FIND_IN_SET('$user_currently_loged', puser)>0 ";
$qrr = mysqli_query($conn,$qy);
$edit_count=mysqli_num_rows($qrr);
$edit_count=1;
*/
date_default_timezone_set('Asia/Kolkata');

function get_permission($dt, $dt_limit)
{
	//if($dt_limit<29){$dt_limit=$dt_limit;$tp="day";}if($dt_limit>29){$dt_limit=$dt_limit/30;$tp="month";}if($dt_limit>364){$dt_limit=$dt_limit/364;$tp="year";}
	date_default_timezone_set('Asia/Kolkata');
	$dt = date('Y-m-d', strtotime($dt));
	$current_dt = date('Y-m-d');
	$limit_dt = strtotime("- " . $dt_limit . " day", strtotime($current_dt));
	$limit_dt = date('Y-m-d', $limit_dt);

	if (strtotime($dt) > strtotime($limit_dt)) {
		return '1';
	} else {
		return '0';
	}
}
$max_execution_time = 0;
$max_time_error = "Sorry,";
$HTTP_REFERER=$_SERVER['HTTP_REFERER']?? "";
$file_name = basename(parse_url($HTTP_REFERER, PHP_URL_PATH));

$main_menu = mysqli_query($conn, "select * from main_menu where fnm='$file_name' ") or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($main_menu)) {
	$max_execution_time = $row1['snd'];
}
//echo $max_execution_time;
if ($max_execution_time > 0) {
	function shutdown()
	{
		$a = error_get_last();
		if ($a == null) {
		} else {
			$max_execution_msg = "Maximum";
			if (substr($a['message'], 0, 7) == $max_execution_msg) {
?>

				<center>
					<font color="red" size="5"><?php  echo $a['message']; ?></font>
				</center>

				<script>
					alert('<?php  echo  $a['message']; ?>');
				</script>
<?php 
			}
		}
	}
	register_shutdown_function('shutdown');
	//ini_set('max_execution_time',$max_execution_time );
	set_time_limit($max_execution_time);
}

function full_path()
{
	$s = &$_SERVER;
	$ssl = (!empty($s['HTTPS']) && $s['HTTPS'] == 'on') ? true : false;
	$sp = strtolower($s['SERVER_PROTOCOL']);
	$protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
	$port = $s['SERVER_PORT'];
	$port = ((!$ssl && $port == '80') || ($ssl && $port == '443')) ? '' : ':' . $port;
	$host = isset($s['HTTP_X_FORWARDED_HOST']) ? $s['HTTP_X_FORWARDED_HOST'] : (isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : null);
	$host = isset($host) ? $host : $s['SERVER_NAME'] . $port;
	$uri = $protocol . '://' . $host . $s['REQUEST_URI'];
	$segments = explode('?', $uri, 2);
	$url = $segments[0];
	return $s['REQUEST_URI'];
}

function CreateNewJob($jobFile, $eby, $nm, $conn)
{
	$s = &$_SERVER;
	$ssl = (!empty($s['HTTPS']) && $s['HTTPS'] == 'on') ? true : false;
	$sp = strtolower($s['SERVER_PROTOCOL']);
	$protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
	$port = $s['SERVER_PORT'];
	$port = ((!$ssl && $port == '80') || ($ssl && $port == '443')) ? '' : ':' . $port;
	$host = isset($s['HTTP_X_FORWARDED_HOST']) ? $s['HTTP_X_FORWARDED_HOST'] : (isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : null);
	$host = isset($host) ? $host : $s['SERVER_NAME'] . $port;
	$uri = $protocol . '://' . $host . $s['REQUEST_URI'];
	$segments = explode('?', $uri, 2);
	$url = $segments[0];
	$url = explode("/", $url);
	$pageName = array_pop($url);
	$jobLink = str_replace($pageName, $jobFile, $uri);
	date_default_timezone_set('Asia/Kolkata');
	$req_date = date('Y-m-d h:i:s');
	$eby = strtolower($eby);
	$query = "INSERT INTO main_aa_jobs (link,req_date,eby,status,nm) VALUES ('$jobLink','$req_date','$eby','Pending','$nm')";
	$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
	mysqli_close($conn);
}
function dates_diff($date1, $date2)
{
	$diff = abs(strtotime($date2) - strtotime($date1));
	$years = floor($diff / (365 * 60 * 60 * 24));
	$months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
	return $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
}
function dates_diff_month($date1, $date2)
{
	$diff = abs(strtotime($date2) - strtotime($date1));
	$years = floor($diff / (365 * 60 * 60 * 24));
	return $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
	return $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
}
?>