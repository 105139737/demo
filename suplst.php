<?php  $reqlevel = 3; include("membersonly.inc.php");
$pt=$_REQUEST[pt];
$fv=$_REQUEST[fv];
if($pt=="addr"){
    $fvf="%".$fv."%";
}
else
{
  $fvf=$fv."%";  
}

$query1 = "SELECT sum(dbl) as ttlbl FROM ".$DBprefix."suppl where $pt like '$fvf' order by nm";
   $result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$ntbl=$R1['ttlbl'];
}

echo "<table  width=\"100%\" class=\"table table-hover table-striped table-bordered\">";
echo "<thead>";
echo "<tr>";
echo "<td align=\"right\" colspan=\"9\"><font size=\"5\" color=\"#FF0000\"><strong>".number_format($ntbl,0)."</strong></td>";
echo "</tr>"; 

echo "<tr style=\"background-color:#2396d6;\">";
echo "<th align=\"center\"> <font size=\"4\">Sl.</th>";
echo "<th align=\"center\"> <font size=\"4\">Branch</th>";
echo "<th align=\"center\"> <font size=\"4\">ID</th>";
echo "<th align=\"center\"> <font size=\"4\">Shop</th>";
echo "<th align=\"center\"> <font size=\"4\">Name</th>";
echo "<th align=\"center\"> <font size=\"4\">Address</th>";
echo "<th align=\"center\"> <font size=\"4\">Mobile</th>";
echo "<th align=\"center\"> <font size=\"4\">Last Sold</th>";
echo "<th align=\"center\"> <font size=\"4\">Balance</th>";
echo "</tr>"; 
echo "</thead>";
$sl=1;

$query = "SELECT * FROM ".$DBprefix."suppl where $pt like '$fvf' order by nm";
   $result = mysqli_query($conn,$query);
$c2='odd';
while ($R = mysqli_fetch_array ($result))
{
$a=$R['nm'];
$b=$R['addr'];
$c=$R['mob1'];
$d=$R['sid'];
$e=$R['dbl'];
$sp=$R['spn'];
$ls=$R['lsld'];
$brnm=$R['brncd'];

if($c2=='even')
{
$c2='odd';
}
elseif($c2=='odd')
{
$c2='even';
}
if ($user_current_level < 0){$ascd="<a href=\"supenq.php?cid=$d\" target=\"_blank\">".$d."</a>";}else{$ascd=$d;}

?>
<tr class="<?php  echo $c2;?>">
<td style="text-align: center;"><?php  echo $sl; ?></td>
<td><?php  echo $brnm; ?></td>
<td><?php  echo $ascd; ?></td>
<td><?php  echo $sp; ?></td>
<td><?php  echo $a; ?></td>
<td><?php  echo $b; ?></td>
<td><?php  echo $c; ?></td>
<td><?php  echo $ls; ?></td>
<?php 
if($e < 0){?>
<td style="background: #FFF;text-align: right;"><font color="#039303"><strong><?php  echo $e; ?></strong></font></td>
<?php 
}
else
{
?>    
<td style="background: #FFF;text-align: right;"><font color="#FF0000"><strong><?php  echo $e; ?></strong></font></td>
<?php 
}
?>
</tr>
<?php 
$sl=$sl+1;
}
?>
