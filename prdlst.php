<?php 
/**
 * @author Nirmal Biswas
 * @copyright 2013
 */
$reqlevel = 1;
include("membersonly.inc.php");
$pt=$_REQUEST[pt];
$fv=$_REQUEST[fv];
$fvf="%".$fv."%";
$eqr="";
if($pt=="pname")
{
    $eqr=" and ".$pt." like '$fvf'";
}
else
{
    $eqr=" and ".$pt." = '$fv'";
}
if($pt=="mdby")
{
$crm=mysqli_query($conn,"select * from ".$DBprefix."mdby where nm = '$fv'");
while ($rm=mysqli_fetch_array($crm))
{
$mdby=$rm['sl'];
}}
if($pt=="catg")
{
$crm1=mysqli_query($conn,"select * from ".$DBprefix."catg where nm = '$fv'");
while ($rm1=mysqli_fetch_array($crm1))
{
$catg=$rm1['sl'];
}}
?>
    <table border="0" width="860px" class="table table-hover table-striped table-bordered">
	<thead>
          <tr style="background-color:#2396d6;">
            <th width="15%"><font size="4" color="#FFFF66">ID</font></th>
            <th width="20%"><font size="4" color="#FFFF66">Make By/Group</font></th>
	    <th width="20%"><font size="4" color="#FFFF66">Categoy</font></th>
        <th width="35%"><font size="4" color="#FFFF66">Product Name</font></th>
        <th width="10%"><font size="4" color="#FFFF66">Unit</font></th>
          </tr></thead>
<?php 
$c5='even';
$query3="select * from ".$DBprefix."product where ($pt like '$fv' or $pt='$mdby' or $pt='$catg') and sts=1";
$result3 = mysqli_query($conn,$query3);
while ($R = mysqli_fetch_array ($result3))
{
$x=$R['sl'];
$y=$R['mdby'];
$z=$R['catg'];
$p=$R['pname'];
$u=$R['pkgunt'];
$query4 = "SELECT * FROM ".$DBprefix."mdby where sl='$y'";
   $result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$m=$R4['nm'];
}
$query5 = "SELECT * FROM ".$DBprefix."catg where sl='$z'";
   $result5 = mysqli_query($conn,$query5);
while ($R5 = mysqli_fetch_array ($result5))
{
$c=$R5['nm'];
}
$query6 = "SELECT * FROM ".$DBprefix."unit where sl='$u'";
   $result6 = mysqli_query($conn,$query6);
while ($R6 = mysqli_fetch_array ($result6))
{
$un=$R6['unitnm'];
}
$grdv="grp".$x;
$ldgdv="ldg".$x;
if($c5=='even')
{
$c5='odd';
}
elseif($c5=='odd')
{
$c5='even';
}
?>
         <tr class="<?php  echo $c5;?>">
            <td align="center"><?php  echo $x;?></td>
            <td align="center"><?php  echo $m;?></td>
            <td align="center"><?php  echo $c;?></td>
            <td align="center"><?php  echo $p;?></td>
            <td align="center"><?php  echo $un;?></td>
          </tr>
<?php 
}
?>
          </table>