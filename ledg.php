<?php
$reqlevel = 0;
include("membersonly.inc.php");
$dt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s');
$a=$_REQUEST[fv];
$b=$_REQUEST[cat];
$err="";
$query5 = "SELECT * FROM ".$DBprefix."group where nm='$b'";
   $result5 = mysqli_query($conn,$query5);
while ($R5 = mysqli_fetch_array ($result5))
{
$b=$R5['sl'];
}
$query = "SELECT * FROM ".$DBprefix."ledg where gcd='$b' and nm='$a'";
   $result = mysqli_query($conn,$query);
$count=mysqli_num_rows($result);
if($count>0){
$err="Already Entered";
}
if($a==""){
	$err="You Cant Left The Field Blank";
}
if($err=="")
{
$query2 = "INSERT INTO ".$DBprefix."ledg (gcd,nm) VALUES ('$b','$a')";
$result2 = mysqli_query($conn,$query2);
$query = "SELECT * FROM ".$DBprefix."ledg where gcd='$b' and nm='$a'";
   $result = mysqli_query($conn,$query);
   while ($R1 = mysqli_fetch_array ($result))
{
$psl=$R1['sl'];
}


}
$query3 = "SELECT * FROM ".$DBprefix."ledg";
   $result3 = mysqli_query($conn,$query3);

?>
<table border="1" cellspacing="1" width="100%" class="table table-hover table-striped table-bordered">
          <tr>
            <td width="20%"><font size="5">ID</font></td>
            <td width="40%"><font size="5" >Group</font></td>
	    <td width="40%"><font size="5" >Ledger</font></td>
          </tr>
<?
while ($R = mysqli_fetch_array ($result3))
{
$x=$R['sl'];
$y=$R['gcd'];
$z=$R['nm'];
$query4 = "SELECT * FROM ".$DBprefix."group where sl='$y'";
   $result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$m=$R4['nm'];
}
$grdv="grp".$x;
$ldgdv="ldg".$x;
?>
          <tr>
            <td><? echo $x;?></td>
            <td><div id="<? echo $grdv;?>"><a onclick="showeditledg('<? echo $x;?>','gcd','<? echo $y;?>','<? echo $grdv;?>')"><? echo $m;?></a></div></td>
            <td><div id="<? echo $ldgdv;?>"><a onclick="showeditledg('<? echo $x;?>','nm','<? echo $z;?>','<? echo $ldgdv;?>')"><? echo $z;?></a></div></td>
          </tr>
<?
}
?>
          </table>
