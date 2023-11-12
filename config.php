<?PHP
// These variables are needed to connect to the database, if your not sure about these data contact your hosting company. 
// since this is VERY important to the log-in system
// if you are using a local system to to test, the server is (almost) always localhost.
// for tripod users: don't fill in a username / password. Only your databasename 
// for tripod users: username_country_db so that would be (example) utimer_nl_db
// for tripod users: if you are unsure check in the FAQ of tripod


  $server = "localhost"; 	// often localhost
$username = "root"; 			// Your MySQL server username
$password = ""; 			// Your MySQL server password
$database = "hndbtrkn_bill_local"; 			// If you fill in nothing database 'members' will be used. If 'members' doesn't exist it will be created.
$DBprefix = "main";			// the prefix for the tables in the database (can be left blank)

// The ranks for the members. The first in the list is userlevel is 1, every item after (seperate with comma's) increases with one.
// so the example below is: 1 = newbie, 2=new member, 3=member, 4=high member, 5=very high member, ect
$ranks = array(
		1=>"Sales",
		2=>"Manager",
		3=>"Agent",
		4=>"Cashier",
		5=>"Office Staff",
		6=>"supreme member",
		7=>"ultra member",
		8=>"godlike member",
		9=>"god member",
		10=>"low god",
		11=>"medium god",
		12=>"high god",
		13=>"very high god",
		14=>"supreme god",
		15=>"ultra god",
		16=>"perfect"
	      );
		  
// script options:
$usernameLengthMIN = 1; 		// Sets the minium nubmer of characters in the username 
$usernameLengthMAX = 20;		// Sets the maxium number of characters in the username (max 20 chars!)
$passwordLengthMIN = 3; 		// Sets the minium nubmer of characters in the password 
$passwordLengthMAX = 8;			// Sets the maxium number of characters in the password (max 20 chars!)
$UseMailConfirm = true; 		// Only set this to false if your host does not support mail()
$AllowForgotPassword = true; 	// Only set this to false if your host does not support mail()
$UsernameValCharOnly = true; 	// If set on true the user can only use usernames with A to Z, a to z, 0 to 9
$passwordValCharOnly = true; 	// If set on true the user can only use passwords with A to Z, a to z, 0 to 9
$allowChangePassword = true; 	// If set on false the user cant change passwords
$makeAdminOnlyActivate = false;	// Set this to true if you want to activate al accounts by hand throught the admin screen
$allowResend = true;			// Set this to false if you don't want the users to be able to have the activation code resend
								// Note that the form will be visible anyway and that if $UseMailConfirm = false if wont be send either
$hnm=$_SERVER['HTTP_HOST'];
$expl=explode(".",$hnm);
if($expl[0]=="www"){$hn=$expl[1];}else{$hn=$expl[0];}
$TripodSupport = false;			// Only set this to true if you are hosted on tripod.

// ErrorStrings:
$couldNotConnectMysql = "Could not connect MySQL<BR>\n please check your settings in config.php";
$couldNotOpenDatabase = "Could not open database<BR>\n please check your settings in config.php";
$disabledFeatures = "The adminstrator of this site has disabled this feature";
$incorrectLogin = "Incorrect login";
$underAttackReLogin = "This account was under attack. Therefore it was locked. To terminate the lock log-in with you correct loginname and password. After this log-in the lock will be terminated and you can you use our account as normal<BR> NOTE: make sure you do not make any type errors. This would activate the lock again.";
$underAttackPleaseWait = "This account is under attack. Please wait an until the account is released again."; 
$accountNotActivated = "This account has not been activated yet.";
$incorrectUserMailaders = "The username / e-mail-combination you entered is incorrect.";
$activationCodeHasBeenResend = "Your activationcode has been resend to your mailadres.";
$incorrectUserActcode ="The username/activation-combination you entered is not correct. Please try again.";


// The content of the activation email
// also possible is to put a link in that message like :
// http:// your url /activate.php?username=$username1&actnum=$actnum
// this would allow the user to direcly submit there activation without having to enter
// al the data again in the activation form.
// use %p to print the activation number, use %a if you want the use the % sign
$email_message_content = "Your activation number: %p";
// also set the title of the message
$email_message_title = "Login sytem";
// and we put the sender in this mail. 
// syntax: "From: YOUR SENDER"
// note this will also be used for the forgot password mail.
$email_message_header = "From: Goldman India";
// the content of the forgot password mail:
// use %p to print the password, use %a if you want to use the % sign
$message_forgot_password = "Your password:\n %p";
// and here you can give a title (subject) for the forgot password mail.
$title_forgot_password = "Password request";


// +---------------------------------------------------------------------------------------------------------+ //
// +--------------------------- Below this line you do not need to edit the code! ---------------------------+ //
// +---------------------------------------------------------------------------------------------------------+ //

// if the prefix is not empty add an _ (underscore)
if ($DBprefix != ""){$DBprefix = $DBprefix . "_";}

$conn=mysqli_connect($server,$username,$password,$database);
// Check connection
if (mysqli_connect_errno())
{

	 echo "Failed to connect to MySQL: " . mysqli_connect_error();
 }
 //ini_set('memory_limit', '-1');
?>