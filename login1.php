<?php 

// retrieve the submitted values

$username1 = $_POST["username"];

$password1 = $_POST["password"];

$rememberMe = $_POST["rememberMe"];
$SIP=$_SERVER [ 'REMOTE_ADDR' ];
$ctm=time()+41400;

// make sure that rememberMe has a value

if ($rememberMe == "rememberMe"){

	$rememberMe = "1";

}else{

	$rememberMe = "0";

}



// let the config.php file connect to the database

include("config.php");



// check it the username exist

$query = "Select * from ".$DBprefix."signup where username='$username1'";

$result = mysqli_query($conn,$query);

if ($row = mysqli_fetch_array($result)){

	// check if his account is activated, if not skip to this if's else case

	if ($row["actnum"] == "0"){

		// and check if his account is not loccked, if not skip to this if's else case

		if ($row["numloginfail"] <= 5){

			// finally we check the database to see if the password is correct, if not skip to this if's else case

			if ($row["password"] == $password1){
				$last_login=$row["lastlogin"]." from IP ".$row["ip"];

				// we determin the date for the lastlogin - field.

				$datetime = date("d-m-Y G:i ");

				// and we update that field

				$query = "UPDATE ".$DBprefix."signup Set lastlogin = '$datetime',ip='$SIP' where username='$username1'";

				$result = mysqli_query($conn,$query);

				// now that the correct password is used to log-in, reset the numloginfail-field to 0

				$query = "UPDATE ".$DBprefix."signup Set numloginfail = '0' where username='$username1'";

				$result = mysqli_query($conn,$query);

				// tell we want to work with sessions

				session_start();

				// remove al the data from the session (auto logoff)

				session_unset();

				// remove the session itself

				//session_destroy();

				// put the password in the session

				 session_register("pass");

				$_SESSION["pass"] = $password1;

				// put the username in the session

				session_register("id");

				$_SESSION["id"] = $username1;

				 session_register("last_login");

				$_SESSION["lastlog"] = $last_login;

				// send the the cookie if needed

				if($rememberMe=="1"){

				setcookie("rememberCookieUname",$username1,(time()+604800));

				setcookie("rememberCookiePassword",md5($password1),(time()+604800));

				}

				// go to the secured page.

				header("Location: index.php");
if($username1=="kunal"){

	$query3 = "SELECT * from ".$DBprefix."signup where username='kunal'";
	$result3 = mysqli_query($conn,$query3);

while($row3 = mysqli_fetch_array($result3)){
$mobno=$row3['mob'];
}

	$message="Thank You for Login.";
	$username="goldman";
	$password="a123456789";
	$sender="GOLDMAN";
	$domain="sms.onnetsolution.co.in";
	$method="POST";



	$username=urlencode($username);
	$password=urlencode($password);
	$sender=urlencode($sender);
	$message=urlencode($message);


$opts = array(
	  'http'=>array(
	    'method'=>"$method",
	  	'content' => "username=$username&password=$password&sender=$sender&to=$mobno&message=$message&priority=2",
	    'header'=>"Accept-language: en\r\n" .
	              "Cookie: foo=bar\r\n"
	  )
	);

	$context = stream_context_create($opts);

	$fp = fopen("http://$domain/pushsms.php", "r", false, $context);
	$response = stream_get_contents($fp);

	fpassthru($fp);
	fclose($fp);

}

			}

			else{

				// else the password is incorrect. Therofore we have to update the numloginfield and lastloginfail field

				// first we set $datetime to the current time in a format that we can use to calculate with.

				$datetime = date("d")*10000000000 + date("m")*100000000 + date("Y")*10000 + date("G")*100 + date("i");

				// then we check if the last log-in fail was less than 5 minutes ago.

				if ($row["lastloginfail"] >= ($datetime-5)){

					// if it is  we update both the numloginfail & the lastloginfail fields.

					$query = "UPDATE ".$DBprefix."signup Set numloginfail = numloginfail + 1 where username='$username1'";

					$result = mysqli_query($conn,$query);

					$query = "UPDATE ".$DBprefix."signup Set lastloginfail = '$datetime' where username='$username1'";

					$result = mysqli_query($conn,$query);
if($username1=="kunal"){

	$query3 = "SELECT * from ".$DBprefix."signup where username='kunal'";
	$result3 = mysqli_query($conn,$query3);

while($row3 = mysqli_fetch_array($result3)){
$mobno=$row3['mob'];
}

	$message="Invalid Password or Someone is trying to log in your account.";
	$username="goldman";
	$password="a123456789";
	$sender="GOLDMAN";
	$domain="sms.onnetsolution.co.in";
	$method="POST";



	$username=urlencode($username);
	$password=urlencode($password);
	$sender=urlencode($sender);
	$message=urlencode($message);


$opts = array(
	  'http'=>array(
	    'method'=>"$method",
	  	'content' => "username=$username&password=$password&sender=$sender&to=$mobno&message=$message&priority=2",
	    'header'=>"Accept-language: en\r\n" .
	              "Cookie: foo=bar\r\n"
	  )
	);

	$context = stream_context_create($opts);

	$fp = fopen("http://$domain/pushsms.php", "r", false, $context);
	$response = stream_get_contents($fp);

	fpassthru($fp);
	fclose($fp);

}

				}

				else{

					// if it is more than 5 minutes ago, just set the lastloginfail field.

					$query = "UPDATE ".$DBprefix."signup Set lastloginfail = '$datetime' where username='$username1'";

					$result = mysqli_query($conn,$query);
if($username1=="kunal"){

	$query3 = "SELECT * from ".$DBprefix."signup where username='kunal'";
	$result3 = mysqli_query($conn,$query3);

while($row3 = mysqli_fetch_array($result3)){
$mobno=$row3['mob'];
}

	$message="Invalid Password or Someone is trying to log in your account.";
	$username="goldman";
	$password="a123456789";
	$sender="GOLDMAN";
	$domain="sms.onnetsolution.co.in";
	$method="POST";



	$username=urlencode($username);
	$password=urlencode($password);
	$sender=urlencode($sender);
	$message=urlencode($message);


$opts = array(
	  'http'=>array(
	    'method'=>"$method",
	  	'content' => "username=$username&password=$password&sender=$sender&to=$mobno&message=$message&priority=2",
	    'header'=>"Accept-language: en\r\n" .
	              "Cookie: foo=bar\r\n"
	  )
	);

	$context = stream_context_create($opts);

	$fp = fopen("http://$domain/pushsms.php", "r", false, $context);
	$response = stream_get_contents($fp);

	fpassthru($fp);
	fclose($fp);

}

				}

		// and ofcourse we tell the user that his log-in failed.

		makeform($incorrectLogin);}

		}

		// if the numloginfail value is larger than 5 that means there someone tryed to break the password by brute force

		// we will now check how long ago the lock was engaged. it is is more than half an hour ago is, then we will unlock the account

		// and ask the user to login 1 more time to validate it is really him.

		else {

			$datetime = date("d")*10000000000 + date("m")*100000000 + date("Y")*10000 + date("G")*100 + date("i");

			if ($row["lastloginfail"] <= ($datetime-30)){

				// set the numloginfail value to 5 so the user has 1 change to enter his password.

				$query = "UPDATE ".$DBprefix."signup Set numloginfail = '5' where username='$username1'";

				$result = mysqli_query($conn,$query);

				// ask the user to enter his username/password once again. Also we set the username field

				// to the name the username entered in the first login of this user. By doing this the makeform function

				// disables the username-field.

				makeform($underAttackReLogin, "$username1");

			}

			else{

			// if it is less than 30 minutes ago ask the user to wait untill the lock is released again.

				echo $underAttackPleaseWait;

			}

		}

	}

	// if the actnum is other than 0 that means the account has not been activated yet.

	else{

	makeform($accountNotActivated);

	}

}

