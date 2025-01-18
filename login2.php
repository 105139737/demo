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
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="ie6 ielt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="ie7 ielt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie8"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html lang="en"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<title>Login</title>
<style>
/* Reset CSS */
html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, font, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td {
	margin: 0;
	padding: 0;
	border: 0;
	outline: 0;
	font-size: 100%;
	vertical-align: baseline;
	background: transparent;
}
body {
	background: #DCDDDF url(http://cssdeck.com/uploads/media/items/7/7AF2Qzt.png);
	color: #000;
	font: 14px Arial;
	margin: 0 auto;
	padding: 0;
	position: relative;
}
h1{ font-size:28px;}
h2{ font-size:26px;}
h3{ font-size:18px;}
h4{ font-size:16px;}
h5{ font-size:14px;}
h6{ font-size:12px;}
h1,h2,h3,h4,h5,h6{ color:#563D64;}
small{ font-size:10px;}
b, strong{ font-weight:bold;}
a{ text-decoration: none; }
a:hover{ text-decoration: underline; }
.left { float:left; }
.right { float:right; }
.alignleft { float: left; margin-right: 15px; }
.alignright { float: right; margin-left: 15px; }
.clearfix:after,
form:after {
	content: ".";
	display: block;
	height: 0;
	clear: both;
	visibility: hidden;
}
.container { margin: 25px auto; position: relative; width: 900px; }
#content {
	background: #f9f9f9;
	background: -moz-linear-gradient(top,  rgba(248,248,248,1) 0%, rgba(249,249,249,1) 100%);
	background: -webkit-linear-gradient(top,  rgba(248,248,248,1) 0%,rgba(249,249,249,1) 100%);
	background: -o-linear-gradient(top,  rgba(248,248,248,1) 0%,rgba(249,249,249,1) 100%);
	background: -ms-linear-gradient(top,  rgba(248,248,248,1) 0%,rgba(249,249,249,1) 100%);
	background: linear-gradient(top,  rgba(248,248,248,1) 0%,rgba(249,249,249,1) 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f8f8f8', endColorstr='#f9f9f9',GradientType=0 );
	-webkit-box-shadow: 0 1px 0 #fff inset;
	-moz-box-shadow: 0 1px 0 #fff inset;
	-ms-box-shadow: 0 1px 0 #fff inset;
	-o-box-shadow: 0 1px 0 #fff inset;
	box-shadow: 0 1px 0 #fff inset;
	border: 1px solid #c4c6ca;
	margin: 0 auto;
	padding: 25px 0 0;
	position: relative;
	text-align: center;
	text-shadow: 0 1px 0 #fff;
	width: 400px;
}
#content h1 {
	color: #7E7E7E;
	font: bold 25px Helvetica, Arial, sans-serif;
	letter-spacing: -0.05em;
	line-height: 20px;
	margin: 10px 0 30px;
}
#content h1:before,
#content h1:after {
	content: "";
	height: 1px;
	position: absolute;
	top: 10px;
	width: 27%;
}
#content h1:after {
	background: rgb(126,126,126);
	background: -moz-linear-gradient(left,  rgba(126,126,126,1) 0%, rgba(255,255,255,1) 100%);
	background: -webkit-linear-gradient(left,  rgba(126,126,126,1) 0%,rgba(255,255,255,1) 100%);
	background: -o-linear-gradient(left,  rgba(126,126,126,1) 0%,rgba(255,255,255,1) 100%);
	background: -ms-linear-gradient(left,  rgba(126,126,126,1) 0%,rgba(255,255,255,1) 100%);
	background: linear-gradient(left,  rgba(126,126,126,1) 0%,rgba(255,255,255,1) 100%);
    right: 0;
}
#content h1:before {
	background: rgb(126,126,126);
	background: -moz-linear-gradient(right,  rgba(126,126,126,1) 0%, rgba(255,255,255,1) 100%);
	background: -webkit-linear-gradient(right,  rgba(126,126,126,1) 0%,rgba(255,255,255,1) 100%);
	background: -o-linear-gradient(right,  rgba(126,126,126,1) 0%,rgba(255,255,255,1) 100%);
	background: -ms-linear-gradient(right,  rgba(126,126,126,1) 0%,rgba(255,255,255,1) 100%);
	background: linear-gradient(right,  rgba(126,126,126,1) 0%,rgba(255,255,255,1) 100%);
    left: 0;
}
#content:after,
#content:before {
	background: #f9f9f9;
	background: -moz-linear-gradient(top,  rgba(248,248,248,1) 0%, rgba(249,249,249,1) 100%);
	background: -webkit-linear-gradient(top,  rgba(248,248,248,1) 0%,rgba(249,249,249,1) 100%);
	background: -o-linear-gradient(top,  rgba(248,248,248,1) 0%,rgba(249,249,249,1) 100%);
	background: -ms-linear-gradient(top,  rgba(248,248,248,1) 0%,rgba(249,249,249,1) 100%);
	background: linear-gradient(top,  rgba(248,248,248,1) 0%,rgba(249,249,249,1) 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f8f8f8', endColorstr='#f9f9f9',GradientType=0 );
	border: 1px solid #c4c6ca;
	content: "";
	display: block;
	height: 100%;
	left: -1px;
	position: absolute;
	width: 100%;
}
#content:after {
	-webkit-transform: rotate(2deg);
	-moz-transform: rotate(2deg);
	-ms-transform: rotate(2deg);
	-o-transform: rotate(2deg);
	transform: rotate(2deg);
	top: 0;
	z-index: -1;
}
#content:before {
	-webkit-transform: rotate(-3deg);
	-moz-transform: rotate(-3deg);
	-ms-transform: rotate(-3deg);
	-o-transform: rotate(-3deg);
	transform: rotate(-3deg);
	top: 0;
	z-index: -2;
}
#content form { margin: 0 20px; position: relative }
#content form input[type="text"],
#content form input[type="password"] {
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	-ms-border-radius: 3px;
	-o-border-radius: 3px;
	border-radius: 3px;
	-webkit-box-shadow: 0 1px 0 #fff, 0 -2px 5px rgba(0,0,0,0.08) inset;
	-moz-box-shadow: 0 1px 0 #fff, 0 -2px 5px rgba(0,0,0,0.08) inset;
	-ms-box-shadow: 0 1px 0 #fff, 0 -2px 5px rgba(0,0,0,0.08) inset;
	-o-box-shadow: 0 1px 0 #fff, 0 -2px 5px rgba(0,0,0,0.08) inset;
	box-shadow: 0 1px 0 #fff, 0 -2px 5px rgba(0,0,0,0.08) inset;
	-webkit-transition: all 0.5s ease;
	-moz-transition: all 0.5s ease;
	-ms-transition: all 0.5s ease;
	-o-transition: all 0.5s ease;
	transition: all 0.5s ease;
	background: #eae7e7 url(http://cssdeck.com/uploads/media/items/8/8bcLQqF.png) no-repeat;
	border: 1px solid #c8c8c8;
	color: #777;
	font: 13px Helvetica, Arial, sans-serif;
	margin: 0 0 10px;
	padding: 15px 10px 15px 40px;
	width: 80%;
}
#content form input[type="text"]:focus,
#content form input[type="password"]:focus {
	-webkit-box-shadow: 0 0 2px #ed1c24 inset;
	-moz-box-shadow: 0 0 2px #ed1c24 inset;
	-ms-box-shadow: 0 0 2px #ed1c24 inset;
	-o-box-shadow: 0 0 2px #ed1c24 inset;
	box-shadow: 0 0 2px #ed1c24 inset;
	background-color: #fff;
	border: 1px solid #ed1c24;
	outline: none;
}
#username { background-position: 10px 10px !important }
#password { background-position: 10px -53px !important }
#content form input[type="submit"] {
	background: rgb(254,231,154);
	background: -moz-linear-gradient(top,  rgba(254,231,154,1) 0%, rgba(254,193,81,1) 100%);
	background: -webkit-linear-gradient(top,  rgba(254,231,154,1) 0%,rgba(254,193,81,1) 100%);
	background: -o-linear-gradient(top,  rgba(254,231,154,1) 0%,rgba(254,193,81,1) 100%);
	background: -ms-linear-gradient(top,  rgba(254,231,154,1) 0%,rgba(254,193,81,1) 100%);
	background: linear-gradient(top,  rgba(254,231,154,1) 0%,rgba(254,193,81,1) 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fee79a', endColorstr='#fec151',GradientType=0 );
	-webkit-border-radius: 30px;
	-moz-border-radius: 30px;
	-ms-border-radius: 30px;
	-o-border-radius: 30px;
	border-radius: 30px;
	-webkit-box-shadow: 0 1px 0 rgba(255,255,255,0.8) inset;
	-moz-box-shadow: 0 1px 0 rgba(255,255,255,0.8) inset;
	-ms-box-shadow: 0 1px 0 rgba(255,255,255,0.8) inset;
	-o-box-shadow: 0 1px 0 rgba(255,255,255,0.8) inset;
	box-shadow: 0 1px 0 rgba(255,255,255,0.8) inset;
	border: 1px solid #D69E31;
	color: #85592e;
	cursor: pointer;
	float: left;
	font: bold 15px Helvetica, Arial, sans-serif;
	height: 35px;
	margin: 20px 0 35px 15px;
	position: relative;
	text-shadow: 0 1px 0 rgba(255,255,255,0.5);
	width: 120px;
}
#content form input[type="submit"]:hover {
	background: rgb(254,193,81);
	background: -moz-linear-gradient(top,  rgba(254,193,81,1) 0%, rgba(254,231,154,1) 100%);
	background: -webkit-linear-gradient(top,  rgba(254,193,81,1) 0%,rgba(254,231,154,1) 100%);
	background: -o-linear-gradient(top,  rgba(254,193,81,1) 0%,rgba(254,231,154,1) 100%);
	background: -ms-linear-gradient(top,  rgba(254,193,81,1) 0%,rgba(254,231,154,1) 100%);
	background: linear-gradient(top,  rgba(254,193,81,1) 0%,rgba(254,231,154,1) 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fec151', endColorstr='#fee79a',GradientType=0 );
}
#content form div a {
	color: #004a80;
    float: right;
    font-size: 12px;
    margin: 30px 15px 0 0;
    text-decoration: underline;
}
.button {
	background: rgb(247,249,250);
	background: -moz-linear-gradient(top,  rgba(247,249,250,1) 0%, rgba(240,240,240,1) 100%);
	background: -webkit-linear-gradient(top,  rgba(247,249,250,1) 0%,rgba(240,240,240,1) 100%);
	background: -o-linear-gradient(top,  rgba(247,249,250,1) 0%,rgba(240,240,240,1) 100%);
	background: -ms-linear-gradient(top,  rgba(247,249,250,1) 0%,rgba(240,240,240,1) 100%);
	background: linear-gradient(top,  rgba(247,249,250,1) 0%,rgba(240,240,240,1) 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f7f9fa', endColorstr='#f0f0f0',GradientType=0 );
	-webkit-box-shadow: 0 1px 2px rgba(0,0,0,0.1) inset;
	-moz-box-shadow: 0 1px 2px rgba(0,0,0,0.1) inset;
	-ms-box-shadow: 0 1px 2px rgba(0,0,0,0.1) inset;
	-o-box-shadow: 0 1px 2px rgba(0,0,0,0.1) inset;
	box-shadow: 0 1px 2px rgba(0,0,0,0.1) inset;
	-webkit-border-radius: 0 0 5px 5px;
	-moz-border-radius: 0 0 5px 5px;
	-o-border-radius: 0 0 5px 5px;
	-ms-border-radius: 0 0 5px 5px;
	border-radius: 0 0 5px 5px;
	border-top: 1px solid #CFD5D9;
	padding: 15px 0;
}
.button a {
	background: url(http://cssdeck.com/uploads/media/items/8/8bcLQqF.png) 0 -112px no-repeat;
	color: #7E7E7E;
	font-size: 17px;
	padding: 2px 0 2px 40px;
	text-decoration: none;
	-webkit-transition: all 0.3s ease;
	-moz-transition: all 0.3s ease;
	-ms-transition: all 0.3s ease;
	-o-transition: all 0.3s ease;
	transition: all 0.3s ease;
}
.button a:hover {
	background-position: 0 -135px;
	color: #00aeef;
}
</style>
</head>
<body>
<div class="container">
	<section id="content">
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
			<h1>Login Form</h1>
			<div>
				<input type="text" placeholder="Username" required id="username" />
			</div>
			<div>
				<input type="password" placeholder="Password" required id="password" />
			</div>
			<div>
				<input type="submit" value="Log in" />
				<a href="#">Lost your password?</a>
			</div>
		</form><!-- form -->
		<!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>
<?php  } ?>