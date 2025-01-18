<?php  
$reqlevel = 1;
include("membersonly.inc.php");
$a=$_REQUEST['unm'];
$b=$_REQUEST['nm'];
$c=$_REQUEST['mob'];
$d=$_REQUEST['eml'];
$desg=$_REQUEST['desg'];
$cc=$_REQUEST['cc'];
$vl=$_REQUEST['vl'];
$un=$_REQUEST['un'];
$brnc=$_REQUEST['brn'];
$err="";
if($cc==1){
$query1 = "SELECT * from ".$DBprefix."signup where username='$a'";
	$result1 = mysqli_query($conn,$query1);
        $count1=mysqli_num_rows($result1);
		if($a==""){$err="Please Fill the form Carefully";}
		if($b==""){$err="Please Fill the form Carefully";}
		if($c==""){$err="Please Fill the form Carefully";}
		if($count1>0){$err="Sorry ! Username Already Exists.";}
if($err=="")
{

$query = "INSERT INTO ".$DBprefix."signup (username, password,name,brncd,mob, mailadres, actnum, userlevel) VALUES ('$a','password','$b','$brnc','$c','$d','0','$desg')";  
	$result = mysqli_query($conn,$query); 


if($desg<0){$dsg="Admin";}

if($desg==4){$dsg="Editor";}
if($desg==1){$dsg="Entry Operator";}



	$message="Your ".$dsg." Account Created Successfully. Your ID is ".$a." and Password is password";
	$username="hdpl";
	$password="neha0000";
	$sender="VENUS";
	$domain="sms.aspindia.us";
	$method="POST";



	$username=urlencode($username);
	$password=urlencode($password);
	$sender=urlencode($sender);
	$message=urlencode($message);


$opts = array(
	  'http'=>array(
	    'method'=>"$method",
	  	'content' => "username=$username&password=$password&sender=$sender&to=$c&message=$message&priority=2",
	    'header'=>"Accept-language: en\r\n" .
	              "Cookie: foo=bar\r\n"
	  )
	);

	$context = stream_context_create($opts);

	$fp = fopen("http://$domain/pushsms.php", "r", false, $context);
	$response = @stream_get_contents($fp);

	fpassthru($fp);
	fclose($fp);





}
else
{
echo "<div align=\"center\"><font color=\"red\">".$err."</font></div>";
}
}

if($cc==2){
$query7 = "update ".$DBprefix."signup set actnum='$vl' where username='$un'";
$result7 = mysqli_query($conn,$query7);
}
$query1 = "SELECT * FROM ".$DBprefix."signup where username!='admin' and username!='rycc'";
$result1 = mysqli_query($conn,$query1);

echo "<table border=\"2\" cellspacing=\"1\" width=\"100%\">";
echo "<tr>";
echo "<td width=\"10%\" align=\"left\"> <font size=\"4\">Username</td>";
echo "<td width=\"30%\" align=\"left\"> <font size=\"4\">Name</td>";
echo "<td width=\"12%\" align=\"left\"> <font size=\"4\">Mobile</td>";
echo "<td width=\"18%\" align=\"left\"> <font size=\"4\">Designation</td>";
echo "<td width=\"17%\" align=\"left\"> <font size=\"4\">Centre Code</td>";
echo "<td width=\"13%\" align=\"left\"> <font size=\"4\">Action</td>";
echo "</tr>"; 

while ($R = mysqli_fetch_array ($result1))
{
$e=$R['username'];
$f=$R['name'];
$g=$R['mob'];
$h=$R['userlevel'];
$i=$R['actnum'];
$x=$R['brncd'];
if($h<0){$j="Admin";}
if($h==3){$j="Editor";}

if($h==2){$j="Entry Operator";}

if($i==0){$k="Deactivate";$l=1;}else{$k="Activate";$l=0;}




echo "<tr>";
echo "<td align=\"left\"><font size=\"3\">".$e."</font></td>";
echo "<td align=\"left\"> <font size=\"3\">".$f."</font></td>";
echo "<td align=\"left\"> <font size=\"3\">".$g."</font></td>";
echo "<td align=\"left\"> <font size=\"3\">".$j."</font></td>";
echo "<td align=\"left\"> <font size=\"3\">".$x."</font></td>";
echo "<td align=\"left\"> <font size=\"3\"><a href=\"#\" onclick=\"adduser('','','','','','',2,'".$l."','".$e."')\">".$k."</a></font></td>";
echo "</tr>";

}
echo "</table>";
?>