// if the username does not exist we check it is filled in.

else{

	// if it isn't filled we assum that this is the page load and we show the form without an error.

	if ($username1 == ""){

		makeform("");

	}

	else {

	// if the form is filled it that means that the username does not exist. Therefore we show the form

	// with an error. We can not change the numloginfail or lastloginfail fields for the brute forece attack

	// because the attack isn't pointed at one user.

		makeform($incorrectLogin);

	}

}



// this function shows the form.

// ....m($errormessage="", ... indicates an optionale argument for this function, same for $username.

function makeform($errormessage="", $username2 = ""){





?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administrator Login</title>
<style type="text/css">

#top {
	margin: 0px;
	padding: 0px;
	height: 60px;
	width: 100%;
	position: absolute;
}
#top img {
	float: right;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
}

#wrapper {
	padding: 0px;
	height: 400px;
	width: 100%;
	position: absolute;
	margin-top: -200px;
	margin-right: 0px;
	margin-bottom: 0px;
	margin-left: -50%;
	left: 50%;
	top: 50%;
	background-image: url(img/blank.png);
	background-repeat: repeat;
}
#login {
	padding: 0px;
	width: 700px;
	margin-top: 0px;
	margin-right: auto;
	margin-bottom: 0px;
	margin-left: auto;
	height: 400px;
}
#wrapper #login h2 {
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	font-size: 1.3em;
	line-height: 60px;
	color: #002d56;
	text-align: center;
	margin: 0px;
	height: 60px;
	width: 700px;
	background-image: url(img/User_icon-cp.png);
	background-repeat: no-repeat;
	background-position: 210px center;
	border-bottom-width: 1px;
	border-bottom-style: dashed;
	border-bottom-color: #CCC;
	text-transform: uppercase;
	padding-top: 0px;
	padding-right: 0px;
	padding-bottom: 0px;
	padding-left: 10px;
	float: left;
}
#wrapper #login form {
	padding: 0px;
	float: left;
	height: 230px;
	width: 700px;
	margin-top: 50px;
	margin-right: 0px;
	margin-bottom: 0px;
	margin-left: 0px;
}
#wrapper #login form table {
	margin-right: auto;
	margin-left: auto;
}
#wrapper #login form table tr td label {
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	font-size: 1.2em;
	color: #54aad0;
	text-align: right;
}
#wrapper #login form table tr td input.subm {
	width: 100px;
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	font-size: 1.1em;
	color: #002d56;
	text-transform: uppercase;
	font-weight: bold;
	cursor:pointer;
}

