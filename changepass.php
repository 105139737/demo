<?php 
$reqlevel = 1;
include("membersonly.inc.php");

// check if the admin alows this feature: the $allowChangePassword variable is set in config.php
if ($allowChangePassword == false){die($disabledFeatures);}

//retrieve the post vars.
$oldpass1 = @$HTTP_POST_VARS["oldpass"];
$password1 = @$HTTP_POST_VARS["password"];
$password2 = @$HTTP_POST_VARS["password2"];

//check if the password match and if there not empty
if ($password1 == $password2 && $password1 <> ""){
	//(re)check the database to see it the old password is correct
	$query = "Select * from ".$DBprefix."signup where username='$HTTP_SESSION_VARS[id]' And password='$oldpass1'";
	$result = mysqli_query($conn,$query); 
	if ($row = mysqli_fetch_array($result)){ 
		//update the password in the database
		$query = "UPDATE ".$DBprefix."signup Set password = '$password1' where username='$HTTP_SESSION_VARS[id]'";  
		$result = mysqli_query($conn,$query); 
		//update the password in the session so you don't have to logoff
		$HTTP_SESSION_VARS["pass"] = $password1;
		//echo an confirm.
		echo "Your password was changed ";
	}else{
		//it the check on the old password returns that it is incorrect we return that here.
		makeform("Your old password is not correct. pleast try again");
	}
}else{
//if there is no match between the 2 passwords, or if the are empty,
//check if it isn't the pageload (then the password is empty and empty = incorrect)
//if not empty it calls the function makeform() with the errormessage as argument
if ($password1 == ""){makeform("");}
else{makeform("You password do not match try again.");}
}

//this function will make the change password page and put the error argument in it
function makeform($errormessage){
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Change password</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<?php  echo "<font color=\"#FF0000\"><strong>$errormessage</strong></font>";?>

<form name="changepassword" method="post" action="changepass.php" id="changepassword">
<input type="hidden" name="action" value="changepassword">
 <table border="0"  width="700px"  class="table table-hover table-striped table-bordered" >
<tr>
   <td colspan="2" align="center" height="17px" style="background-color:#BFDBFF;color:#006BF5;">Change your password</td>
</tr>
<tr>
   <td align="right" height="20px">Password:</td>
   <td align="left"><input name="oldpass" type="password" class="form-control" id="oldpass" style="width:100px;height:18px;background-color:#FFFFFF;border-color:#BFDBFF;border-width:1px;border-style:solid;color:#006BF5;font-family:Verdana;font-size:11px;"></td>
</tr>
<tr>
   <td align="right" height="20px">New Password:</td>
   <td align="left"><input name="password" class="form-control" type="password" id="password" style="width:100px;height:18px;background-color:#FFFFFF;border-color:#BFDBFF;border-width:1px;border-style:solid;color:#006BF5;font-family:Verdana;font-size:11px;"></td>
</tr>
<tr>
   <td align="right" height="20px">Confirm New Password:</td>
   <td align="left"><input name="password2" class="form-control" type="password" id="password2" style="width:100px;height:18px;background-color:#FFFFFF;border-color:#BFDBFF;border-width:1px;border-style:solid;color:#006BF5;font-family:Verdana;font-size:11px;"></td>
</tr>
<tr>
   <td colspan="2"><?php  echo $error_message; ?></td>
</tr>
<tr>
   <td>&nbsp;</td><td align="left" valign="bottom"><input type="submit" name="changepassword" value="Change Password" id="changepassword" style="color:#006BF5;background-color:#FFFFFF;border-color:#BFDBFF;border-width:1px;border-style:solid;font-family:Verdana;font-size:11px;width:150px;height:20px;"></td>
</tr>
</table>
</form>
</div>
</body>
</html>
<?php  } ?>