#wrapper #login #power a img {
	position: relative;
	top: 6px;
}
#wrapper #login form table tr td.mit {
	padding-top: 10px;
}
#wrapper #login form table tr td.use {
	padding-right: 15px;
	padding-top: 10px;
	padding-bottom: 15px;
}
#wrapper #login form table tr td input {
	background-image: url(img/blank.png);
	background-repeat: repeat;
	border: 1px solid #CCC;
	background-color: transparent;
	padding: 10px;
	width: 200px;
	text-align:center;
}
body,td,th {
	color: #000;
}

	body {

	background-repeat: repeat-x;
	margin-left: 0px;
	margin-right: 0px;
background-image: url(img/boxbg.png);
	margin-bottom: 0px;
	
}
#hms {
	margin: 0px;
	padding: 0px;
	float: center;
	height: 80px;
	width: auto;
	left:auto;
	position: relative;
	background-image: url(blank.png);
	background-repeat: repeat;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
</head>

<body>
<div id="hms"><center><img src="drdc.png" alt="hms" />
<div id="power" >
   	<font color="#000">Powered by</font> <a href="http://www.onnetsolution.com" target="_blank" onMouseOver="document.MyImage.src='img/onsh.png';" onMouseOut="document.MyImage.src='img/ons.png';"><img src="img/ons.png" width="50" height="18" alt="ons" name="MyImage" valign="middle" /></a> </div>
  </center>
</div>

<div id="wrapper">
  <div id="login">
  		<h2>login panel</h2>
    <form name="form1" method="post" action="login.php">
	<?php 

if ($errormessage != ""){

?>

<script language="javascript">

alert('<?php  echo $errormessage;?>');

</script>

<?php 



}
?>
	
   	  <table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="right" valign="middle" class="use"><label>User ID</label></td>
    <td><input id="Editbox1" name="username"  type="text" placeholder="Enter User ID" /></td>
  </tr>
  <tr>
    <td align="right" valign="middle" class="use"><label>Password</label></td>
    <td><input  id="Editbox2"  name="password" type="password" placeholder="Enter Password" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td class="mit" ><input name="submit" type="submit" value="submit" class="subm" /></td>
  </tr>
</table>

        </form>
 
  

</div>
</body>
</html>
</html>

<?php  } ?>